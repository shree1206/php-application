<?php require_once __DIR__ . '/../../includes/connection.php'; ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 2): ?>
    <?php
    require_once __DIR__ . '/../../includes/header.php';
    define('INSIDE_APP', true);
    require_once __DIR__ . '/../../includes/check_business_data.php';
    $business = hasBusinessData();
    ?>
    <?php if ($business['dataFound']): ?>
        <div class="container d-flex justify-content-center align-items-center" style="margin-top:12px;">
            <div class="card shadow-lg" style="width: 100%; max-width: 500px;">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Edit Business Details</h4>
                    <div id="message" class="mt-3" style="display: none;"></div>

                    <form id="editForm">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                value="<?php echo htmlspecialchars($business['businessData']['full_name']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="business_name" name="business_name"
                                value="<?php echo htmlspecialchars($business['businessData']['business_name']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_number" name="contact_number"
                                value="<?php echo htmlspecialchars($business['businessData']['contact_number']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category"
                                value="<?php echo htmlspecialchars($business['businessData']['category']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address"
                                rows="3"><?php echo htmlspecialchars($business['businessData']['address']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="updateBtn">Update</button>
                        <div id="loader" class="text-center mt-3" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="../../js/customer/edit_business_ajax.js"></script>
    <?php else:
        header("location: ./");
        exit; ?>
    <?php endif; ?>
<?php else:
    header("location: ./");
    exit; ?>
<?php endif; ?>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>