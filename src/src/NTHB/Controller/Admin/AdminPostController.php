<?php

namespace NTHB\Controller\Admin;

use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\PostModel;

class AdminPostController extends NTHBBaseController
{
    private PostModel $post_model;
    
    public function __construct(PostModel $post_model)
    {
        parent::__construct();
        
        $this->post_model = $post_model;
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
        $this->view_handler->render('admin/post/create.html.php');
    }
}
