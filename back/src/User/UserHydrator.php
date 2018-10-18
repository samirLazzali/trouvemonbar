<?php

namespace User;

class UserHydrator
{
    public function extract(User $user): array
    {
        $data = [];

        if ($user->getId()) {
            $data['id'] = $user->getId();
        }
        if ($user->getEmail()) {
            $data['email'] = $user->getEmail();
        }
        if ($user->getHash()) {
            $data['hash'] = $user->getHash();
        }
        if ($user->getPseudo()) {
            $data['pseudo'] = $user->getPseudo();
        }
        if ($user->getRole()) {
            $data['role'] = $user->getRole();
        }


        return $data;
    }

    public function hydrate(array $data): User
    {
        return (new User())
            ->setId($data['id'] ?? null)
            ->setEmail($data['email'] ?? null)
            ->setHash($data['hash'] ?? null)
            ->setPseudo($data['pseudo'] ?? null)
            ->setRole($data['role'] ?? null);
    }
}
