<?php

namespace NTHB\API;

use Ninja\NinjaException;
use Ninja\RequestHelper;
use Ninja\ResponseHelper;
use NTHB\Model\Admin\TagModel;

class TagAPI
{
    private TagModel $tag_model;
    
    public function __construct(TagModel $tag_model)
    {
        $this->tag_model = $tag_model;
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
            if (empty($slug)) throw new NinjaException('Slug không được để trống');

            $tag = $this->tag_model->create($title, $meta_title, $slug, $content);
            ResponseHelper::getInstance()->createdSuccess($tag, 'Tạo tag mới thành công');
        }
        catch (NinjaException $exception) {
            ResponseHelper::getInstance()->badRequest($exception->getMessage());
        }
        catch (\Exception $exception) {
            ResponseHelper::getInstance()->serverError();
        }
    }
}
