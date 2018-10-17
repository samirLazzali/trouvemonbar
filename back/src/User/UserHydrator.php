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
        if ($user->getFirstname()) {
            $data['firstname'] = $user->getFirstname();
        }
        if ($user->getLastname()) {
            $data['lastname'] = $user->getLastname();
        }
        if ($user->getBirthday()) {
            $data['birthday'] = $user->getBirthday();
        }

        return $data;
    }
}
