<?php

namespace NTHB;

use Ninja\DatabaseTable;
use Ninja\NJInterface\IRoutes;
use NTHB\Controller\Admin\AdminCategoryController;
use NTHB\Controller\Admin\AdminDashboardController;
use NTHB\Entity\CategoryEntity;
use NTHB\Model\Admin\CategoryModel;

class NTHBRoutesHandler implements IRoutes
{
    private $admin_category_table_helper;
    private $admin_category_model;
    
    public function __construct()
    {
        $this->admin_category_table_helper = new DatabaseTable(
            CategoryEntity::TABLE,
            CategoryEntity::PRIMARY_KEY,
            CategoryEntity::CLASS_NAME
        );
        $this->admin_category_model = new CategoryModel($this->admin_category_table_helper);
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
        
        return $admin_dashboard_routes + $admin_category_routes;
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

    public function get_all_api_routes(): array
    {
        return [];
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
