<?php

namespace App\Controller;

use ApiPlatform\Doctrine\Orm\Extension\QueryResultItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGenerator;
use App\Doctrine\CustomItemExtension;
use App\Entity\ProfilePicture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;



class ProfilePictureUploadController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler,private Security $security)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke(Request $request)
    {
        $currentUser = $this->security->getUser();
        $imgs = $this->entityManager->getRepository(ProfilePicture::class)->findBy(
            ['user'=> $currentUser,'active' => 1]
        );
        foreach ($imgs as $img) {
            $img->setActive(0);
        }
        $this->entityManager->flush();

        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }
        $mediaObject = new ProfilePicture();
        $mediaObject->setFile($uploadedFile);

        return $mediaObject;
    }
}
