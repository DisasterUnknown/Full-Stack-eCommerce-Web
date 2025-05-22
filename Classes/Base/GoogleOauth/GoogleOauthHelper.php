<?php
require __DIR__ . '/../../../vendor/autoload.php';

class GoogleOauthHelper {
    public function __construct() {}

    public function GoogleOauthConnect() {
        $client = new Google\Client;

        $client->setClientID("378755099250-vbdl1j4r3l568mi2c2nsj7thqj4tje6h.apps.googleusercontent.com");
        $client->setClientSecret("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");
        $client->setRedirectUri("http://localhost/WebProject/Pages/login.php");

        return $client;
    }

    public function OauthUrl() {
        $clientConnection = $this->GoogleOauthConnect();

        $clientConnection->addScope("email");
        $clientConnection->addScope("profile");

        $url = $clientConnection->createAuthUrl();
        return json_encode(['msg' => $url]);
    }
}
