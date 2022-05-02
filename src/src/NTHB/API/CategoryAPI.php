<?php

namespace NTHB\API;

use Ninja\NinjaException;
use Ninja\NJTrait\Jsonable;
use Ninja\ResponseHelper;
use NTHB\Model\Admin\CategoryModel;

class CategoryAPI
{
    use Jsonable;
    
    private CategoryModel $category_model;
    
    public function __construct(CategoryModel $category_model)
    {
        $this->category_model = $category_model;
    }
    
    public function store()
    {
        try {
            $data = $this->parse_json_from_request();
            
            $title = $data['title'] ?? null;
            $meta_title = $data['metaTitle'] ?? null;
            $slug = $data['slug'] ?? null;
            $content = $data['content'] ?? null;
            
            if (empty($title)) throw new NinjaException('Tiêu đề không được để trống');
            if (empty($slug)) throw new NinjaException('Slug không được để trống');
            
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
