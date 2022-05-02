<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use Ninja\Utils\NJStringUtils;
use NTHB\Entity\CategoryEntity;

class CategoryModel
{
    private DatabaseTable $category_table_helper;

    public function __construct(DatabaseTable $category_table_helper)
    {
        $this->category_table_helper = $category_table_helper;
    }

    public function get_all($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->category_table_helper->findAll($orderBy, $orderDirection, $limit, $offset);
    }

    public function count()
    {
        return $this->category_table_helper->total();
    }

    /**
     * @throws Exception
     */
    public function create($title, $meta_title, $slug, $content)
    {
        if (empty($slug)) {
            $unique_id = '';

            while (true) {
                if (empty($unique_id)) {
                    $unique_slug = NJStringUtils::slugify($title);
                }
                else {
                    $unique_slug = NJStringUtils::slugify($title . ' ' . $unique_id);
                }

                $results = $this->category_table_helper->find(CategoryEntity::KEY_SLUG, $unique_slug);
                if (count($results) == 0)
                    break;
                else
                    $unique_id = uniqid();
            }
        }

        return $this->category_table_helper->save([
            CategoryEntity::KEY_TITLE => $title,
            CategoryEntity::KEY_META_TITLE => $meta_title,
            CategoryEntity::KEY_SLUG => $unique_slug ?? $slug,
            CategoryEntity::KEY_CONTENT => $content
        ]);
    }
}
