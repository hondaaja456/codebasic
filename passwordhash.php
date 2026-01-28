if (password_verify($password, $storedHash)) {
  $_SESSION['loggedin'] = true;
}
