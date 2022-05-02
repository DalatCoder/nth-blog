<?php

namespace NTHB\Controller\Client;

use NTHB\Controller\NTHBBaseController;

class HomeController extends NTHBBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function render_home_page()
    {
        $this->view_handler->render('client/home.html.php');
    }
}
