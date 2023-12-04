<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Thumbnail;
use App\Entity\FileResource;
use App\Entity\CommentRelation;
use App\Entity\AuthorTypeRelation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


#[AsController]
class CustomImageController extends AbstractController
{
    private $entityManager;
    private $uploadHandler;

    public function __construct(EntityManagerInterface $entityManager, UploadHandler $uploadHandler, private Security $security)
    {
        $this->entityManager = $entityManager;
        $this->uploadHandler = $uploadHandler;
    }

    public function __invoke(Request $req)
    {
        $em = $this->entityManager;
        $comments = $em->getRepository(Comment::class)->findCommentsByEntity('Image',$req->attributes->get('id'));
        
        // Retournez les résultats dans la réponse JSON
        return $this->json($comments);
    

    }
}
