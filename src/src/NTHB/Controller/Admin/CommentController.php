<?php

namespace NTHB\Controller\Admin;

use Exception;
use Ninja\NinjaException;
use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\CommentModel;

class CommentController extends NTHBBaseController
{
    private CommentModel $comment_model;
    
    public function __construct(CommentModel $comment_model)
    {
        parent::__construct();
        
        $this->comment_model = $comment_model;
    }
    
    public function store()
    {
        try {
            $post_id = $_POST['post_id'] ?? null;
            $parent_id = $_POST['parent_id'] ?? null;
            $content = $_POST['content'] ?? null;
            $email = $_POST['email'] ?? null;
            $first_name = $_POST['first_name'] ?? null;
            $last_name = $_POST['last_name'] ?? null;
            $author_id = $_POST['author_id'] ?? null;
            
            $post_slug = $_POST['slug'] ?? null;
            
            $this->comment_model->create($post_id, $parent_id, $content, $email, $first_name, $last_name, $author_id);
            
            $this->route_redirect('/blog/show?post=' . $post_slug);
        }
        catch (NinjaException $exception) {
            die($exception->getMessage());
        }
        catch (Exception $exception) {
            die($exception);
        }
    }
}
