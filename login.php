<?php
/* Set server HTTP response headers */
// Prevent caching, in order to avoid caching user credentials.
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0");
// Prevent the page from loading if an XSS attack is detected.
header("X-XSS-Protection: 1; mode=block");
// Forbid other pages to embed the site as a frame.
header("X-Frame-Options: DENY");
// Prevents the browser from MIME type sniffing (setting or changing
// the MIME type headers)
header("X-Content-Type-Options: nosniff");
// Allows content only from the same origin
header("Content-Security-Policy: default-src 'self'; script-src 'self';");

/* Login logic */
// Enforce HTTPS only
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    session_start();

    // Hashing cookie name to try and avoid attacks by compromised
    // sites that use the same cookie name and scope
    $hashed_name = md5('auth_token_cookie');
    // Check if the user is already logged in
    if (isset($_COOKIE[$hashed_name]) && isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        die(0);
    } else if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Confirm input is sanitized
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && (strlen($email) >= 10) && (strlen($email) <= 100) && (strlen($password) >= 8) && (strlen($password) <= 50)) {
            require_once "./connect.php";
            $dbconnect = new Connection();
            $db = $dbconnect->openConnection();

            $query = $db->prepare("SELECT `id`, `password`, `specialty`, `dept_clinic_id`, count(*) AS num_rows FROM `employees` WHERE `email` = :email");
            $query->execute(['email' => $email]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            $dbconnect->closeConnection();

            $database_id = $result['id'];
            $database_pass = $result['password'];
            $database_specialty = $result['specialty'];
            $database_clinic_id = $result['dept_clinic_id'];
            $num_of_rows = $result['num_rows'];

            // Checks if the user exists.
            if ($num_of_rows == 1) {
                // Checks the password recovered from the database
                // against the one entered by the user.
                if (password_verify($password, $database_pass)) {
                    session_regenerate_id(true);
                    $session_cookie_params = session_get_cookie_params();

                    // Generate a token, set the authentication cookie
                    // and save the cookie (valid for 12h).
                    $token = bin2hex(openssl_random_pseudo_bytes(32));
                    setcookie($hashed_name, // token name
                        $token, // token value
                        0, // expires at end of session
                        $session_cookie_params['path'], // path
                        $session_cookie_params['domain'], // domain
                        true, // secure			CHANGE TO true
                        true //http-only
                    );

                    $time = time();
                    $valid_until = $time + 43200;

                    $db = $dbconnect->openConnection();

                    $query = $db->prepare("INSERT INTO `tokens` (`user_id`, `token`, `valid_until`, `last_use`) VALUES (:id, :token, :valid, :last_use)");
                    $query->execute(['id' => $database_id,
                                    'token' => $token,
                                    'valid' => $valid_until,
                                    'last_use' => $time]);

                    $dbconnect->closeConnection();

                    // Update session variables and redirect
                    $_SESSION['user_id'] = $database_id;
                    $_SESSION['clinic_id'] = $database_clinic_id;
                    if($database_specialty == 'Nurse') {
                        $_SESSION['access_level'] = 2;
                    } else {
                        $_SESSION['access_level'] = 1;
                    }

                    header("Location: ./index.php");
                    die(0);
                } else {
                    // Login failed (wrong password)
                    render_html(4);
                    die(4);
                }
            } else {
                // Login failed (user does not exist)
                render_html(3);
                die(3);
            }
        } else {
            // Login failed (garbage input)
            render_html(2);
            die(2);
        }
    } else {
        // Form is not yet submited, POST request is not yet done
        render_html(1);
        die(1);
    }
} else {
    // Force HTTPS
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
    die(0);
}

function render_html($error_code) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Dependencies, styles and scriptss -->
	<title>Employee Log In</title>

</head>
<body>
	<h2>Employee Log In</h2><br>
	<form action="./login.php" method="POST">
    	<p>Email</p>
    	<input type="email" name="email" id="email" placeholder="Enter your email" required minlength="10" maxlength="100" autofocus>
    	<br>
    	<p>Password</p>
    	<input type="password" name="password" id="password" placeholder="Enter your password" required minlength="8" maxlength="50">
    	<br>
        <input type="submit" value="Enter"></input>
  	</form>
</body>
</html>

<?php
}
?>
