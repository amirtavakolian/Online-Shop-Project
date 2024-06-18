<?php

namespace Modules\Ticket\App\Services;

use Illuminate\Support\Str;
use Modules\Product\App\Models\Product;

class FileUploader
{

    public function upload($file, $location, $driver = 'public')
    {
        return $file->storeAs(
            $location, Str::random(20) . '.' . $file->getClientOriginalExtension(),
            $driver
        );
    }

    public function uploadFiles($files, $location, $driver = 'public')
    {
        $filePaths = [];
        foreach ($files as $file) {
            $filePaths[] = $this->upload($file, $location, $driver);
        }
        return $filePaths;
    }

}
