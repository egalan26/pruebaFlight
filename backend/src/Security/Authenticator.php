<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class Authenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{

    public function start(Request $request, ?AuthenticationException $authException = null)
    {
        return new JsonResponse('Not authenticated', 200);
    }

    public function supports(Request $request): ?bool
    {
        return true;
    }

    public function authenticate(Request $request)
    {
        $authorizationBearer = $request->headers->get('authorization');
        if (!$authorizationBearer){
            throw new AuthenticationException("Authorization bearer not present");
        }
        [,$authenticationToken] = explode(" ", $authorizationBearer);
        if ($authenticationToken == 'logged'){
            // TODO authorization token simplified. It must be completed to get a real authentication
            return new SelfValidatingPassport(new UserBadge($authenticationToken));
        }
        throw new AuthenticationException("Authentication failed.");
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return null;
    }
}