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
        if ($user->getAge()) {
            $data['age'] = $user->getAge();
        }

        return $data;
    }

    public function hydrate(array $data): User
    {
        return (new User())
            ->setId($data['id'] ?? null)
            ->setFirstname($data['firstname'] ?? null)
            ->setLastname($data['lastname'] ?? null)
            ->setBirthday(new \DateTime($data['birthday']));
    }
}
