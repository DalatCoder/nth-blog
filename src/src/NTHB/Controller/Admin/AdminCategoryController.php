<?php

namespace NTHB\Controller\Admin;

use NTHB\Controller\NTHBBaseController;

class AdminCategoryController extends NTHBBaseController
{
    public function index()
    {
        $this->view_handler->render('admin/category/index.html.php');
    }
}
