<?php

namespace NTHB\Controller\Admin;

use Exception;
use Ninja\Authentication;
use Ninja\NinjaException;
use NTHB\Controller\NTHBBaseController;
use NTHB\Entity\PostEntity;
use NTHB\Model\Admin\CategoryModel;
use NTHB\Model\Admin\MediaModel;
use NTHB\Model\Admin\PostModel;
use NTHB\Model\Admin\TagModel;

class AdminPostController extends NTHBBaseController
{
    private PostModel $post_model;
    private CategoryModel $category_model;
    private TagModel $tag_model;
    private MediaModel $media_model;
    private Authentication $authentication_helper;
    
    public function __construct(PostModel $post_model, CategoryModel $category_model, TagModel $tag_model, MediaModel $media_model, Authentication $authentication_helper)
    {
        parent::__construct();
        
        $this->post_model = $post_model;
        $this->category_model = $category_model;
        $this->tag_model = $tag_model;
        $this->media_model = $media_model;
        $this->authentication_helper = $authentication_helper;
    }
    
    public function index()
    {
        $posts = $this->post_model->get_all();

        $this->view_handler->render('admin/post/index.html.php', [
            'posts' => $posts
        ]);
    }
    
    public function create()
    {
        $categories = $this->category_model->get_all();
        $tags = $this->tag_model->get_all();
        $medias = $this->media_model->get_all();
        $posts = $this->post_model->get_all();
        
        $this->view_handler->render('admin/post/create.html.php', [
            'page_title' => 'Thêm bài viết mới',
            'categories' => $categories,
            'tags' => $tags,
            'medias' => $medias,
            'posts' => $posts
        ]);
    }
    
    public function store()
    {
        try {
            $author_id = $this->authentication_helper->getUserId();
            $parent_id = $_POST['parent-id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $meta_title = $_POST['meta-title'] ?? '';
            $summary = $_POST['summary'] ?? '';
            $content = $_POST['content'] ?? '';
            $cover_image_id = $_POST['cover_image'] ?? null;
            
            $published_at = null;
            if (isset($_POST['published']) && $_POST['published'] == 'published') {
                $published_at = date('Y-m-d H:i:s');
            }
            
            $new_post = $this->post_model->create($author_id, $parent_id, $title, $meta_title, $summary, $content, $cover_image_id, $published_at);
            
            if (!($new_post instanceof PostEntity)) {
                throw new NinjaException('Có lỗi trong quá trình tạo post, thử lại sau');
            }

            $categories = $_POST['categories'] ?? [];
            $tags = $_POST['tags'] ?? [];

            foreach ($categories as $category) {
                $new_post->add_category($category);
            }

            foreach ($tags as $tag) {
                $new_post->add_tag($tag);
            }
            
            $this->route_redirect('/admin/post');
        }
        catch (NinjaException $exception) {
            die(print_r($exception, true));
        }
        catch (Exception $exception) {
            error_log(print_r($exception, true));
            die(print_r($exception, true));
        }
    }
    
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (is_null($id))
            $this->route_redirect('/admin/post');
        
        $post = $this->post_model->get_by_id($id);
        if (!$post instanceof PostEntity)
            $this->route_redirect('/admin/post');
        
        $categories = $this->category_model->get_all();
        $tags = $this->tag_model->get_all();
        $medias = $this->media_model->get_all();
        $posts = $this->post_model->get_all();
        
        $this->view_handler->render('admin/post/edit.html.php', [
            'page_title' => 'Cập nhật bài viết',
            'categories' => $categories,
            'tags' => $tags,
            'medias' => $medias,
            'posts' => $posts,
            'post' => $post
        ]);
    }
    
    public function update()
    {
        try {
            $post_id = $_POST['post_id'] ?? null;
            if (empty($post_id))
                throw new NinjaException('Mã bài viết không hợp lệ');
            
            $post = $this->post_model->get_by_id($post_id);
            if (!$post instanceof PostEntity)
                throw new NinjaException('Không tìm thấy bài viết');
            
            $post->{PostEntity::KEY_PARENT_ID} = $_POST['parent-id'] ?? 0;
            $post->{PostEntity::KEY_TITLE} = $_POST['title'] ?? '';
            $post->{PostEntity::KEY_META_TITLE} = $_POST['meta-title'] ?? '';
            $post->{PostEntity::KEY_SUMMARY} = $_POST['summary'] ?? '';
            $post->{PostEntity::KEY_CONTENT} = $_POST['content'] ?? '';
            $post->{PostEntity::KEY_COVER_IMAGE_ID} = $_POST['cover_image'] ?? null;
            
            if (isset($_POST['save_draft']) && $_POST['save_draft'] == 'save_draft') {
                $post->{PostEntity::KEY_PUBLISHED_AT} = null;
            }
            
            $updated_post = $this->post_model->update($post_id, $post);

            if (!($updated_post instanceof PostEntity)) {
                throw new NinjaException('Có lỗi trong quá trình cập nhật bài viết, thử lại sau');
            }

            $categories = $_POST['categories'] ?? [];
            $tags = $_POST['tags'] ?? [];
            
            $already_categories = $updated_post->fetch_categories();
            $already_tags = $updated_post->fetch_tags();
            
            // TODO: sync categories
            // TODO: sync tags

            $this->route_redirect('/admin/post');
        }
        catch (NinjaException $exception) {
            die(print_r($exception, true));
        }
        catch (Exception $exception) {
            error_log(print_r($exception, true));
            die(print_r($exception, true));
        }   
    }
}
