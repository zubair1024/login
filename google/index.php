<?php
require_once 'app/init.php';
$db = new DB();
$google_client = new Google_Client();
$auth = new GoogleAuth($db, $google_client);
$authUrl = $auth->checkToken();
if ($auth->login()) {
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location : ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
?>

<!doctype html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
    </head>
    <body>
        <p>
            <?php if ($authUrl): ?>
                <a href="<?= $authUrl ?>">Sign in with Google</a>
            <?php else: ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </p>
    </body>
</html>
