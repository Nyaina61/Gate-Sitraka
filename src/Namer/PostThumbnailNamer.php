<?php

namespace App\Namer;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Naming\OrignameNamer;
use Symfony\Component\HttpFoundation\RequestStack;

class PostThumbnailNamer implements NamerInterface
{
    private $orignameNamer;
    private $requestStack;

    public function __construct(OrignameNamer $orignameNamer, RequestStack $requestStack)
    {
        $this->orignameNamer = $orignameNamer;
        $this->requestStack = $requestStack;
    }

    public function name($object, PropertyMapping $mapping): string
    {
       
        // Call the name method of the OrignameNamer
        $fileName = $this->orignameNamer->name($object, $mapping);

        // Get the current request
        $request = $this->requestStack->getCurrentRequest();

        // Get the host from the request
        // $host = $request->getHost();

        // Get the upload directory from the mapping
        $uploadDirectory = $mapping->getUploadDestination();

        // Prepend the host and upload directory to the file name
        $fileName = $fileName;

        return $fileName;
    }
}