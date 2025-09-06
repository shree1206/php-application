<?php
if (!defined('INSIDE_APP')) {
    header("Location: ../../logout");
    exit;
}
?>

<aside class="sidebar accordion" id="filterSidebar">
    <h3>Actions</h3>
    <?php if ($sidebarData['dataFound']): ?>
        <div class="accordion" id="accordionActions">
            <?php foreach ($sidebarData['actionsData'] as $action): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-<?php echo htmlspecialchars($action['action_id']); ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-<?php echo htmlspecialchars($action['action_id']); ?>"
                            aria-expanded="false"
                            aria-controls="collapse-<?php echo htmlspecialchars($action['action_id']); ?>">
                            <?php echo htmlspecialchars($action['action_name']); ?>
                        </button>
                    </h2>
                    <div id="collapse-<?php echo htmlspecialchars($action['action_id']); ?>" class="accordion-collapse collapse"
                        aria-labelledby="heading-<?php echo htmlspecialchars($action['action_id']); ?>"
                        data-bs-parent="#accordionActions">
                        <div class="accordion-body p-0">
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($action['options'])): ?>
                                    <?php foreach ($action['options'] as $option): ?>
                                        <li class="list-group-item" style="padding-left: 20px !important;">
                                            <a href="adminPortal/<?php echo $action['action_name'] . '/' . $option['action_option_name'] ?>"
                                                style="text-decoration: none;">
                                                <?php echo htmlspecialchars($option['action_option_name']); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No Data Found.</p>
    <?php endif; ?>
</aside>