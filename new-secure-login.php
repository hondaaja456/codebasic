<?php



session_set_cookie_params([
    'httponly' => true,
    'secure' => true,      // Only over HTTPS
// 'secure' => isset($_SERVER['HTTPS']) //If your site sometimes uses HTTP
    'samesite' => 'Strict' //use this code for heavy security for sensitive data like banking, admin panel, internal tools
  // 'samesite' => 'Lax'//use this code is more ux friendly like maybe not too sensitive case like normal login, public site
]);


session_start();



// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db.php';
    
    // 1. CSRF CHECK (CRITICAL - YOU MISSED THIS!)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die(json_encode(['success' => false, 'message' => 'Invalid request']));
    }
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    // 2. RATE LIMITING CHECK (BEFORE password verification)
    $stmt = $pdo->prepare("SELECT COUNT(*) as attempts FROM login_attempts 
                           WHERE email = ? 
                           AND attempt_time > DATE_SUB(NOW(), INTERVAL 15 MINUTE)");
    $stmt->execute([$email]);
    $attempts = $stmt->fetch(PDO::FETCH_ASSOC)['attempts'];
    
    if ($attempts >= 5) {
        // Calculate when they can try again
        $stmt = $pdo->prepare("SELECT attempt_time FROM login_attempts 
                               WHERE email = ? 
                               ORDER BY attempt_time DESC LIMIT 1");
        $stmt->execute([$email]);
        $last_attempt = $stmt->fetch(PDO::FETCH_ASSOC);
        $retry_time = date('H:i', strtotime($last_attempt['attempt_time'] . ' +15 minutes'));
        
        die(json_encode([
            'success' => false, 
            'message' => "Too many login attempts. Try again after $retry_time"
        ]));
    }
    
    // 3. LOG THIS ATTEMPT (BEFORE checking credentials)
    $stmt = $pdo->prepare("INSERT INTO login_attempts (email, ip_address) VALUES (?, ?)");
    $stmt->execute([$email, $ip_address]);
    
    // 4. GET USER
    $stmt = $pdo->prepare("SELECT id, password, is_verified FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        exit;
    }
    
    // 5. CHECK VERIFICATION
    if (!$user['is_verified']) {
        echo json_encode([
            'success' => false, 
            'message' => 'Please verify your email first. <a href="resend_verification.php">Resend verification</a>'
        ]);
        exit;
    }
    
    // 6. VERIFY PASSWORD
    if (password_verify($password, $user['password'])) {
        // SUCCESS - Clear login attempts
        $stmt = $pdo->prepare("DELETE FROM login_attempts WHERE email = ?");
        $stmt->execute([$email]);
        
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $email;
        
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        // FAILURE - Attempts already logged above
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    }
    exit; // Good practice to exit after POST handling
}
?>
