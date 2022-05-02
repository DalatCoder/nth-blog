<?php

namespace NTHB;

use Ninja\DatabaseTable;
use Ninja\NJInterface\IRoutes;
use NTHB\API\CategoryAPI;
use NTHB\API\MediaAPI;
use NTHB\API\TagAPI;
use NTHB\Controller\Admin\AdminCategoryController;
use NTHB\Controller\Admin\AdminDashboardController;
use NTHB\Controller\Admin\AdminPostController;
use NTHB\Controller\Admin\AdminTagController;
use NTHB\Controller\AuthController;
use NTHB\Controller\Client\BlogController;
use NTHB\Controller\Client\HomeController;
use NTHB\Entity\CategoryEntity;
use NTHB\Entity\MediaEntity;
use NTHB\Entity\Pivot\PostCategoryEntity;
use NTHB\Entity\Pivot\PostTagEntity;
use NTHB\Entity\PostEntity;
use NTHB\Entity\TagEntity;
use NTHB\Model\Admin\CategoryModel;
use NTHB\Model\Admin\MediaModel;
use NTHB\Model\Admin\PostModel;
use NTHB\Model\Admin\TagModel;
use NTHB\Model\Admin\Pivot\PostCategoryModel;
use NTHB\Model\Admin\Pivot\PostTagModel;
use NTHB\Model\Admin\UserController;

class NTHBRoutesHandler implements IRoutes
{
    private $admin_category_table_helper;
    private $admin_category_model;
    
    private $admin_tag_table_helper;
    private $admin_tag_model;
    
    private $admin_post_table_helper;
    private $admin_post_model;
    
    private $admin_media_table_helper;
    private $admin_media_model;
    
    private $admin_post_category_table_helper;
    private $admin_post_category_model;
    
    private $admin_post_tag_table_helper;
    private $admin_post_tag_model;
    
    public function __construct()
    {
        $this->admin_category_table_helper = new DatabaseTable(
            CategoryEntity::TABLE,
            CategoryEntity::PRIMARY_KEY,
            CategoryEntity::CLASS_NAME
        );
        $this->admin_category_model = new CategoryModel($this->admin_category_table_helper);
        
        $this->admin_tag_table_helper = new DatabaseTable(
            TagEntity::TABLE,
            TagEntity::PRIMARY_KEY,
            TagEntity::CLASS_NAME
        );
        $this->admin_tag_model = new TagModel($this->admin_tag_table_helper);
        
        $this->admin_post_table_helper = new DatabaseTable(
            PostEntity::TABLE,
            PostEntity::PRIMARY_KEY,
            PostEntity::CLASS_NAME,
            [
                &$this->admin_post_category_model,
                &$this->admin_post_tag_model,
                &$this->admin_media_model
            ]
        );
        $this->admin_post_model = new PostModel($this->admin_post_table_helper);
        
        $this->admin_media_table_helper = new DatabaseTable(
            MediaEntity::TABLE,
            MediaEntity::PRIMARY_KEY,
            MediaEntity::CLASS_NAME
        );
        $this->admin_media_model = new MediaModel($this->admin_media_table_helper);
        
        $this->admin_post_category_table_helper = new DatabaseTable(
            PostCategoryEntity::TABLE,
            PostCategoryEntity::PRIMARY_KEY,
            PostCategoryEntity::CLASS_NAME
        );
        $this->admin_post_category_model = new PostCategoryModel($this->admin_post_category_table_helper, $this->admin_category_table_helper);
        
        $this->admin_post_tag_table_helper = new DatabaseTable(
            PostTagEntity::TABLE,
            PostTagEntity::PRIMARY_KEY,
            PostTagEntity::CLASS_NAME
        );
        $this->admin_post_tag_model = new PostTagModel($this->admin_post_tag_table_helper, $this->admin_tag_table_helper);
    }

    public function getRoutes(): array
    {
        $controller_routes = $this->get_all_controller_routes();
        $api_routes = $this->get_all_api_routes();

        return $controller_routes + $api_routes;
    }

    public function get_all_controller_routes(): array
    {
        $admin_dashboard_routes = $this->get_admin_dashboard_routes();
        $admin_category_routes = $this->get_admin_category_routes();
        $admin_tag_routes = $this->get_admin_tag_routes();
        $admin_post_routes = $this->get_admin_post_routes();
        $admin_user_routes = $this->get_admin_user_routes();

        $auth_routes = $this->get_auth_routes();
        $client_routes = $this->get_client_routes();
        
        return $admin_dashboard_routes + 
            $admin_category_routes + 
            $admin_tag_routes + 
            $admin_post_routes + 
            $admin_user_routes +
            $auth_routes +
            $client_routes;
    }
    
    public function get_admin_dashboard_routes(): array
    {
        $controller = new AdminDashboardController();
        
        return [
            '/admin' => [
                'REDIRECT' => '/admin/dashboard'
            ],
            '/admin/dashboard' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'index'
                ]
            ]
        ];
    }

    public function get_admin_category_routes(): array
    {
        $controller = new AdminCategoryController($this->admin_category_model);

        return [
            '/admin/category' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'index'
                ]
            ]
        ];
    }

    public function get_admin_tag_routes(): array
    {
        $controller = new AdminTagController($this->admin_tag_model);

        return [
            '/admin/tag' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'index'
                ]
            ]
        ];
    }

    public function get_admin_post_routes(): array
    {
        $controller = new AdminPostController($this->admin_post_model, $this->admin_category_model, $this->admin_tag_model, $this->admin_media_model);

        return [
            '/admin/post' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'index'
                ]
            ],
            '/admin/post/create' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'create'
                ],
                'POST' => [
                    'controller' => $controller,
                    'action' => 'store'
                ]
            ]
        ];
    }
    
    public function get_admin_user_routes(): array
    {
        $controller = new UserController();
        
        return [
            '/admin/author' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'index'
                ]
            ],
            '/admin/author/create' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'create'
                ]
            ]
        ];
    }
    
    public function get_auth_routes(): array
    {
        $controller = new AuthController();
        
        return [
            '/auth/login' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'render_login_page'
                ]
            ]
        ];
    }
    
    public function get_client_routes(): array
    {
        $home_controller = new HomeController();
        $blog_controller = new BlogController($this->admin_post_model);
        
        return [
            '/' => [
                'GET' => [
                    'controller' => $home_controller,
                    'action' => 'render_home_page'
                ]
            ],
            '/blog' => [
                'GET' => [
                    'controller' => $blog_controller,
                    'action' => 'render_blog_page'
                ]
            ],
            '/blog/show' => [
                'GET' => [
                    'controller' => $blog_controller,
                    'action' => 'render_blog_detail_page'
                ]
            ]
        ];
    }

    public function get_all_api_routes(): array
    {
        $category_api = new CategoryAPI($this->admin_category_model);
        $tag_api = new TagAPI($this->admin_tag_model);
        $media_api = new MediaAPI($this->admin_media_model);
        
        return [
            '/api/v1/category' => [
                'POST' => [
                    'controller' => $category_api,
                    'action' => 'store'
                ]
            ],
            '/api/v1/tag' => [
                'POST' => [
                    'controller' => $tag_api,
                    'action' => 'store'
                ]
            ],
            '/api/v1/media/upload' => [
                'POST' => [
                    'controller' => $media_api,
                    'action' => 'store'
                ]
            ]
        ];
    }

    public function getAuthentication(): ?\Ninja\Authentication
    {
        return null;
    }

    public function checkPermission($permission): ?bool
    {
        return null;
    }
}
