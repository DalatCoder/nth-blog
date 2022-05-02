<?php

namespace NTHB\Controller\Client;

use NTHB\Controller\NTHBBaseController;
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
}
