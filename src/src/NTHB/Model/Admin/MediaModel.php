<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use NTHB\Entity\MediaEntity;

class MediaModel
{
    private DatabaseTable $media_table_helper;
    
    public function __construct(DatabaseTable $media_table_helper)
    {
        $this->media_table_helper = $media_table_helper;
    }

    public function get_all($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->media_table_helper->findAll($orderBy, $orderDirection, $limit, $offset);
    }
    
    public function get_by_id($id)
    {
        return $this->media_table_helper->findById($id);
    }

    public function count()
    {
        return $this->media_table_helper->total();
    }

    /**
     * @throws Exception
     */
    public function create($file_name, $file_type, $file_size, $file_location, $media_type)
    {
        return $this->media_table_helper->save([
            MediaEntity::KEY_FILE_NAME => $file_name,
            MediaEntity::KEY_FILE_TYPE => $file_type,
            MediaEntity::KEY_FILE_SIZE => $file_size,
            MediaEntity::KEY_FILE_LOCATION => $file_location,
            MediaEntity::KEY_MEDIA_TYPE => $media_type
        ]);
    }
}
