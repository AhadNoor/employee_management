<?php
/**
 * This file is part of the SalesTool project.
 *
 * @copyright Copyright (c) 2019, BRAC IT SERVICES LIMITED <http://www.bracits.com>
 * @author Roni Kumar Saha <ronikumar.saha@bracits.com>
 */

namespace App\EventSubscriber;

use App\Entity\Employee;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachmentUploader implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate
        );
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->upload($args, true);
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->upload($args);
    }

    private function upload(LifecycleEventArgs $args, $editing = false)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Employee) {
            return;
        }

        $uploadedFile = $entity->getFile();

        if ($uploadedFile == NULL) {
            return;
        }
        if($editing === true && !empty($entity->getAvatar())){
            try {
                unlink($entity->getAvatar());

            } catch (\Exception $exception){
                dump($exception->getMessage());
            }
        }

        $path = $this->getFileName($uploadedFile);
        $uploadedFile->move($this->getUploadDirectory(), basename($path));
        $entity->setAvatar(DIRECTORY_SEPARATOR. $this->getUploadDir() .DIRECTORY_SEPARATOR. basename($path));
    }

    private function getFileName(UploadedFile $file)
    {
        return sha1(uniqid(mt_rand(), TRUE)) . '.' . $file->guessExtension();
    }

    private function getUploadDir()
    {
        $parts = [ "uploads", "attachments"];


        return implode(DIRECTORY_SEPARATOR, $parts);
    }

    public function getUploadDirectory()
    {
        $fileSystem = new Filesystem();
        $fullPath = WEB_ROOT . DIRECTORY_SEPARATOR . $this->getUploadDir();

        if (!$fileSystem->exists($fullPath)) {
            $fileSystem->mkdir($fullPath);
        }

        return $fullPath;
    }
}
