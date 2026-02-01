<?php
require_once "../includes/header.php";

$ADMIN_USER = "admin";
$ADMIN_HASH = password_hash("admin123", PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        $_POST['username'] === $ADMIN_USER &&
        password_verify($_POST['password'], $ADMIN_HASH)
    ) {
        $_SESSION['user_id'] = 1;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<div class="login-page">
    <div class="login-card">
        <h2>Recipe Login</h2>
        
        <?php if(isset($error)) echo "<div style='color: var(--danger); background: #FEE2E2; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem;'>$error</div>"; ?>
        
        <form method="post">
            <div>
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            
            <div>
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            
            <button>Login</button>
        </form>
    </div>
</div>

<?php require_once "../includes/footer.php"; ?>
