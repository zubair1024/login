<?php

class GoogleAuth {

    private $db;
    private $client;

    public function __construct(DB $db, Google_Client $google_client) {
        $this->db = $db;
        $this->client = $google_client;
        $this->client->setClientId('1097993448916-7ducj7ijnm8acp627it8a2ijmbvemp61.apps.googleusercontent.com');
        $this->client->setClientSecret('8tk6ruYQT8NyJj5MOzz9GUhQ');
        $this->client->setRedirectUri('http://localhost:8888/login/google/index.php');
        $this->client->setScopes('email');
    }

}
