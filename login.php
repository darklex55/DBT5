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
session_start();

// Hashing cookie name to try and avoid attacks by compromised
// sites that use the same cookie name and scope
$hashed_name = md5('auth_token_cookie');
// Check if the user is already logged in
if (isset($_COOKIE[$hashed_name]) && isset($_SESSION['user_id'])) {
    header("Location: ./index.php");
    die(0);
} else if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Confirm input is sanitized
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && (strlen($email) >= 10) && (strlen($email) <= 100) && (strlen($password) >= 8) && (strlen($password) <= 50)) {
        require_once "./connect.php";
        $dbconnect = new Connection();
        $db = $dbconnect->openConnection();

        $query = $db->prepare("SELECT `id`, `password`, `specialty`, `dept_clinic_id`, `name`, `surname`, `gender` FROM `employees` WHERE `email` = :email");
        $query->execute(['email' => $email]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $dbconnect->closeConnection();

        $database_id = $result['id'];
        $database_pass = $result['password'];
        $database_specialty = $result['specialty'];
        $database_clinic_id = $result['dept_clinic_id'];
        $database_name = $result['name'] . " " . $result['surname'];
        $database_gender = $result['gender'];

        $q = $db->prepare("SELECT count(*) AS num_rows FROM `employees` WHERE `email` = :email");
        $q->execute(['email' => $email]);
        $r = $q->fetch(PDO::FETCH_ASSOC);
        $num_of_rows = $r['num_rows'];

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
                    false, // secure			CHANGE TO true
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
                $_SESSION['name'] = $database_name;
                $_SESSION['gender'] = $database_gender;
                if($database_specialty == 'Nosileutis') {
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

function render_html($error_code) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>

  <!-- Cache -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />

  <!-- Icons-->
  <link href="./css/icons/font-awesome.min.css" rel="stylesheet"/>

  <!-- Styles -->
  <link href="./css/style.css" rel="stylesheet"/>

  <title>Employee Login</title>
</head>
<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>Employee Login</h1>
              <p class="text-muted">Sign In to your account</p>
              <form action="./login.php" method="POST" class="needs-validation" novalidate>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-at"></i>
                    </span>
                  </div>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email" required minlength="10" maxlength="100" autofocus>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    You must enter a valid email between 10 and 100 characters.
                  </div>
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required minlength="8" maxlength="50">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Your password must be between 8 and 50 characters.
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary px-4">Login</button>
                  </div>
                  <!-- <div class="col-6 text-right">
                    <button type="button" class="btn btn-link px-0">Forgot password?</button>
                  </div> -->
                </div>
              </form>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body">
              <div>
                <h2>Login</h2>
                <p>Log in to see your responsibilities and manage your workday.<br>
                   <ul>
                       <li><b>For Doctors</b>: View patient history, log treatments.</li>
                       <li><b>For Nurses</b>: View patient history, assign incoming patients.</li>
                   </ul>
                </p>
                <a class="text-white float-right" href="#">Need help?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins-->
  <script src="./js/dependencies/jquery.min.js"></script>
  <script src="./js/dependencies/bootstrap.min.js"></script>
  <script src="./js/dependencies/coreui.min.js"></script>

  <!-- Validation script -->
  <script src="./js/validation.js"></script>

</body>
</html>

<?php
}
?>
