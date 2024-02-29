<?php

namespace Modules\Product\App\Services;

use Illuminate\Support\Str;

class FileUploader
{

    public function upload($file, $location, $driver = 'local')
    {
        return $file->storeAs(
            $location, Str::random(20) . '.' . $file->getClientOriginalExtension(),
            $driver
        );
    }

    public function uploadFiles($files, $location, $driver = 'local')
    {
        $filePaths = [];
        foreach ($files as $file) {
            $filePaths[] = $this->upload($file, $location, $driver);
        }
        return $filePaths;
    }
}
