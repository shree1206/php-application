<?php
if (!defined('INSIDE_APP')) {
    header("Location: ../");
    exit;
}
?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center">Registraion</h2>
            <div id="message" class="mt-3"></div>
            <form id="registrationForm" method="post">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="business_name" class="form-label">Business Name</label>
                    <input type="text" id="business_name" name="business_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="contact_number" class="form-label">Contact Number</label>
                    <input type="tel" id="contact_number" name="contact_number" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" id="category" name="category" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" rows="4" class="form-control"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" id="regBtn" class="btn btn-primary">Save</button>
                </div>
            </form>
            <div id="loader" class="text-center mt-3" style="display:none;">Loading...</div>
        </div>
    </div>
</div>
<script src="/application/js/user_business_registration_ajax.js"></script>