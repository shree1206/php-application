<?php
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
        <aside class="sidebar" id="filterSidebar">
            <h3>Filter by Category</h3>
            <ul>
                <li>CCTV & Security Solutions</li>
                <li>Restaurants</li>
                <li>Hotels</li>
                <li>Beauty Spa</li>
                <li>Home Decor</li>
                <li>Wedding Planning</li>
                <li>Education</li>
                <li>Rent & Hire</li>
                <li>Hospitals</li>
                <li>Contractors</li>
                <li>Pet Shops</li>
                <li>PG/Hostels</li>
                <li>Estate Agent</li>
                <li>Dentists</li>
                <li>Gym</li>
                <li>Loans</li>
                <li>Event Organisers</li>
                <li>Driving Schools</li>
                <li>Packers & Movers</li>
                <li>Courier Service</li>
            </ul>
        </aside>

        <main class="main-content">

            <div class="promo-card">
                <img src="gif/free.gif" alt="City icon GIF">
                <h3>Free Advertising!</h3>
                <p>Get your business listed on our platform for free. Reach thousands of customers in your area.</p>
                <a href="login" class="promo-btn">Get Started Now</a>
            </div>

            <h2>Popular Categories</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <img src="./images/cctv.jpg" alt="CCTV & Security Solutions">
                    <span>CCTV</span>
                </div>
                <div class="category-card">
                    <img src="./images/restaurant.jpg" alt="Restaurants">
                    <span>Restaurants</span>
                </div>
                <div class="category-card">
                    <img src="./images/hotels.jpg" alt="Hotels">
                    <span>Hotels</span>
                </div>
                <div class="category-card">
                    <img src="./images/spa.jpeg" alt="Beauty Spa">
                    <span>Beauty Spa</span>
                </div>
                <div class="category-card">
                    <img src="./images/homedecor.jpeg" alt="Home Decor">
                    <span>Home Decor</span>
                </div>
                <div class="category-card">
                    <img src="./images/wedding.jpeg" alt="Wedding Planning">
                    <span>Wedding Planning</span>
                </div>
                <div class="category-card">
                    <img src="./images/school.jpeg" alt="Education">
                    <span>Education</span>
                </div>
                <div class="category-card">
                    <img src="./images/rent.jpeg" alt="Rent & Hire">
                    <span>Rent & Hire</span>
                </div>
                <div class="category-card">
                    <img src="./images/hospital.jpeg" alt="Hospitals">
                    <span>Hospitals</span>
                </div>
                <div class="category-card">
                    <img src="./images/contractors.jpeg" alt="Contractors">
                    <span>Contractors</span>
                </div>
                <div class="category-card">
                    <img src="./images/petshop.jpeg" alt="Pet Shops">
                    <span>Pet Shops</span>
                </div>
                <div class="category-card">
                    <img src="./images/pg.jpeg" alt="PG/Hostels">
                    <span>PG/Hostels</span>
                </div>
                <div class="category-card">
                    <img src="./images/beautyparlor.jpeg" alt="Beauty Parlor">
                    <span>Beauty Parlor</span>
                </div>
                <div class="category-card">
                    <img src="./images/dentist.jpeg" alt="Dentists">
                    <span>Dentists</span>
                </div>
                <div class="category-card">
                    <img src="./images/gym.jpeg" alt="Gym">
                    <span>Gym</span>
                </div>
                <div class="category-card">
                    <img src="./images/loan.jpeg" alt="Loans">
                    <span>Loans</span>
                </div>
                <div class="category-card">
                    <img src="./images/doctors.jpeg" alt="Doctors">
                    <span>Doctors</span>
                </div>
                <div class="category-card">
                    <img src="./images/drivingschool.jpeg" alt="Driving Schools">
                    <span>Driving Schools</span>
                </div>
                <div class="category-card">
                    <img src="./images/packerandmover.jpeg" alt="Packers & Movers">
                    <span>Packers & Movers</span>
                </div>
                <div class="category-card">
                    <img src="./images/courier.jpeg" alt="Courier Service">
                    <span>Courier Service</span>
                </div>
            </div>
        </main>
    </div>

    <button class="filter-btn" onclick="document.getElementById('filterSidebar').classList.toggle('active');">☰</button>
    <a href="https://wa.me/917906466763" class="whatsapp-btn">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1200px-WhatsApp.svg.png"
            alt="WhatsApp" class="whatsapp-icon">
    </a>

    <a href="tel:+91XXXXXXXXXX" class="call-btn">
        <i class="fa fa-phone"></i> Call Us
    </a>


<?php } ?>