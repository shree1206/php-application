<?php require_once __DIR__ . '/../../includes/connection.php'; ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
    <?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'): ?>

        <div class="container d-flex justify-content-center align-items-center">
            <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Add New Category</h4>

                    <div id="alert-message" class="alert alert-danger" role="alert" style="display: none;"></div>

                    <form id="categoryForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                        </div>

                        <div class="mb-3">
                            <label for="category_image" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
                        </div>

                        <div class="progress my-3" style="display: none;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="saveBtn">
                                <span id="button-text">Save Category</span>
                                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                    style="display: none;"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php define('INSIDE_APP', true); ?>
        <?php require_once __DIR__ . '/../../js/admin/category/addCategory.php'; ?>
    <?php else:
        header("location: ./../../logout");
        exit; ?>
    <?php endif; ?>
<?php else:
    header("location: ./../../logout");
    exit; ?>
<?php endif; ?>