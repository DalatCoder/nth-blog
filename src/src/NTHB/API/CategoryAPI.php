<?php

namespace NTHB\API;

use Ninja\NinjaException;
use Ninja\RequestHelper;
use Ninja\ResponseHelper;
use NTHB\Model\Admin\CategoryModel;

class CategoryAPI
{
    private CategoryModel $category_model;
    
    public function __construct(CategoryModel $category_model)
    {
        $this->category_model = $category_model;
    }
    
    public function store()
    {
        try {
            $request_helper = new RequestHelper();
            
            $title = $request_helper->get('title');
            $meta_title = $request_helper->get('metaTitle');
            $slug = $request_helper->get('slug');
            $content = $request_helper->get('content');
            
            if (empty($title)) throw new NinjaException('Tiêu đề không được để trống');
            
            $category = $this->category_model->create($title, $meta_title, $slug, $content);
            ResponseHelper::getInstance()->createdSuccess($category, 'Tạo thể loại mới thành công');
        }
        catch (NinjaException $exception) {
            ResponseHelper::getInstance()->badRequest($exception->getMessage());
        }
        catch (\Exception $exception) {
            ResponseHelper::getInstance()->serverError();
        }
    }
}
