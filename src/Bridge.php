<?php

namespace TreptowKolleg\Api;

class Bridge
{

    private string $apikey;
    private string $database;

    public function __construct(string $apikey, string $database = 'world')
    {
        $this->apikey = $apikey;
        $this->database = $database;
    }

    public function requestLogin(string $username, string $password) {

        $data['apikey'] = $this->apikey;
        $data['database'] = $this->database;
        $data['user'] = $username;
        $data['pass'] = $password;
        $data['md5pass'] = md5($password);

        $escapedData = self::escapeChars($data);

        $ch = curl_init("https://www.wagnerpictures.com/test-request.php");
        return $this->extracted($ch, $escapedData);
    }

    public function requestSQL($query) {
        $data['query'] = $query;
        $data['apikey'] = $this->apikey;
        $data['database'] = $this->database;

        $escapedData = self::escapeChars($data);

        $ch = curl_init("https://www.wagnerpictures.com/sqlrequest.php");
        return $this->extracted($ch, $escapedData);
    }

    private function escapeChars($element)
    {
        if(is_string($element)) {
            $element = htmlspecialchars($element);
        } elseif (is_array($element)) {
            foreach ($element as $key => $value) {
                if(is_string($value)) {
                    $element[$key] = htmlspecialchars($value);
                } elseif (is_array($value)) {
                    $element[$key] = 'Array ist hier nicht erlaubt!';
                }
            }
        }
        return $element;
    }

    /**
     * @param $ch
     * @param $escapedData
     * @return array|mixed
     */
    public function extracted($ch, $escapedData)
    {
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_POSTFIELDS => $escapedData
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            $responseData['message'] = curl_error($ch);
        } else {
            $responseData = json_decode($response, TRUE);
        }
        curl_close($ch);
        return $responseData;
    }


}