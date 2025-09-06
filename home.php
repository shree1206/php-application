<?php
require_once __DIR__ . '/includes/connection.php';
if (!defined('APP_INIT')) {
    header("location: 404");
    exit;
} else { ?>
    <header class="header">
        <div class="header-content">
            <img src="gif/phone.gif" alt="City icon GIF">
            <h1>City Directory</h1>
        </div>
        <p>Find the right people and places with our extensive database.</p>
    </header>
    <div class="container">
        <?php define('INSIDE_APP', true);
        require_once __DIR__ . '/checkFilterSidebarData.php';
        $sidebarData = hasSideBarData();
        require_once __DIR__ . '/filterSidebarData.php';
        ?>
        <main class="main-content">
            <div class="promo-card">
                <img src="gif/free.gif" alt="City icon GIF">
                <h3>Free Advertising!</h3>
                <p>Get your business listed on our platform for free. Reach thousands of customers in your area.</p>
                <a href="login" class="promo-btn">Get Started Now</a>
            </div>

            <h2>Popular Categories</h2>
            <div class="categories-grid">
                <?php if ($sidebarData['popularDataFound']): ?>
                    <?php foreach ($sidebarData['popularData'] as $popularData): ?>
                        <div class="category-card">
                            <img src="./images/<?php echo htmlspecialchars($popularData['categories_img_url']); ?>"
                                alt="CCTV & Security Solutions">
                            <span><?php echo htmlspecialchars($popularData['categories_name']); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No Data Found.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <button class="filter-btn" onclick="document.getElementById('filterSidebar').classList.toggle('active');">☰</button>
<?php } ?>