<?php
namespace User;

describe("User", function() {
    it("should compute the age", function() {
        $user = (new User())
            ->setBirthday(new \DateTime('-10 years'));

        expect($user->getAge())->toBe(10);
    });

    it("should throw an OutOfRangeException when birthday is in the future", function() {
        $closure = function() {
            $user = (new User())
                ->setBirthday(new \DateTime('+10 years'));
            $user->getAge();
        };

        expect($closure)->toThrow(new \OutOfRangeException("Birthday in the future"));
    });
});
