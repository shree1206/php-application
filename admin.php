<?php
require_once __DIR__ . '/includes/connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: logout");
    exit;
} else {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 2) {
        header("location: logout");
        exit;
    }
} ?>

<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="container">
    <?php
    define('INSIDE_APP', true);
    require_once __DIR__ . '/adminPortal/sidebarSection/checkActionSidebarData.php';
    $sidebarData = hasSideBarData();
    require_once __DIR__ . '/adminPortal/sidebarSection/actionSidebarData.php';
    ?>

    <main class="main-content">
        <div class="promo-card" id="dynamic-content-area">
            <h3>Work Area!</h3>
        </div>
    </main>

    <script src="/application/js/admin/load_dynamic_content_admin.js"></script>
</div>
<button class="filter-btn" onclick="document.getElementById('filterSidebar').classList.toggle('active');">☰</button>

<?php require_once __DIR__ . '/includes/footer.php'; ?>