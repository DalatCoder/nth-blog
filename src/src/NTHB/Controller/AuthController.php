<?php

namespace NTHB\Controller;

use Cassandra\Exception\ProtocolException;
use Exception;
use Ninja\Authentication;
use Ninja\NinjaException;

class AuthController extends NTHBBaseController
{
    private Authentication $authentication_helper;
    
    public function __construct(Authentication $authentication_helper)
    {
        parent::__construct();
        
        $this->authentication_helper = $authentication_helper;
    }
    
    public function render_login_page()
    {
        $this->view_handler->render('auth/sign-in.html.php', [
            'page_title' => 'Đăng nhập'
        ]);
    }
    
    public function handle_login()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        try {
            $this->authentication_helper->login($email, $password);
            
            $this->route_redirect('/admin');
        } catch (NinjaException $e) {
            die($e->getMessage());
        }
        catch (Exception $exception) {
            die($e);
        }
    }
}
