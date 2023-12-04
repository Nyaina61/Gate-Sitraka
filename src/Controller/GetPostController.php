<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Thumbnail;
use App\Entity\FileResource;
use App\Entity\ProfilePicture;
use App\Repository\PostRepository;
use App\Repository\ProfilePictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


#[AsController]
class GetPostController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke(Request $req,Post $post,ProfilePictureRepository $profilePictureRepository): Post
    {
        return $post;
    }
}
