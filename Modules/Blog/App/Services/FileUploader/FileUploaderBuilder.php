<?php

namespace Modules\Blog\App\Services\FileUploader;

class FileUploaderBuilder
{

    public function __construct(private readonly FileUploaderService $fileUploader)
    {
    }

    public function setFile($file)
    {
        $this->fileUploader->setFile($file);
        return $this;
    }

    public function setDirectory($directory)
    {
        $this->fileUploader->setDirectory($directory);
        return $this;
    }

    public function setFileName($fileName)
    {
        $this->fileUploader->setFileName($fileName);
        return $this;
    }

    public function setDisk($disk)
    {
        $this->fileUploader->setDisk($disk);
        return $this;
    }

    public function setFormat($format)
    {
        $this->fileUploader->setFormat($format);
        return $this;
    }

    public function setUploadedFileName($uploadedFileName)
    {
        $this->fileUploader->setUploadedFileName($uploadedFileName);
        return $this;
    }

    public function build(): FileUploaderService
    {
        return $this->fileUploader;
    }
}
