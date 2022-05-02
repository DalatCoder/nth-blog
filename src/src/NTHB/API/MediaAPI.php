<?php

namespace NTHB\API;

use Ninja\NinjaException;
use Ninja\RequestHelper;
use Ninja\ResponseHelper;
use NTHB\Entity\MediaEntity;
use NTHB\Model\Admin\MediaModel;
use NTHB\Service\FileStorage;

class MediaAPI
{
    private MediaModel $media_model;
    
    public function __construct(MediaModel $media_model)
    {
        $this->media_model = $media_model;
    }

    public function store()
    {
        try {
            $service = new FileStorage();

            $result = $service->upload('file');
            
            $media = $this->media_model->create(
                $result[MediaEntity::KEY_FILE_NAME],
                $result[MediaEntity::KEY_FILE_TYPE],
                $result[MediaEntity::KEY_FILE_SIZE],
                $result[MediaEntity::KEY_FILE_LOCATION],
                $result[MediaEntity::KEY_MEDIA_TYPE],
            );

            $scheme = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $path = $result[MediaEntity::KEY_FILE_LOCATION];
            
            $response_data = [
                'media' => $media,
                'scheme' => $scheme,
                'host' => $host,
                'path' => $path
            ];

            ResponseHelper::getInstance()->createdSuccess($response_data, 'Tạo tập tin mới thành công');
        }
        catch (NinjaException $exception) {
            ResponseHelper::getInstance()->badRequest($exception->getMessage());
        }
        catch (\Exception $exception) {
            ResponseHelper::getInstance()->serverError();
        }
    }
}
