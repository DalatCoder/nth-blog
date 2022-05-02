<?php

namespace NTHB\Model\Admin;

use NTHB\Controller\NTHBBaseController;

class UserController extends NTHBBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->view_handler->render('admin/user/index.html.php', [
            'page_title' => 'Danh sách tác giả',
            'users' => []
        ]);
    }
}
