<?php
use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();
$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository($pdo, $userHydrator);

Router::post('/api/login', function($request) use($userRepository, $userHydrator) {
    if (is_null($request->body)) return http_response_code(400);

    $email = $request->body->email;
    $hash = hash('sha256', $request->body->password);
    $user = $userRepository->fetchByEmailAndHash($email, $hash);

    if (!$user) return http_response_code(401);

    $token = \Token\JwtHS256::generate($user->getId(), getenv('SECRET'), time());

    header("Authorization: Bearer $token");
    echo json_encode($userHydrator->extract($user));
});


Router::post('/api/users', function($request) use($userRepository, $userHydrator) {
    if (is_null($request->body) && isset($request->body->email)  && isset($request->body->pseudo) && isset($request->body->password)) return http_response_code(400);

    // Get all the information from the body
    $email = $request->body->email;
    $pseudo = $request->body->pseudo;
    $password = $request->body->password;

    // Check the pattern of the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return http_response_code(400);
    }

    if(strlen($password) < 3 || strlen($pseudo) < 3) return http_response_code(400);

    $hash = hash('sha256', $password);

    // Checking whether or not a account already exist with the same email or pseudo
    if($userRepository->pseudoChecker($pseudo) || $userRepository->emailChecker($email) ){
        return http_response_code(418);
    }

    $user = new \User\User();
    $user->setEmail($email);
    $user->setHash($hash);
    $user->setPseudo($pseudo);
    $user->setRole('USER');

    if(!$userRepository->signupUser($user))
    {
        return http_response_code(500);
    }
    else
    {
        return http_response_code(200);
    }

});
