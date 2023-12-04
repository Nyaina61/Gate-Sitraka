<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Thumbnail;
use App\Entity\FileResource;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


#[AsController]
class UserCustomController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke(Request $req,User $user): User
    {
        return $user;
    }
}
