<?php

namespace NTHB\Controller\Admin;

use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\CategoryModel;

class AdminCategoryController extends NTHBBaseController
{
    private CategoryModel $category_model;
    
    public function __construct(CategoryModel $category_model)
    {
        $this->category_model = $category_model;
    }

    public function index()
    {
        $categories = $this->category_model->get_all();
        $this->view_handler->render('admin/category/index.html.php', [
            'categories' => $categories
        ]);
    }
}
