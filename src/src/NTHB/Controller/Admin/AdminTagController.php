<?php

namespace NTHB\Controller\Admin;

use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\TagModel;

class AdminTagController extends NTHBBaseController
{
    private TagModel $tag_model;
    
    public function __construct(TagModel $tag_model)
    {
        parent::__construct();
        
        $this->tag_model = $tag_model;
    }
    
    public function index()
    {
        $tags = $this->tag_model->get_all();

        $this->view_handler->render('admin/tag/index.html.php', [
            'tags' => $tags
        ]);
    }
}
