<?php

namespace NTHB\Controller\Client;

use NTHB\Controller\NTHBBaseController;
use NTHB\Entity\PostEntity;
use NTHB\Model\Admin\PostModel;

class BlogController extends NTHBBaseController
{
    private PostModel $post_model;
    
    public function __construct(PostModel $post_model)
    {
        parent::__construct();
        
        $this->post_model = $post_model;
    }
    
    public function render_blog_page()
    {
        $posts = $this->post_model->get_all_published();
        
        $this->view_handler->render('client/blog.html.php', [
            'posts' => $posts
        ]);
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
