<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$apikey = 'a38';
$users = [
    ['user' => 'sami','pass' => '1234'],
    ['user' => 'vico','pass' => '1234'],
    ['user' => 'ben','pass' => '1234'],
    ['user' => 'luca','pass' => '1234'],
];

if($_SERVER["REQUEST_METHOD"] === 'POST') {

    header("Content-Type: application/json");

    $post = $_POST;

    if(isset($post['apikey']) and $post['apikey'] == $apikey)
    {
        $data['login'] = false;
        if(array_key_exists('user',$post) and array_key_exists('pass',$post))
        {
            $user =  $post['user'];
            $pass =  $post['pass'];
            unset($post['pass']);
            $data['origin'] = $post;

            foreach ($users as $userEntry) {
                if($user == $userEntry['user']) {
                    if($pass == $userEntry['pass']) {
                        $data['message'] = 'Login erfolgreich!';
                        $data['login'] = true;
                    } else {
                        $data['message'] ='Benutzername und Passwort stimmen nicht überein!';
                    }
                    break;
                } else {
                    $data['message'] = 'Benutzername existiert nicht!';
                }
            }
        }

        $json = json_encode($data);

        if ($json === false) {
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                $json = json_encode(["jsonError" => "unknown"]);
            }
            http_response_code(500);
        }

    } else {
        $json = json_encode(['message' => "Schlüssel ist falsch!"]);
    }

    echo $json;
}
