<?php
session_start();

// Block access if not logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Dashboard</h1>

<p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>

<a href="logout.php">Logout</a>

</body>
</html>
