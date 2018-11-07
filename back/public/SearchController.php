<?php

use \Router\Router;

$pdo =\Database\DatabaseSingleton::getInstance();

$keywordRepository = new \Keyword\KeywordRepository($pdo);
$barRepository = new \Bar\BarRepository($pdo);
$keywordHydrator = new \Keyword\KeywordHydrator();
$barHydrator = new \Bar\BarHydrator();

Router::get('/api/barlist\?idUser\=(.+)\&idBar\=(.+)\&barlist\=(.+)', function($request) use ($barRepository)
{

    // http://localhost:3000/api/barlist?idUser=1&idBar=1&barlist=black
    $idUser = intval($request->params[0]);
    $idBar = intval($request->params[1]);
    $barlist = $request->params[2];

    if ((strval($idBar) !== $request->params[1]) &&
        (strval($idUser) !== $request->params[0]) &&
        (strval($barlist) !== $request->params[2])) {
        http_response_code(400);
        echo json_encode(array('error' => 'Parameters are not correct.'));
        return;
    }

    if(!$barRepository->addBarInList($idUser,$idBar,$barlist))
    {
        return http_response_code(500);
    } else {
        return http_response_code(201);
    }
    return;
});



Router::get('/api/addbar\?keywords\=(.+)', function($request) use($barHydrator) {
    // http://localhost:3000/api/addbar?keywords=%22o%22
    // query execution - get data
    $keywords = urldecode($request->params[0]);
    $ch = curl_init();

    $location='48.8566,2.3522'; // centre de Paris
    $radius='50000'; // max
    //$type='bar,night_club,point_of_interest,establishment';
    $type='bar|night_club';
    $key = 'AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo';
    $keyword= rawurlencode($keywords);


    $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';
    $url .= 'location='.$location.'&';
    $url .= 'radius='.$radius.'&';
    $url .= 'type='.$type.'&';
    $url .= 'keyword='.$keyword.'&';
    $url .= 'key='.$key;


    curl_setopt($ch, CURLOPT_URL, $url);
    // Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Get the response and close the channel.
    $response = curl_exec($ch);
    $arrayResponse = json_decode($response,true);

    curl_close($ch);


    // récupération des bars
    $bars = [];
    foreach ($arrayResponse['results'] as $value) {
        // j'ai mis une photo par defaut d'un bar random
        $photoref = "https://lefooding.com/media/W1siZiIsIjIwMTYvMDcvMTgvMTRfMzJfMjZfNTk0X2Jhcl9oYXJyeXNfbmV3X3lvcmtfYmFyX3BhcmlzLmpwZyJdLFsicCIsInRodW1iIiwiNjcyeDYwMCJdXQ/bar-harrys-new-york-bar-paris.jpg?sha=3a132a68";
        if(array_key_exists('photos',$value)){
            $photoref = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=".$value['photos'][0]['photo_reference']."&key=AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo";
        }
        $rating = -1;
        if(array_key_exists('rating', $value)){
            $rating = $value['rating'];
        }
        $tmp_bar = (new \Bar\Bar())
            ->setId(-1)
            ->setName($value["name"])
            ->setPhoto($photoref)
            ->SetRating($rating)
            ->SetAddress($value['vicinity'])
            ->setPlaceId($value['place_id'])
            ->setLat($value["geometry"]['location']['lat'])
            ->setLng($value["geometry"]['location']['lng']);
        array_push($bars,$tmp_bar);
    }

    if (!$bars) return http_response_code(500);

    echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);

});

Router::post('/api/addbar', function($request) use($barRepository, $barHydrator) {
    // if (is_null($request->body)) return http_response_code(400);

    /*
    if (!$userValidator->validate($request->body)) {
        return http_response_code(400);
    }
    */
    $isStored = $barRepository->isStored($request->body->bar->placeId);
    var_dump($isStored);
    if($isStored == null) {
        // inserrer le bar et retourner son id
        $tmpBar = (new \Bar\Bar())
            ->setName($request->body->data->bar->name)
            ->setPhoto($request->body->bar->photoReference ? $request->body->data->bar->photoReference : 'NULL')
            ->SetRating($request->body->bar->rating ? $request->body->data->bar->rating : 'NULL')
            ->SetAddress($request->body->data->bar->address)
            ->setLat($request->body->data->bar->lat)
            ->setLng($request->body->data->bar->lng)
            ->setPlaceId($request->body->data->bar->placeId);
        $barRepository->creatBar($tmpBar);
    }

});