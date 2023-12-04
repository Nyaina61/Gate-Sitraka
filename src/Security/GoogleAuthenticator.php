<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\ProfilePicture;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\File\File;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\HttpFoundation\Cookie;

class GoogleAuthenticator extends OAuth2Authenticator
{

    public function __construct(private ClientRegistry $clientRegistry, private EntityManagerInterface $entityManager, private RouterInterface $router)
    {
    }

    public function supports(Request $request): ?bool
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return $request->attributes->get('_route') === 'connect_google_check';
    }

    public function authenticate(Request $request): Passport
    {
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function () use ($accessToken, $client) {

                $googleUser = $client->fetchUserFromToken($accessToken);
                $userData = $googleUser->toArray();
                $email = $googleUser->getEmail();


                // 1) have they logged in with Facebook before? Easy!
                $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['fbId' => $googleUser->getId()]);

                if ($existingUser) {
                    return $existingUser;
                }

                // 2) do we have a matching user by email?
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
                if ($user) {
                    $user->setGoogleId($googleUser->getId());
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                } else {
                    $user = new User();
                    $user
                        ->setGoogleId($googleUser->getId())
                        ->setFirstName(explode(' ', $googleUser->getName())[0])
                        ->setFirstName(explode(' ', $googleUser->getName())[1])
                        ->setEmail($email);
                    $picture = $userData['picture'];
                    // $picture = file_get_contents($picture);
                    // $imageFile = new File(tempnam(sys_get_temp_dir(), 'image_'), false);
                    // file_put_contents($imageFile->getPathname(), $picture);
                    // $mediaObject = new ProfilePicture();
                    // $mediaObject->setFile($imageFile);
                    // $mediaObject->setExtUrl($picture);

                    // $user->addProfilePicture($mediaObject);
                    // $mediaObject->setUser($user);
                    $this->entityManager->persist($user);
                    // $this->entityManager->persist($mediaObject);
                    $this->entityManager->flush();
                }

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse('https://127.0.0.1:3000');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'error' => 'Authentication failed: '.$exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }

    //    public function start(Request $request, AuthenticationException $authException = null): Response
    //    {
    //        /*
    //         * If you would like this class to control what happens when an anonymous user accesses a
    //         * protected page (e.g. redirect to /login), uncomment this method and make this class
    //         * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface.
    //         *
    //         * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
    //         */
    //    }
}
