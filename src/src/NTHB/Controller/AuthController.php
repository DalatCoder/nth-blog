<?php

namespace NTHB\Controller;

class AuthController extends NTHBBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function render_login_page()
    {
        $this->view_handler->render('auth/sign-in.html.php', [
            'page_title' => 'Đăng nhập'
        ]);
    }
}
