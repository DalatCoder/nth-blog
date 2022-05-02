<?php

namespace NTHB\Controller\Admin;

use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\CategoryModel;
use NTHB\Model\Admin\PostModel;
use NTHB\Model\Admin\TagModel;

class AdminPostController extends NTHBBaseController
{
    private PostModel $post_model;
    private CategoryModel $category_model;
    private TagModel $tag_model;
    
    public function __construct(PostModel $post_model, CategoryModel $category_model, TagModel $tag_model)
    {
        parent::__construct();
        
        $this->post_model = $post_model;
        $this->category_model = $category_model;
        $this->tag_model = $tag_model;
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
        
        $this->view_handler->render('admin/post/create.html.php', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}
