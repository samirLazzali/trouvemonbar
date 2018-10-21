<?php
namespace User;

describe('UserHydrator', function() {
    beforeEach(function() {
        $this->userHydrator = new UserHydrator();
    });

    it('should extract a user', function() {
        $user = (new User())
            ->setId(1)
            ->setFirstname('bob')
            ->setLastname('marley')
            ->setBirthday(new \DateTimeImmutable('1995-05-22'));

        $data = $this->userHydrator->extract($user);

        expect($data)->toEqual([
            'id' => 1,
            'firstname' => 'bob',
            'lastname' => 'marley',
            'age' => 23
        ]);
    });

    it('should hydrate a user', function() {
        $data = [
            'id' => 1,
            'firstname' => 'bob',
            'lastname' => 'marley',
            'birthday' => '1995-05-22'
        ];

        $user = $this->userHydrator->hydrate($data);

        expect($user->getId())->toBe(1);
        expect($user->getFirstname())->toBe('bob');
        expect($user->getLastname())->toBe('marley');
        expect($user->getAge())->toBe(23);
    });
});
