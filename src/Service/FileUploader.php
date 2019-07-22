<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\File;
use Doctrine\Common\Persistence\ObjectManager;

class FileUploader
{
    private $targetDirectory;

    public function __construct(ObjectManager $objectManager, $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
        $this->objectManager = $objectManager;
    }

    public function upload(UploadedFile $file)
    {
        try {
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getTargetDirectory(), $fileName);
            $fileToSave = new File();
            $fileToSave->setFile($fileName);
            $this->objectManager->persist($fileToSave);
            $this->objectManager->flush($fileToSave);
            return $fileToSave;
        } catch (FileException $e) {
            throw $e;
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
