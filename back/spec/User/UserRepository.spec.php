<?php
namespace User;

describe('UserRepository', function() {
    it('should fetch all users', function() {
        $userRepository = new UserRepository(new MockPDO(), new UserHydrator());

        $users = $userRepository->fetchAll();

        expect(sizeof($users))->toBe(2);

        expect($users[0]->getId())->toBe(1);
        expect($users[0]->getEmail())->toBe('bob.marley@gmail.com');
        expect($users[0]->getHash())->toBe('HASH');
        expect($users[0]->getPseudo())->toBe('boby');
        expect($users[0]->getRole())->toBe('USER');

        expect($users[1]->getId())->toBe(2);
        expect($users[1]->getEmail())->toBe('bob.marley@gmail.com');
        expect($users[1]->getHash())->toBe('HASH');
        expect($users[1]->getPseudo())->toBe('boby');
        expect($users[1]->getRole())->toBe('USER');
    });
});

class MockPDO {

    public function prepare(){}
    
    public function query() {
        return $this;
    }
    public function fetchAll() {
        return [
            (new User())
            ->setId(1)
            ->setEmail('bob.marley@gmail.com')
            ->setHash('HASH')
            ->setPseudo('boby')
            ->setRole('USER')
            ,
            (new User())
            ->setId(2)
            ->setEmail('bob.marley@gmail.com')
            ->setHash('HASH')
            ->setPseudo('boby')
            ->setRole('USER')
        ];
    }
}
