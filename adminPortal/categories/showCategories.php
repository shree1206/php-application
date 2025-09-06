<?php require_once __DIR__ . '/../../includes/connection.php'; ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
    <?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'): ?>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-4 w-100">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Categories</h4>

                    <div id="table-container" class="table-responsive">
                    </div>

                </div>
            </div>
        </div>
        <?php define('INSIDE_APP', true); ?>
        <?php require_once __DIR__ . '/../../js/admin/category/showCategory.php'; ?>
    <?php else:
        header("location: ./../../logout");
        exit; ?>
    <?php endif; ?>
<?php else:
    header("location: ./../../logout");
    exit; ?>
<?php endif; ?>