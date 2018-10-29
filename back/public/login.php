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

    $token = \Token\JwtHS256::generate($user->getId(), getenv('SECRET'), time() + (60 * 30));

    header("Authorization: Bearer $token");
    echo json_encode($userHydrator->extract($user));
});


Router::post('/api/users', function($request) use($userRepository, $userHydrator) {
    if (is_null($request->body) || !(isset($request->body->email)  && isset($request->body->pseudo) && isset($request->body->password))) return http_response_code(400);

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

Router::put('/api/users/{}', function($request) use($userRepository, $userHydrator) {
    // Get the token, check validity and if valid get the user
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $userId = JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchById($userId);
    } catch (Exception $e) {
        http_response_code(401);
        return;
    }

    // Check parameter
    if (is_null($request->body) || !(isset($request->params[0]) && isset($request->body->user->password))) return http_response_code(400);


    // Get all the information from the body
    $str_id = $request->params[0];
    $id = ctype_digit($str_id) ? intval($str_id) : null;
    if ($id === null)
    {
        return http_response_code(400);
    }

    $password = $request->body->user->password;

    if(strlen($password) < 3) return http_response_code(400);

    $hash = hash('sha256', $password);

    if(!$userRepository->updatePassword($id,$hash))
    {
        return http_response_code(500);
    }
    else
    {
        return http_response_code(200);
    }

});
