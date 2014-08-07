<?php

class GoogleAuth {

    private $db;
    private $client;

    public function __construct(DB $db, Google_Client $google_client) {
        $this->db = $db;
        $this->client = $google_client;
        $this->client->setClientId('1097993448916-7ducj7ijnm8acp627it8a2ijmbvemp61.apps.googleusercontent.com');
        $this->client->setClientSecret('8tk6ruYQT8NyJj5MOzz9GUhQ');
        $this->client->setRedirectUri('http://localhost/login/google/index.php');
        $this->client->setScopes('email');
    }

    public function checkToken() {

        if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
            $this->client->setAccessToken($_SESSION['access_token']);
        } else {
            return $this->client->createAuthUrl();
        }
        return '';
    }

    public function login() {
        if (isset($_GET['code'])) {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            $this->storeUser($this->getPayload());
            return TRUE;
        }
        return FALSE;
    }

    public function logout() {
        unset($_SESSION['access_token']);
    }

    public function getPayload() {

        return json_decode(json_encode($this->client->verifyIdToken()->getAttributes()))->payload;
    }

    public function storeUser($payload) {
        $sql = " insert into google_users (id,email) values ({$payload->id},'{$payload->email}' on duplicate key update id=id";
        $this->db->query($sql);
        
    }

}
