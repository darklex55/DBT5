<?php
// Checks if HTTPS
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    session_start();

    // Check if the user is logged in (if an active user session exists)
    $hashed_name = md5('auth_token_cookie');
    if (isset($_COOKIE[$hashed_name]) && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $access_level = $_SESSION['access_level'];
        $clinic_id = $_SESSION['clinic_id'];

        // Check if the id values are valid (WIP)
        if (strlen($user_id) > 0 && strlen($access_level) > 0 && strlen($clinic_id) > 0) {
            $time = time();
            $cookie = $_COOKIE[$hashed_name];

            // Check if the token is a valid string
            if ((preg_match("/^[a-zA-Z0-9]+$/", $cookie) == 1) && strlen($cookie) == 64) {
                $dbconnect = new Connection();
                $db = $dbconnect->openConnection();

                // Get the saved last time the user accessed this token
                // and the token expiration time
                $query = $db->prepare("SELECT `last_use`, `valid_until`, count(*) AS num_rows FROM (SELECT `token`, `last_use`, `valid_until` FROM `tokens` WHERE `user_id`=:userid) AS token_expiration WHERE `token`=:token");
                $query->execute(['userid' => $user_id,
                                'token' => $cookie]);
                $result = $query->fetch(PDO::FETCH_ASSOC);

                $dbconnect->closeConnection();

                $num_of_rows = $result['num_rows'];

                // Check if there is only 1 row for this token
                if ($num_of_rows == 1) {
                    $last_use = $result['last_use'];
                    $valid_until = $result['valid_until'];

                    // Check if the token is expired
                    if ($valid_until > $time) {
                        // Check if the user has been inactive (ie. no
                        // requests for more than 20 minutes)
                        if (($time - 1200) < $last_use) {
                            $db = $dbconnect->openConnection();

                            $query = $db->prepare("UPDATE `tokens` SET `last_use`=:lastuse WHERE `user_id`=:userid AND `token`=:token");
                            $query->execute(['lastuse' => $time,
                                            'userid' => $user_id,
                                            'token' => $cookie]);

                            $dbconnect->closeConnection();
                        } else {
                            // Auth failed (token expired due to inactivity)
                            header("Location: ./logout.php");
                            die(6);
                        }
                    } else {
                        // Auth failed (token expired)
                        header("Location: ./logout.php");
                        die(5);
                    }
                } else {
                    // Auth failed (token is not valid, the user has
                    // not created any tokens so far or more than 1
                    // entries exist for the same token)
                    header("Location: ./logout.php");
                    die(4);
                }
            } else {
                // Auth failed (garbage token)
                header("Location: ./logout.php");
                die(3);
            }
        } else {
            // Auth failed (garbage session data)
            header("Location: ./logout.php");
            die(2);
        }
    } else {
        // Auth failed (no active session, no token)
        header("Location: ./logout.php");
        die(1);
    }
} else {
    // Enforce HTTPS
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    die(0);
}
 ?>
