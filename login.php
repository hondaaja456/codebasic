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



//confirmation only!
//goes to dashboard php or index php, checkout php, profile php because needed to confirmed whetner its login or not for checking
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
}









//this code below if you dont js to redirect the page if log in was success

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
//     // Jump to dashboard echo "You are already logged in"
//     header("Location: dashboard.php");
//     exit;
// } else {
//     // POP-UP LOGIC:
//     // We stop the PHP redirect and use JS to show the alert
//     echo "<script>
//         alert('Your login info is incorrect. Please try again.');
//         window.location.href = 'index.php';
//     </script>";
//     exit;
// }





