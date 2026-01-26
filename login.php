// login.php
function login($username, $password) {
    $users = [
        "admin" => "1234",
        "user" => "abcd"
    ];

    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        return true;
    }

    return false;
}




//goes to dashboard php or index php, checkout php, profile php because needed to confirmed whetner its login or not for checking
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
}


