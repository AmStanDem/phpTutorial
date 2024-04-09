<?php

/* Functions: A function is a piece of code that it can be called anywhere in a program.
It can have some parameters and return something. */

function insertUserMySQLI($email,$password,$connect): void
{
    $stmt = $connect->prepare("INSERT INTO users (email,password) values(?,?)");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $stmt->close();
}
function insertUserPDO($email,$password,$db): void
{
    try
    {
        $stmt = $db->prepare("INSERT INTO users (email,password) values(:email,:password)");
        $stmt->bindParam("s",$email);
        $stmt->bindParam("s",$password);
        $stmt->execute();
    }
    catch (PDOException $e)
    {
        echo 'ERROR '.$e->getMessage();
    }
}
function loginUserMySQLI($email, $password, $connect):bool
{
    $stmt = $connect->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result))
    {
        if (password_verify($password,getHashedPasswordFromUserEmailMySQLI($email,$connect)))
        {
            return true;
        }
    }
    return false;
}
function loginUserPDO($email, $password, $db):bool
{
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0)
    {
        if (password_verify($password,getHashedPasswordFromUserEmailPDO($email,$db)))
        {
            return true;
        }
    }
    return false;
}
function getHashedPasswordFromUserEmailMySQLI($email, $connect):string
{
    $stmt = $connect->prepare("SELECT password from users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    return $row['password'];
}
function getHashedPasswordFromUserEmailPDO($email, $db): ?string
{
    $stmt = $db->prepare("SELECT password from users WHERE email = ?");
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    if ($result)
        return $result['password'];
    return null;
}
