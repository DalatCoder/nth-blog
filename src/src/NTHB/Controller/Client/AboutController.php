<?php

namespace NTHB\Controller\Client;

use NTHB\Controller\NTHBBaseController;

class AboutController extends NTHBBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function render_about_page()
    {
        $this->view_handler->render('client/about.html.php');
    }
}
