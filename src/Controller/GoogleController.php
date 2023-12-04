<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Gesdinet\JWTRefreshTokenBundle\Generator\RefreshTokenGeneratorInterface;


class GoogleController extends AbstractController
{

    public function __construct(
        private ClientRegistry $clientRegistry,
        private EntityManagerInterface $entityManager,
        private JWTTokenManagerInterface $jwtManager, // Ajoutez ContainerInterface ici
        private RefreshTokenGeneratorInterface $refreshTokenGenerator,
        private RefreshTokenManagerInterface $refreshTokenManager
    ) {
    }

    #[Route('/connect/{provider}', name: 'connect_social')]
    public function connectAction(ClientRegistry $clientRegistry,Request $request)
    {
        //Redirect to google
        return $clientRegistry->getClient($request->attributes->get('provider'))->redirect([], []);
    }

    /**
     * After going to Google, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route('/connect/{provider}/check', name: 'connect_social_check')]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry, RefreshTokenManagerInterface $refreshTokenManager)
    {
        
        $provider=$request->attributes->get('provider');
        $client = $clientRegistry->getClient($provider);
        $providerMappings = [
            'google' => 'Google',
            'facebook' => 'Fb',
            'linkedin'=>'Linkedin'
        ];
        $providerName = $providerMappings[$provider] ?? $providerMappings['google'];


        try {
            $socialUser = $client->fetchUser();

            $user = $this->entityManager->getRepository(User::class)->findOneBy([
                strtolower($providerName)."Id" => $socialUser->getId()
            ]);

            

            if (!$user) {
                $userWithEmail = $this->entityManager->getRepository(User::class)->findOneBy([
                    "email" => $socialUser->getEmail()
                ]);
                if($userWithEmail){
                    $user=$userWithEmail;
                }else{
                    $user=new User();
                    $user
                    ->setFirstName(explode(' ', $socialUser->getName())[0])
                    ->setFirstName(explode(' ', $socialUser->getName())[1])
                    ->setEmail($socialUser->getEmail());
                }
                $user->{"set{$providerName}Id"}($socialUser->getId());
                

                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }


            $token = $this->jwtManager->create($user);
            $cookie = Cookie::create('BEARER')
                ->withValue($token)
                ->withPath('/')
                ->withHttpOnly(false)
                ->withSecure(true);

            $refreshToken = $this->refreshTokenGenerator->createForUserWithTtl($user, 86400);
            $this->refreshTokenManager->save($refreshToken);

            

            // Ajoutez le refresh token dans un cookie
            $refreshCookie = Cookie::create('refresh_token')
                ->withValue($refreshToken->getRefreshToken())
                ->withPath('/')
                ->withHttpOnly(false)
                ->withSecure(true);

            // Rediriger l'utilisateur vers le front-end React avec le cookie
            $response = new RedirectResponse('https://localhost:3000');
            $response->headers->setCookie($cookie);
            $response->headers->setCookie($refreshCookie);
        } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            var_dump($e->getMessage());
            die;
        }

        // Créer un cookie sécurisé pour stocker le token


        return $response;
    }
}
