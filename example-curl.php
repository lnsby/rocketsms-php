<?php

/** php-curl and php-json must be installed **/

function sendRocketSMS($phone, $message)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'http://api.rocketsms.by/json/send');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "username=1234567890&password=qwerty&phone=" . $phone . "&text=" . $message);

    $result = @json_decode(curl_exec($curl), true);

    if ($result && isset($result['id'])) {
        return "Message has been sent. MessageID=" . $result['id'];
    } elseif ($result && isset($result['error'])) {
        return "Error occurred while sending message. ErrorID=" . $result['error'];
    } else {
        return "Service error";
    }
}

echo "<pre>";
echo sendRocketSMS("375297357355", "hello, rocketsms!");
echo "</pre>";