<?php

namespace NTHB\Controller\Admin;

use NTHB\Controller\NTHBBaseController;
use NTHB\Model\Admin\MediaModel;

class AdminMediaController extends NTHBBaseController
{
    private MediaModel $media_model;
    
    public function __construct(MediaModel $media_model)
    {
        parent::__construct();
        
        $this->media_model = $media_model;
    }
    
    public function index()
    {
        $medias = $this->media_model->get_all();

        $this->view_handler->render('admin/media/index.html.php', [
            'medias' => $medias
        ]);
    }
}
