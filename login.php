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
