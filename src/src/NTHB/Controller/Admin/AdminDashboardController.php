<?php

namespace NTHB\Controller\Admin;

use NTHB\Controller\NTHBBaseController;

class AdminDashboardController extends NTHBBaseController
{
    public function index()
    {
        $this->view_handler->render('admin/dashboard.html.php');
    }
}
