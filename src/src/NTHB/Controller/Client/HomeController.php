<?php

namespace NTHB\Controller\Client;

use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\PostModel;

class HomeController extends NTHBBaseController
{
    private PostModel $post_model;
    
    public function __construct(PostModel $post_model)
    {
        parent::__construct();
        
        $this->post_model = $post_model;
    }
    
    public function render_home_page()
    {
        $posts = $this->post_model->get_all_published();
        
        $this->view_handler->render('client/home.html.php', [
            'posts' => $posts
        ]);
    }
}
