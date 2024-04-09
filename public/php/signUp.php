<?php
/* require: It requires a file php*/
global $connect, $db;
require '../../config/connect.php';
require '../../src/functions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrati!</title>
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
                            <h2 style="color: #080A0B" class="text-uppercase text-center mb-5">Registrati!</h2>
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
                                <p class="text-center mt-5 mb-0">Hai già un account? <a style="text-decoration: none !important;" href="../index.php">Accedi qui</a></p>
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
    // Variables: Every variables must start with the $ symbol.
    // For declare and initialize a variable we use this syntax: $<name> = value;
    // Data types: PHP is a dynamic and lowed typed language.
    // We have the int,float,bool,string,array,object,null,resource and void types.
    // $_POST: Array that contains the values of the data passed within a form that has the post method.
    // For obtain access to the data we use the name that is equal to the input name field.

    $email = $_POST['email'];
    $password = $_POST['password'];
    // password hash:We must not memorize the password in plain in our database. The best method is use the password_hash method for hashing the passwords.
    //insertUserMySQLI($email,password_hash($password,PASSWORD_DEFAULT),$connect);
    insertUserPDO($email,password_hash($password,PASSWORD_DEFAULT),$db);
    header('location:../../public/index.php');// We use this method in order to change page.
    //$connect->close();
    $db = null;
}
?>