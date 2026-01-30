$email = $_POST['email'];
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
  "INSERT INTO users (email, password) VALUES (?, ?)"
);
$stmt->execute([$email, $hash]);













//this with email already exist else
// <?php
// require 'db.php';

// $email = $_POST['email'] ?? '';
// $password = $_POST['password'] ?? '';

// if (!$email || !$password) {
//     echo "Missing fields";
//     exit;
// }

// $hash = password_hash($password, PASSWORD_DEFAULT);

// $stmt = $pdo->prepare(
//   "INSERT INTO users (email, password) VALUES (?, ?)"
// );

// try {
//     $stmt->execute([$email, $hash]);
//     echo "Signup successful. You can login now.";
// } catch (PDOException $e) {
//     echo "Email already exists";
