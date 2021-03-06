<?php

namespace NTHB\Controller\Client;

use Ninja\NinjaException;
use NTHB\Controller\NTHBBaseController;
use NTHB\Entity\CategoryEntity;
use NTHB\Entity\PostEntity;
use NTHB\Entity\TagEntity;
use NTHB\Entity\UserEntity;
use NTHB\Model\Admin\CategoryModel;
use NTHB\Model\Admin\PostModel;
use NTHB\Model\Admin\TagModel;
use NTHB\Model\Admin\UserModel;

class BlogController extends NTHBBaseController
{
    private PostModel $post_model;
    private CategoryModel $category_model;
    private TagModel $tag_model;
    private UserModel $user_model;

    public function __construct(PostModel $post_model, CategoryModel $category_model, TagModel $tag_model, UserModel $user_model)
    {
        parent::__construct();

        $this->post_model = $post_model;
        $this->category_model = $category_model;
        $this->tag_model = $tag_model;
        $this->user_model = $user_model;
    }

    public function render_blog_page()
    {
        try {
            $category_slug = $_GET['category'] ?? null;
            $tag_slug = $_GET['tag'] ?? null;
            $author_id = $_GET['author-id'] ?? null;

            $posts = [];
            $page_sub_title = 'Tất cả bài viết';
            $page_title = '';
            
            $get_post_by_condition = false;
            
            if (!empty($category_slug)) {
                $category = $this->category_model->get_by_slug($category_slug);
                
                if (!$category instanceof CategoryEntity)
                    throw new NinjaException('Không tìm thấy thể loại bài viết', 404);
                
                $posts = $this->post_model->get_all_published_by_category_id($category->{CategoryEntity::KEY_ID});
                $page_sub_title = 'Tất cả bài viết thuộc thể loại: ' . $category->{CategoryEntity::KEY_TITLE};
                $page_title = 'Bài viết theo thể loại';
                
                $get_post_by_condition = true;
            }
            
            if (count($posts) == 0 && !empty($tag_slug)) {
                $tag = $this->tag_model->get_by_slug($tag_slug);
                
                if (!$tag instanceof TagEntity)
                    throw new NinjaException('Không tìm thấy bài viết thuộc thẻ này', 404);
                
                $posts = $this->post_model->get_all_published_by_tag_id($tag->{TagEntity::KEY_ID});
                $page_sub_title = 'Tất cả bài viết thuộc thẻ: #' . $tag->{TagEntity::KEY_TITLE};
                $page_title = 'Bài viết được gắn thẻ';

                $get_post_by_condition = true;
            }
            
            if (count($posts) == 0 && !empty($author_id)) {
                $author = $this->user_model->get_by_id($author_id);
                
                if (!$author instanceof UserEntity)
                    throw new NinjaException('Không tìm thấy tác giả', 404);
                
                $posts = $this->post_model->get_published_by_author_id($author->{UserEntity::KEY_ID});
                $page_sub_title = 'Tất cả bài viết được xuất bản bởi tác giả: @' . $author->get_fullname();
                $page_title = 'Bài viết theo tác giả';

                $get_post_by_condition = true;
            }

            if (!$get_post_by_condition)
                $posts = $this->post_model->get_all_published();

            $this->view_handler->render('client/blog.html.php', [
                'posts' => $posts,
                'page_title' => $page_title,
                'page_sub_title' => $page_sub_title
            ]);
        } catch (NinjaException $e) {
            die($e->getMessage());
        }
    }

    public function render_blog_detail_page()
    {
        $slug = $_GET['post'] ?? null;

        if (is_null($slug)) {
            $this->route_redirect('/blog');
        }

        $post = $this->post_model->get_by_slug($slug);

        if (!$post instanceof PostEntity) {
            $this->route_redirect('/blog');
        }

        $comments = $post->fetch_comments();

        $this->view_handler->render('client/blog_detail.html.php', [
            'post' => $post,
            'page_sub_title' => $post->{PostEntity::KEY_TITLE},
            'comments' => $comments
        ]);
    }
}
