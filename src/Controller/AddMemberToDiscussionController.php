<?php

namespace App\Controller;

use Assert\Count;
use App\Entity\User;
use App\Entity\Discussion;
use App\Entity\MemberEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Api\IriConverterInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Webmozart\Assert\Assert as AssertAssert;

class AddMemberToDiscussionController extends AbstractController
{
    private $validator;

    public function __construct(private EntityManagerInterface $em, private SerializerInterface $serializer, private IriConverterInterface $iriConverter)
    {
        $this->validator=Validation::createValidator();
    }

    public function __invoke(Discussion $data, Request $request)
    {

        $discu = json_decode($request->getContent());
        $members = [];
        foreach ($discu->members as $value) {
            $members[] = $this->iriConverter->getResourceFromIri($value);
        }
        $constraints=[];
        $constraints[]=new Assert\Count([
            'min'=>'2',
            'minMessage'=>'La discussion doit contenir au moins 2 membres !'
        ]);
        $constraints[]=
            new Assert\Unique(
                message:"Vous ne pouvez pas ajouter le même membre plusieurs fois !"
            );
        $errors=$this->validator->validate($members,$constraints);
        if (count($errors)>0) {
            $formattedErrors=[];

            foreach ($errors as $err) {
                $formattedErrors[]=[
                    'propertyPath'=>$err->getPropertyPath(),
                    'message'=>$err->getMessage()
                ];
            }
           return new JsonResponse(['errors'=>$formattedErrors],400);
        }
        $discussion=new Discussion();
        $discussion->setDiscuName($discu->discuName);
        
        
        $this->em->persist($discussion);
        foreach ($members as $member) {
                $memberEntity = new MemberEntity();
                $memberEntity->setUser($member);
                
                $memberEntity->setDiscussion($discussion);
                $this->em->persist($memberEntity);
        }


        $this->em->flush();

        return $discussion;
    }
}
