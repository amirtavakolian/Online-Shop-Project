<?php

namespace Modules\Blog\App\Services\FileUploader;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Str;

class FileUploaderService
{
    private $directory = "";
    private $fileName = "";
    private $format = "";
    private $disk = "";
    private $file = "";

    public function setFile($file)
    {
        if (empty($file)) {
            throw new InvalidArgumentException('فایل وارد نشده است');
        }
        $this->file = $file;
    }

    public function setDirectory($directory): void
    {
        $this->directory = $directory;
    }

    public function setDisk($disk)
    {
        $this->directory = $disk;
    }

    public function setFileName($fileName): void
    {
        $this->fileName = $fileName;
    }

    public function setFormat($format): void
    {
        $this->format = $format;
    }

    public function storeAs()
    {
        $this->directory = empty($this->directory) ? '/' : $this->directory;
        $this->fileName = empty($this->fileName) ? Str::random(12) : $this->fileName;
        $this->disk = empty($this->disk) ? 'public' : $this->disk;
        $this->format = empty($this->format) ? $this->file->getClientOriginalExtension() : $this->format;

        return $this->file->storeAs(
            $this->directory, $this->fileName . "." . $this->format, $this->disk
        );
    }

}
