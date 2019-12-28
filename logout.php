<?php
function destroy_cookie() {
    $session_cookie_params = session_get_cookie_params();

    setcookie($hashed_name, // token name
        '', // token value
        time() - 1, // expires instantly
        $session_cookie_params['path'], // path
        $session_cookie_params['domain'], // domain
        false, // secure
        true //http-only
    );
}

session_start();
// Check if the user is logged in
$hashed_name = md5('auth_token_cookie');
if (isset($_COOKIE[$hashed_name]) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $cookie = $_COOKIE[$hashed_name];

    // Check if the id is valid
    if (strlen($user_id) > 0) {
        // Check if the cookie has a valid token
        if ((preg_match("/^[a-zA-Z0-9]+$/", $cookie) == 1) && strlen($cookie) == 64){
            require_once "./connect.php";
            $dbconnect = new Connection();
            $db = $dbconnect->openConnection();

            // Normal log out, delete the token from the database
            // and destroy the cookie
            $query = $db->prepare("DELETE FROM `tokens` WHERE `token`=:token AND `user_id`=:userid");
            $query->execute(['token' => $cookie,
                            'userid' => $user_id]);

            $dbconnect->closeConnection();

            destroy_cookie();
            session_destroy();
            header('Location: ./login.php');
            die(0);
        } else {
            // If an invalid cookie exists with a valid session
            destroy_cookie();
            session_destroy();
            header('Location: ./login.php');
            die(4);
        }
    } else {
        // If a not valid user id is present, maybe the token is
        // compromised so delete it

        // Checks if it is possible that the token was compromised
        if ((preg_match("/^[a-zA-Z0-9]+$/", $cookie) == 1) && strlen($cookie) == 64){
            require_once "./connect.php";
            $dbconnect = new Connection();
            $db = $dbconnect->openConnection();

            // Delete the possibly compromised token from the DB
            $query = $db->prepare("DELETE FROM `tokens` WHERE `token`=:token");
            $query->execute(['token' => $cookie]);

            $dbconnect->closeConnection();

            destroy_cookie();
            session_destroy();
            header('Location: ./login.php');
            die(3);
        } else {
            // If an invalid cookie exists with an invalid session
            destroy_cookie();
            session_destroy();
            header('Location: ./login.php');
            die(1);
        }
    }
} else if (isset($_COOKIE[$hashed_name])) {
    // If the user is not logged in but a token cookie still exists
    // on the browser (possibly compromised cookie)

    $cookie = $_COOKIE[$hashed_name];

    // Checks if it is possible that a real token was compromised
    if ((preg_match("/^[a-zA-Z0-9]+$/", $cookie) == 1) && strlen($cookie) == 64){
        require_once "./connect.php";
        $dbconnect = new Connection();
        $db = $dbconnect->openConnection();

        // Delete the possibly compromised token from the DB
        $query = $db->prepare("DELETE FROM `tokens` WHERE `token`=:token");
        $query->execute(['token' => $cookie]);

        $dbconnect->closeConnection();

        destroy_cookie();
        session_destroy();
        header('Location: ./login.php');
        die(2);
    } else {
        // If an invalid cookie exists without a session
        destroy_cookie();
        session_destroy();
        header('Location: ./login.php');
        die(1);
    }
} else {
    // If everything on the browser is clear, destroy any cookies
    // just to be sure.
    destroy_cookie();
    session_destroy();
    header('Location: ./login.php');
    die(0);
}
 ?>
