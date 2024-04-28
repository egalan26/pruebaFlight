<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{

    public function loadUserByIdentifier($identifier): UserInterface
    {
        // TODO look for user in user storage (e.g. DB)
        // i'll create an user, always authenticated
        return new User($identifier, "password");
    }

    public function loadUserByUsername($username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }
}
