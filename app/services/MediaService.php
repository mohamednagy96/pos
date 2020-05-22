<?php
namespace App\Services;

class MediaService{
    public static function uploadFile($file,$model,$collection='image'){
        $model->addMedia($file)->toMediacollection($collection);
    }

    public static function uploadFiles($files=[],$model,$collection='image'){
        $files=is_array($files) ? $files : [];
        if(count($files)){
            foreach($files as $file){
                $model->addMedia($file)->toMediacollection($collection);
            }
        }
    }

    public static function updateFile($file,$model,$collection='image'){
        if($model->getFirstMedia($collection)){
            $model->getFirstMedia($collection)->delete();
            }
            $model->addMedia($file)->toMediaCollection($collection);
    }

}