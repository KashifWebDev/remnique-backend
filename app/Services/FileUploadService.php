<?php

namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileUploadService{
    public function upload($file, $textAfter='', $directory){
        $directory = 'uploads'.$directory;
        try {
            $uploadPath = public_path($directory);
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $randomNumber = mt_rand(100, 999);
            $extension = $file->getClientOriginalExtension();
            $filename = 'remnique.com_' . Str::slug($textAfter) . '_' . $randomNumber . '.' . $extension;
        $name = time() . "_" . $file->getClientOriginalName();

            $path = $file->move($uploadPath, $name);

            Log::channel('single')->info('hah');
            return $path;
        } catch (Exception $e) {
            Log::channel('single')->info($e);
            return $e;
        }

    }

//    public function test(){
//        $logo = $request->file('screenshot');
//        $name = time() . "_" . $logo->getClientOriginalName();
//        $uploadPath = ('public/images/screenshot/');
//        $logo->move($uploadPath, $name);
//        $logoImgUrl = $uploadPath . $name;
//        $webinfo->screenshot = $logoImgUrl;
//    }
}
