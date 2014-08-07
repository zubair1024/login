<?php

require_once 'app/init.php';
$db = new DB();
$google_client = new Google_Client();
$auth = new GoogleAuth($db, $google_client);
