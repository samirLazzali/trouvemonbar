<?php
namespace User;

describe('UserRepository', function() {
    it('should fetch all users', function() {
        $userRepository = new UserRepository(new MockPDO(), new UserHydrator());

        $users = $userRepository->fetchAll();

        expect($users[0]->getId())->toBe(1);
        expect($users[0]->getFirstname())->toBe('bob');
        expect($users[0]->getLastname())->toBe('marley');
        expect($users[0]->getAge())->toBe(23);

        expect($users[1]->getId())->toBe(2);
        expect($users[1]->getFirstname())->toBe('bob2');
        expect($users[1]->getLastname())->toBe('marley2');
        expect($users[1]->getAge())->toBe(16);
    });
});

class MockPDO {
    public function query() {
        return $this;
    }
    public function fetchAll() {
        return [
            [
                'id' => 1,
                'firstname' => 'bob',
                'lastname' => 'marley',
                'birthday' => '1995-05-22'
            ],
            [
                'id' => 2,
                'firstname' => 'bob2',
                'lastname' => 'marley2',
                'birthday' => '2001-11-12'
            ]
        ];
    }
}
