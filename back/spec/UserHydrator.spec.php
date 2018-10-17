<?
namespace User;

describe("UserHydrator", function() {
    it("should extract a user", function() {
        $userHydrator = new UserHydrator();
        $user = (new User())
            ->setId(1)
            ->setFirstname("bob")
            ->setLastname("marley")
            ->setBirthday(new \DateTimeImmutable("1995-05-22"));

        $data = $userHydrator->extract($user);

        expect($data)->toEqual([
            "id" => 1,
            "firstname" => "bob",
            "lastname" => "marley",
            "age" => 23
        ]);
    });
});
