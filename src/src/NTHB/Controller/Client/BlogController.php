<?php

namespace NTHB\Controller\Client;

use Ninja\NinjaException;
use NTHB\Controller\NTHBBaseController;
use NTHB\Entity\CategoryEntity;
use NTHB\Entity\PostEntity;
use NTHB\Model\Admin\CategoryModel;
use NTHB\Model\Admin\PostModel;

class BlogController extends NTHBBaseController
{
    private PostModel $post_model;
    private CategoryModel $category_model;

    public function __construct(PostModel $post_model, CategoryModel $category_model)
    {
        parent::__construct();

        $this->post_model = $post_model;
        $this->category_model = $category_model;
    }

    public function render_blog_page()
    {
        try {
            $category_slug = $_GET['category'] ?? null;
            $tag_slug = $_GET['tag'] ?? null;

            $posts = [];
            $page_sub_title = 'Tất cả bài viết';
            $page_title = '';
            
            if (!empty($category_slug)) {
                $category = $this->category_model->get_by_slug($category_slug);
                
                if (!$category instanceof CategoryEntity)
                    throw new NinjaException('Không tìm thấy thể loại bài viết', 404);
                
                $posts = $this->post_model->get_all_published_by_category_slug($category_slug);
                $page_sub_title = 'Tất cả bài viết thuộc thể loại: ' . $category->{CategoryEntity::KEY_TITLE};
                $page_title = 'Bài viết theo thể loại';
            }
            
            if (count($posts) == 0 && !empty($tag_slug)) {
                
            }

            if (count($posts) == 0) {
                $posts = $this->post_model->get_all_published();
            }

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
