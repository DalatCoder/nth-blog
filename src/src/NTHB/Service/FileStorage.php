<?php

namespace NTHB\Service;

use Ninja\NinjaException;
use Ninja\Utils\UUID;
use NTHB\Entity\MediaEntity;

class FileStorage
{
    /**
     * @throws NinjaException
     */
    public function upload($form_key = 'file_upload'): array
    {
        // 1. Kiểm tra thông tin ảnh
        $valid_types = ['image'];

        $type = $_FILES[$form_key]['type'];

        foreach ($valid_types as $valid_type) {
            if (strpos($type, $valid_type) < 0)
                throw new NinjaException('Tập tin không hợp lệ');
        }
        
        $parts = explode('/', $type);
        if (count($parts) != 2)
            throw new NinjaException('Loại tập tin không hợp lệ');
        
        $file_type = $parts[1];
        $media_type = $type;

        if ($_FILES[$form_key]['error'] != 0)
            throw new NinjaException('Lỗi xảy ra khi tải tập tin lên server');
        
        $path_parts = pathinfo($_FILES[$form_key]['name']);
        $base_name = $path_parts['filename'];
        $file_extension = $path_parts['extension'];
        
        if (empty($base_name))
            throw new NinjaException('Tên tập tin không hợp lệ');
        
        if (empty($file_extension))
            throw new NinjaException('Loại tập tin không hợp lệ');
        
        // 2. Di chuyển ảnh vào thư mục lưu trữ lâu dài
        $unique_base_name = UUID::guidv4();
        $unique_name = $unique_base_name . '.' . $file_extension;

        $file_tmp_location = $_FILES[$form_key]['tmp_name'];

        $file_location = ROOT_DIR . '/public_html/uploads/' . $unique_name;
        
        $file_size = $_FILES[$form_key]['size'] ?? 0;

        $success = move_uploaded_file($file_tmp_location, $file_location);

        if (!$success)
            throw new NinjaException('Lỗi xảy ra khi tải tập tin lên server');

        $file_location_db = '/uploads/' . $unique_name;

        return [
            MediaEntity::KEY_FILE_NAME => $base_name . '.' . $file_extension,
            MediaEntity::KEY_FILE_LOCATION => $file_location_db,
            MediaEntity::KEY_MEDIA_TYPE => $media_type,
            MediaEntity::KEY_FILE_SIZE => $file_size,
            MediaEntity::KEY_FILE_TYPE => $file_type
        ];
    }
}
