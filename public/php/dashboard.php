<?php
global $connect, $db;
require '../../config/connect.php';
require '../../src/functions.php';
require '../../includes/sessions.php';
require_login($_SESSION['logged_in']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../../includes/logout.php"><img style="width: 50px; height: 50px;" src="../assets/images/logout.png" alt="Esci"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
/* THE echo function.
This function allows to print text html code,
js code and other types of language in our page php.
*/
?>
<h2><?php echo ("Hello ".$_SESSION['email']);?></h2>
<?php
$res = /*getUsersMySQLI($connect)*/ getUsersPDO($db);
/* The if statement: checks if a condition is true or false
and do some action in base of the value of the condition.*/
if (/*mysqli_num_rows($res) > 0*/$res)
{
    echo ("<table class='table'>");
    echo ("
            <thead>
                <tr>
                    <th scope='col'>Email</th>
                    <th scope='col'>Password</th>
                </tr>
            </thead>");
    echo "<tbody>";
    /*Cycles: A cycle is a group of instructions that is repeated as long as the condition of it is respected.*/
    /*We have different types of cycles:*/
    /*The for cycle: we use the for cycle when we know the number of cycles.*/
    /*It is formed by 3 parts:
    The initialization part of the counters,
    the condition and
    the increment or decrement of our counts.*/
    /*for ($i = 0; $i < $n; $i++)
    {

    }
    */
    // The do while: We use the do while cycle when we want to do a set of instructions at least one time,
    // and we don't know when the condition will be broken.
    /*
    do
    {

    }
    while(condition);
    */
    /*While cycle: We use the while cycle when don't know when the condition will be broken. */
    /*
     while(condition)
     {

     } */
    /*foreach cycle: we use the foreach cycle when we want to read all the elements directly
    (without an index) of a collection. */
    /*while*/foreach (/*$row = $res->fetch_assoc()*/ $res as $record)
    {
        ?>
            <tr>
            <td><?php echo $record['email']; ?></td>
            <td><?php echo $record['password']; ?></td>
            </tr>
        <?php
    }
    echo "</tbody>";
    echo "</table>";
}
// The else statement: When the condition fails, we call the else statement and call the code of it.
/*
else
{

}
*/
// The elseif statement: When the condition fails, we call the elseif statement
// for check another condition and if the value of it is true, we proceed with code inside it.
/*

elseif (condition)
{

}
*/
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>