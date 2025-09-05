<?php
// Include your database connection file
require_once __DIR__ . '/includes/connection.php';

// Check if the user is already logged in, then redirect to the welcome page
if (!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] === true) {
    header("location: ./");
    exit;
}
?>

<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center">Password Change</h2>
            <div id="message" class="mt-3"></div>
            <form id="passwordChangeForm" method="post">
                <div class="mb-3">
                    <label for="oldpassword" class="form-label">Old Password:</label>
                    <input type="text" id="oldpassword" name="oldpassword" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="newpassword" class="form-label">New Password:</label>
                    <input type="password" id="newpassword" name="newpassword" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm Password:</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="form-control">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" id="saveBtn" class="btn btn-primary">Change Password</button>
                </div>
            </form>
            <div id="loader" class="text-center mt-3" style="display:none;">Loading...</div>
        </div>
    </div>
</div>
<script src="/application/js/password_change_ajax.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>