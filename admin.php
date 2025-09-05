<?php
require_once __DIR__ . '/includes/connection.php';
// Check if the user is logged in, if not then redirect to login page
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
<style>
    .list-group-item a {
        text-decoration: none;
        /* Removes the underline from the links */
    }

    /* Adds space to the left by increasing padding */
    .list-group-item {
        padding-left: 20px !important;
    }
</style>
<div class="container">
    <aside class="sidebar accordion" id="filterSidebar">
        <h3>Actions</h3>
        <div class="accordion" id="accordionActions">

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAdv">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseAdv" aria-expanded="false" aria-controls="collapseAdv">
                        Advertisements
                    </button>
                </h2>
                <div id="collapseAdv" class="accordion-collapse collapse" aria-labelledby="headingAdv"
                    data-bs-parent="#accordionActions">
                    <div class="accordion-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">Show</a></li>
                            <li class="list-group-item"><a href="#">Add</a></li>
                            <li class="list-group-item"><a href="#">Update</a></li>
                            <li class="list-group-item"><a href="#">Delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCat">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCat" aria-expanded="false" aria-controls="collapseCat">
                        Categories
                    </button>
                </h2>
                <div id="collapseCat" class="accordion-collapse collapse" aria-labelledby="headingCat"
                    data-bs-parent="#accordionActions">
                    <div class="accordion-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">Show</a></li>
                            <li class="list-group-item"><a href="#">Add</a></li>
                            <li class="list-group-item"><a href="#">Update</a></li>
                            <li class="list-group-item"><a href="#">Delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCust">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCust" aria-expanded="false" aria-controls="collapseCust">
                        Customers
                    </button>
                </h2>
                <div id="collapseCust" class="accordion-collapse collapse" aria-labelledby="headingCust"
                    data-bs-parent="#accordionActions">
                    <div class="accordion-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">Show</a></li>
                            <li class="list-group-item"><a href="#">Add</a></li>
                            <li class="list-group-item"><a href="#">Update</a></li>
                            <li class="list-group-item"><a href="#">Delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </aside>
    <main class="main-content">
        <div class="promo-card">
            <h3>Work Area!</h3>
        </div>
    </main>
</div>
<script>
    function toggleDropdown(element) {
        const dropdown = element.querySelector('.dropdown-menu');
        dropdown.classList.toggle('show');
    }</script>
<button class="filter-btn" onclick="document.getElementById('filterSidebar').classList.toggle('active');">☰</button>

<?php require_once __DIR__ . '/includes/footer.php'; ?>