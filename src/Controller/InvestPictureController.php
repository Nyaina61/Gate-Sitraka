<?php

namespace App\Controller;

use App\Entity\InvestPicture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InvestPictureController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler, private Security $security)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke(Request $request)
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile)
        {
            throw new BadRequestHttpException('"file" is required');
        }
        $mediaObject = new InvestPicture();
        $mediaObject->setFile($uploadedFile);

        return $mediaObject;
    }
}
