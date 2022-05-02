<?php

namespace NTHB;

use Ninja\DatabaseTable;
use Ninja\NJInterface\IRoutes;
use NTHB\API\CategoryAPI;
use NTHB\Controller\Admin\AdminCategoryController;
use NTHB\Controller\Admin\AdminDashboardController;
use NTHB\Controller\Admin\AdminTagController;
use NTHB\Entity\CategoryEntity;
use NTHB\Entity\TagEntity;
use NTHB\Model\Admin\CategoryModel;
use NTHB\Model\Admin\TagModel;

class NTHBRoutesHandler implements IRoutes
{
    private $admin_category_table_helper;
    private $admin_category_model;
    
    private $admin_tag_table_helper;
    private $admin_tag_model;
    
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
        
        return $admin_dashboard_routes + $admin_category_routes + $admin_tag_routes;
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

    public function get_all_api_routes(): array
    {
        $category_api = new CategoryAPI($this->admin_category_model);
        
        return [
            '/api/v1/category' => [
                'POST' => [
                    'controller' => $category_api,
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
