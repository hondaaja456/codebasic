$email = $_POST['email'];
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
  "INSERT INTO users (email, password) VALUES (?, ?)"
);
$stmt->execute([$email, $hash]);
