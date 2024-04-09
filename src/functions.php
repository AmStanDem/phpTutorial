<?php

/* Functions: A function is a piece of code that it can be called anywhere in a program.
It can have some parameters and return something. */

function insertUserMySQLI(string $email,string $password,mysqli $connect): void
{
    $stmt = $connect->prepare("INSERT INTO users (email,password) values(?,?)");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $stmt->close();
}
function insertUserPDO(string $email,string $password,PDO $db): void
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
function insertUserMySQLIObjectOriented(\dto\User $user, mysqli $conn): void
{
    insertUserMySQLI($user->getEmail(), $user->getPassword(),$conn);
}
function insertUserPDOObjectOriented(\dto\User $user, PDO $db): void
{
    insertUserPDO($user->getEmail(), $user->getPassword(),$db);
}
function loginUserMySQLI(string $email, string $password, mysqli $connect):bool
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
function loginUserMySQLIObjectOriented(\dto\User $user, mysqli $connect):bool
{
    return loginUserMySQLI($user->getEmail(),$user->getPassword(),$connect);
}
function loginUserPDO(string $email, string $password, PDO $db):bool
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
function loginUserPDOObjectOriented(\dto\User $user, PDO $db):bool
{
    return loginUserPDO($user->getEmail(), $user->getPassword(), $db);
}
function getHashedPasswordFromUserEmailMySQLI(string $email, mysqli $connect):string
{
    $stmt = $connect->prepare("SELECT password from users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    return $row['password'];
}
function getHashedPasswordFromUserEmailMySQLIObjectOriented(\dto\User $user, mysqli $connect):string
{
    return getHashedPasswordFromUserEmailMySQLI($user->getEmail(),$connect);
}
function getHashedPasswordFromUserEmailPDO(string $email, PDO $db): ?string
{
    $stmt = $db->prepare("SELECT password from users WHERE email = ?");
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    if ($result)
        return $result['password'];
    return null;
}
function getHashedPasswordFromUserEmailPDOObjectOriented(\dto\User $user, PDO $db): ?string
{
    return getHashedPasswordFromUserEmailPDO($user->getEmail(), $db);
}
function getUsersMySQLI(mysqli $connect): false|mysqli_result
{
    $stmt = $connect->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->get_result();
}
function getUsersPDO(PDO $db): false|array
{
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}