<?php

namespace NTHB\Controller\Admin;

use Exception;
use Ninja\NinjaException;
use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\UserModel;

class UserController extends NTHBBaseController
{
    private UserModel $user_model;
    
    public function __construct(UserModel $user_model)
    {
        parent::__construct();
        
        $this->user_model = $user_model;
    }
    
    public function index()
    {
        $users = $this->user_model->get_all();
        
        $this->view_handler->render('admin/user/index.html.php', [
            'page_title' => 'Danh sách tác giả',
            'users' => $users
        ]);
    }
    
    public function create()
    {
        $this->view_handler->render('admin/user/create.html.php', [
            'page_title' => 'Thêm tác giả mới'
        ]);
    }
    
    public function store()
    {
        try {
            $first_name = $_POST['first_name'] ?? null;
            $last_name = $_POST['last_name'] ?? null;
            $intro = $_POST['intro'] ?? null;
            $profile = $_POST['profile'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            
            $this->user_model->create($first_name, $last_name, $email, $password, $intro, $profile);
            
            $this->route_redirect('/admin/author');
        }
        catch (NinjaException $exception) {
            die($exception->getMessage());
        }
        catch (Exception $exception) {
            die($exception);
        }
    }
}
