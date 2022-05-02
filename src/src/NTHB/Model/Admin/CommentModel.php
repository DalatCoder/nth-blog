<?php

namespace NTHB\Model\Admin;

use Exception;
use Ninja\DatabaseTable;
use NTHB\Entity\PostComment;

class CommentModel
{
    private DatabaseTable $comment_table_helper;
    
    public function __construct(DatabaseTable $comment_table_helper)
    {
        $this->comment_table_helper = $comment_table_helper;
    }

    public function get_all($orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->comment_table_helper->findAll($orderBy, $orderDirection, $limit, $offset);
    }
    
    public function get_all_by_post($post_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null)
    {
        return $this->comment_table_helper->find(
            PostComment::KEY_POST_ID,
            $post_id,
            '=',
            $orderBy,
            $orderDirection,
            $limit,
            $offset
        );
    }

    public function get_all_accepted_by_post($post_id, $orderBy = null, $orderDirection = null, $limit = null, $offset = null): array
    {
        $comments = $this->get_all_by_post($post_id);
        
        $accepts = [];
        foreach ($comments as $comment) {
            if (!is_null($comment->{PostComment::KEY_PUBLISHED_AT}))
                $accepts[] = $comment;
        }
        
        return $accepts;
    }

    public function count()
    {
        return $this->comment_table_helper->total();
    }

    /**
     * @throws Exception
     */
    public function create($post_id, $parent_id, $content, $email, $first_name, $last_name, $author_id, $published_at = null)
    {
        return $this->comment_table_helper->save([
            PostComment::KEY_POST_ID => $post_id,
            PostComment::KEY_PARENT_ID => $parent_id,
            PostComment::KEY_CONTENT => $content,
            PostComment::KEY_EMAIL => $email,
            PostComment::KEY_FIRST_NAME => $first_name,
            PostComment::KEY_LAST_NAME => $last_name,
            PostComment::KEY_AUTHOR_ID => $author_id,
            PostComment::KEY_PUBLISHED_AT => $published_at
        ]);
    }
}
