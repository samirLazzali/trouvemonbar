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
        if (sizeof($user->getkeywords()) > 0) {
            $data['keywords'] = $user->getKeywords();
        }

        return $data;
    }

    public function extractAll($users)
    {
        $data = [];
        foreach ($users as $user) {
            $data[] = $this->extract($user);
        }
        return $data;
    }
}
