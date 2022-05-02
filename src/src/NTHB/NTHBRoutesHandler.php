<?php

namespace NTHB;

use Ninja\Authentication;
use Ninja\DatabaseTable;
use Ninja\NJInterface\IRoutes;
use NTHB\API\CategoryAPI;
use NTHB\API\MediaAPI;
use NTHB\API\TagAPI;
use NTHB\Controller\Admin\AdminCategoryController;
use NTHB\Controller\Admin\AdminDashboardController;
use NTHB\Controller\Admin\AdminPostController;
use NTHB\Controller\Admin\AdminTagController;
use NTHB\Controller\Admin\CommentController;
use NTHB\Controller\AuthController;
use NTHB\Controller\Client\AboutController;
use NTHB\Controller\Client\BlogController;
use NTHB\Controller\Client\ContactController;
use NTHB\Controller\Client\HomeController;
use NTHB\Controller\Admin\UserController;
use NTHB\Controller\NTHBBaseController;
use NTHB\Entity\CategoryEntity;
use NTHB\Entity\MediaEntity;
use NTHB\Entity\Pivot\PostCategoryEntity;
use NTHB\Entity\Pivot\PostTagEntity;
use NTHB\Entity\PostComment;
use NTHB\Entity\PostEntity;
use NTHB\Entity\TagEntity;
use NTHB\Entity\UserEntity;
use NTHB\Model\Admin\CategoryModel;
use NTHB\Model\Admin\CommentModel;
use NTHB\Model\Admin\MediaModel;
use NTHB\Model\Admin\PostModel;
use NTHB\Model\Admin\TagModel;
use NTHB\Model\Admin\Pivot\PostCategoryModel;
use NTHB\Model\Admin\Pivot\PostTagModel;
use NTHB\Model\Admin\UserModel;

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
    
    private $admin_user_table_helper;
    private $admin_user_model;
    
    private $admin_comment_table_helper;
    private $admin_comment_model;
    
    private $authentication_helper;

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
        
        $this->admin_user_table_helper = new DatabaseTable(
            UserEntity::TABLE,
            UserEntity::PRIMARY_KEY,
            UserEntity::CLASS_NAME
        );
        $this->admin_user_model = new UserModel($this->admin_user_table_helper);
        
        $this->admin_comment_table_helper = new DatabaseTable(
            PostComment::TABLE,
            PostComment::PRIMARY_KEY,
            PostComment::CLASS_NAME
        );
        $this->admin_comment_model = new CommentModel($this->admin_comment_table_helper);
        
        $this->admin_post_table_helper = new DatabaseTable(
            PostEntity::TABLE,
            PostEntity::PRIMARY_KEY,
            PostEntity::CLASS_NAME,
            [
                &$this->admin_post_category_model,
                &$this->admin_post_tag_model,
                &$this->admin_media_model,
                &$this->admin_user_model,
                &$this->admin_comment_model
            ]
        );
        $this->admin_post_model = new PostModel($this->admin_post_table_helper);


        $this->authentication_helper = new Authentication(
            $this->admin_user_table_helper, 
            UserEntity::KEY_EMAIL, 
            UserEntity::KEY_PASSWORD
        );
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
        $admin_comment_routes = $this->get_admin_comment_routes();

        $auth_routes = $this->get_auth_routes();
        $client_routes = $this->get_client_routes();

        /**
         * Login required
         */
        $admin_dashboard_routes = $this->required_login($admin_dashboard_routes);
        $admin_category_routes = $this->required_login($admin_category_routes);
        $admin_tag_routes = $this->required_login($admin_tag_routes);
        $admin_post_routes = $this->required_login($admin_post_routes);
        $admin_user_routes = $this->required_login($admin_user_routes);

        return $admin_dashboard_routes +
            $admin_category_routes +
            $admin_tag_routes +
            $admin_post_routes +
            $admin_user_routes +
            $admin_comment_routes +
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
        $controller = new UserController($this->admin_user_model);

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
                ],
                'POST' => [
                    'controller' => $controller,
                    'action' => 'store'
                ]
            ]
        ];
    }
    
    public function get_admin_comment_routes(): array
    {
        $controller = new CommentController($this->admin_comment_model);
        
        return [
            '/comment/create' => [
                'POST' => [
                    'controller' => $controller,
                    'action' => 'store'
                ]
            ],
            '/admin/comment' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'index'
                ]
            ],
            '/admin/comment/accept' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'accept_comment'
                ]
            ],
            '/admin/comment/deny' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'deny_comment'
                ]
            ]
        ];
    }

    public function get_auth_routes(): array
    {
        $controller = new AuthController($this->authentication_helper);

        return [
            '/auth/login' => [
                'GET' => [
                    'controller' => $controller,
                    'action' => 'render_login_page'
                ],
                'POST' => [
                    'controller' => $controller,
                    'action' => 'handle_login'
                ]
            ]
        ];
    }

    public function get_client_routes(): array
    {
        $home_controller = new HomeController();
        $blog_controller = new BlogController($this->admin_post_model);
        $about_controller = new AboutController();
        $contact_controller = new ContactController();

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
            ],
            '/about' => [
                'GET' => [
                    'controller' => $about_controller,
                    'action' => 'render_about_page'
                ]
            ],
            '/contact' => [
                'GET' => [
                    'controller' => $contact_controller,
                    'action' => 'render_contact_page'
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
        return $this->authentication_helper;
    }

    public function checkPermission($permission): ?bool
    {
        return null;
    }

    public function required_login($routes): array
    {
        $results = [];

        foreach ($routes as $key => $route) {
            $item = $route;
            $item['login'] = true;

            $results[$key] = $item;
        }

        return $results;
    }
    
    public function getBaseController(): NTHBBaseController
    {
        return new NTHBBaseController();
    }
}
