<?php

namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileUploadService{
    public function upload($file, $textAfter='', $directory){
        try {
            $uploadPath = public_path($directory);
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $randomNumber = mt_rand(100, 999);
            $extension = $file->getClientOriginalExtension();
            $filename = 'remnique.com_' . Str::slug($textAfter) . '_' . $randomNumber . '.' . $extension;
            $path = $file->storeAs($directory, $filename);

            Log::channel('single')->info('hah');
            return $path;
        } catch (Exception $e) {
            return $e;
            Log::channel('single')->info($e);
            return $e;
        }
    }
}
