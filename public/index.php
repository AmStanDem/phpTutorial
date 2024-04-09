<?php // In a php file we can embed also HTML code.
/* The tag <?php is the opening tag for the PHP code while the ?> is the closing tag for the PHP code.*/

// SESSIONS: a session is a mechanism which permit us to store information in the web server across different pages.
// The session have the following lifecycle.
// 1. Creation/get a created session.
global $connect, $db;
session_start(); // It creates a new session or get an existing one. We must call this method at the top of our php file before any output, or it will not work.
// 2. Memorize the data.
// In order to memorize the value of an element we must call the $_SESSION array,
// with the index of the name we want to access for the value.
$_SESSION['name of the data'] = 'value of the data';
// 3. Get the data.
// In order to get the data we simply call the $_SESSION array with the index of the desired value.
$a = $_SESSION['name of the data'];
// 4. Close the session.
// When we want to terminate a session we have to do the following actions.
session_unset(); // for reset the value of the data.
$_SESSION = []; // For remove all the data.
session_destroy(); // For remove the session.

require '../config/connect.php';
require '../src/functions.php';
require '../includes/sessions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section class="vh-100 bg-image"
         style="background-color: #04243D">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px; background-color: white;">
                        <div class="card-body p-5">
                            <h2 style="color: #080A0B" class="text-uppercase text-center mb-5">Accedi!</h2>
                            <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);// Another way to embed php code into a value for a html value parameter.?>" method="post">
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" maxlength="100" placeholder="Email" required/>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required/>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" style="background-color: teal;" class="btn btn-primary btn-lg">Invia!</button>
                                </div>
                                <p class="text-center mt-5 mb-0">Non hai un account? <a style="text-decoration: none !important;" href="php/signUp.php">Registrati qui</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</section>
<?php
    // $_SERVER: Array that contains info on the server and methods.
    // We use it in this case for made a postback form when the called method is the post.
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Variables: Every variable must start with the $ symbol.
        // For declare and initialize a variable we use this syntax: $<name> = value;
        // Data types: PHP is a dynamic and lowed typed language.
        // We have the int,float,bool,string,array,object,null,resource and void types.
        // $_POST: Array that contains the values of the data passed within a form that has the post method.
        // For obtain access to the data we use the name that is equal to the input name field.

        /*FOR mysqli*/
        //$email = mysqli_real_escape_string($_POST['email']);
        //$password = mysqli_real_escape_string(['password']);
        /*FOR PDO*/
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (/*loginUserMySQLI($email,$password,$connect)*/loginUserPDO($email,$password,$db))
        {
            login($email,$password);
            header('location:php/dashboard.php');
        }

    }
?>
</body>
</html>
