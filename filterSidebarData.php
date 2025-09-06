<?php
if (!defined('INSIDE_APP')) {
    header("Location: logout");
    exit;
}
?>
<aside class="sidebar" id="filterSidebar">
    <h3>Categories:</h3>
    <?php if ($sidebarData['dataFound']): ?>
        <ul>
            <?php foreach ($sidebarData['categoriesData'] as $action): ?>
                <li><?php echo htmlspecialchars($action['categories_name']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No Data Found.</p>
    <?php endif; ?>
</aside>