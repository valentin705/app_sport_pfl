<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadsFile
{
    public function uploadFile(UploadedFile $file, SluggerInterface $slugger, string $directory): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
        try {
            $file->move($directory, $newFilename);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        return $newFilename;
    }
}