<?php
require_once __DIR__ . '/includes/connection.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: welcome");
    exit;
}
?>

<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container-fluid d-flex justify-content-center align-items-center" style="margin-top: 12px;">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Sign Up</h2>
            <div id="message" class="mt-3 alert alert-danger alert-dismissible fade show" role="alert"
                style="display: none;">
                <span id="message-text"></span>
            </div>
            <form id="signupForm" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" id="signupBtn" class="btn btn-primary">Sign Up</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Already have an account?<a href="<?php echo BASE_URL; ?>/login">Login here</a>
            </p>
            <div id="loader" class="text-center mt-3" style="display:none;">Loading...</div>
        </div>
    </div>
</div>
<script src="/application/js/signup_ajax.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>