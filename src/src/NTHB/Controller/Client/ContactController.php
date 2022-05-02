<?php

namespace NTHB\Controller\Client;

use NTHB\Controller\NTHBBaseController;

class ContactController extends NTHBBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function render_contact_page()
    {
        $this->view_handler->render('client/contact.html.php');
    }
}
