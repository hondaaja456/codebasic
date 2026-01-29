// login.php

<?php
session_start();


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


if (login($username, $password)) {
    echo "Login successful!";
} else {
    echo "Invalid credentials.";
}







// new code of login with security hash and pdo thing
// session_start();
// require 'db.php'; // PDO connection

// $username = $_POST['username'];
// $password = $_POST['password'];

// // 1. Get user by username
// $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
// $stmt->execute([$username]);
// $user = $stmt->fetch(PDO::FETCH_ASSOC);

// // 2. Check if user exists
// if ($user && password_verify($password, $user['password'])) {

//     session_regenerate_id(true);
//     $_SESSION['user_id'] = $user['id'];

//     echo "Login successful";

// } else {
//     echo "Invalid username or password";
// }


//--------------------------------------------------------------------

// password login with hash (security)
// $password = $_POST['password'];
// $storedHash = $user['password'];

// if (password_verify($password, $storedHash)) {
//     $_SESSION['user_id'] = $user['id'];
// } else {
//     echo "Invalid login";
// }

// //confirmation only!
// //goes to dashboard php or index php, checkout php, profile php because needed to confirmed whetner its login or not for checking
// if (!isset($_SESSION['loggedin'])) {
//     header("Location: index.php");
//     exit;
// }


//--------------------------------------------------------------------






// //this code below if you dont use js to redirect the page and it doesnt have hash security if log in was success

// <?php
// session_start();

// function login($username, $password) {
//     $users = [
//         "admin" => "1234",
//         "user" => "abcd"
//     ];

//     if (isset($users[$username]) && $users[$username] === $password) {
//         $_SESSION['loggedin'] = true;
//         $_SESSION['username'] = $username;
//         return true;
//     }

//     return false;
// }



// $username = $_POST['username'] ?? ''; 
// $password = $_POST['password'] ?? '';




// if (login($username, $password)) {
//     header("Location: dashboard.php");
//     exit;
// } else {
//     header("Location: index.php?error=1");
//     exit;
// }



//--------------------------------------------------------------------

