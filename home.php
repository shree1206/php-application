<?php
if (!defined('APP_INIT')) {
    header("location: 404");
    exit;
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Caller Dictionary - Home</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary-color: #3f51b5;
                --secondary-color: #f5f5f5;
                --dark-color: #333;
                --light-color: #fff;
                --font-main: 'Poppins', sans-serif;
                --card-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
                --card-hover-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            }

            /* ----- Global Styles & Layout ----- */
            body {
                font-family: var(--font-main);
                margin: 0;
                padding: 0;
                background-color: var(--secondary-color);
                color: var(--dark-color);
            }

            .header {
                background-color: var(--primary-color);
                color: var(--light-color);
                padding: 40px 20px;
                text-align: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .header h1 {
                margin: 0 0 5px;
                font-size: 2.5rem;
            }

            .header p {
                font-size: 1.1rem;
                opacity: 0.9;
            }

            .container {
                display: flex;
                gap: 20px;
                max-width: 1400px;
                margin: 20px auto;
                padding: 0 20px;
            }

            /* ----- Sidebar Filter Section ----- */
            .sidebar {
                flex: 0 0 250px;
                background-color: var(--light-color);
                padding: 20px;
                border-radius: 8px;
                box-shadow: var(--card-shadow);
                height: fit-content;
            }

            .sidebar h3 {
                margin-top: 0;
                border-bottom: 2px solid var(--primary-color);
                padding-bottom: 10px;
                font-size: 1.2rem;
            }

            .sidebar ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .sidebar li {
                padding: 10px 0;
                cursor: pointer;
                transition: color 0.3s ease;
            }

            .sidebar li:hover {
                color: var(--primary-color);
            }

            /* ----- Category Cards Layout ----- */
            .main-content {
                flex: 1;
            }

            .main-content h2 {
                margin-top: 0;
                color: var(--primary-color);
            }

            /* ----- Free Advertising Card ----- */
            .promo-card {
                background-color: #28a745;
                color: var(--light-color);
                padding: 30px;
                border-radius: 8px;
                box-shadow: var(--card-shadow);
                text-align: center;
                margin-bottom: 20px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .promo-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            }

            .promo-card h3 {
                margin: 0 0 10px;
                font-size: 2rem;
            }

            .promo-card p {
                margin-bottom: 20px;
                opacity: 0.9;
            }

            .promo-card a.promo-btn {
                display: inline-block;
                background-color: var(--light-color);
                color: #28a745;
                padding: 10px 25px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: 600;
                transition: background-color 0.3s ease;
            }

            .promo-card a.promo-btn:hover {
                background-color: #e2e6ea;
            }

            .categories-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(150px, 1fr));
                gap: 30px;
                text-align: center;
            }

            @media (max-width: 992px) {
                .categories-grid {
                    /* On medium screens, show 3 columns */
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 768px) {
                .categories-grid {
                    /* On tablet screens, show 2 columns */
                    grid-template-columns: repeat(4, 1fr);
                }
            }

            @media (max-width: 576px) {
                .categories-grid {
                    /* On mobile screens, show 1 column */
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            /* ----- Category Cards Styling & Animations ----- */
            .category-card {
                background-color: var(--light-color);
                padding: 20px;
                border-radius: 8px;
                box-shadow: var(--card-shadow);
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;

                /* Initial state for animation */
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s ease forwards;
            }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .category-card:hover {
                transform: translateY(-5px);
                box-shadow: var(--card-hover-shadow);
            }

            .category-card img {
                width: 70px;
                height: 70px;
                margin-bottom: 10px;
                border-radius: 20%;
                object-fit: cover;
            }

            .category-card span {
                display: block;
                font-size: 0.8rem;
                font-weight: bold;
                color: var(--dark-color);
                word-wrap: break-word;
            }

            /* ----- Responsive Filter Button ----- */
            .filter-btn {
                display: none;
                position: fixed;
                bottom: 20px;
                left: 20px;
                background-color: var(--primary-color);
                color: var(--light-color);
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                cursor: pointer;
                z-index: 1000;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            @media (max-width: 768px) {
                .container {
                    flex-direction: column;
                    padding: 10px;
                }

                .sidebar {
                    position: fixed;
                    top: 0;
                    left: -300px;
                    width: 250px;
                    height: 100%;
                    z-index: 999;
                    transition: left 0.3s ease;
                    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
                }

                .sidebar.active {
                    left: 0;
                }

                .filter-btn {
                    display: block;
                }
            }

            .whatsapp-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                width: 60px;
                height: 60px;
                background-color: #25d366;
                border-radius: 50%;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                display: flex;
                justify-content: center;
                align-items: center;
                transition: transform 0.3s ease;
            }

            .whatsapp-btn:hover {
                transform: scale(1.1);
            }

            .whatsapp-icon {
                width: 35px;
                height: 35px;
            }

            .call-btn {
                position: fixed;
                top: 50%;
                right: 15px;
                transform: translateY(-50%);
                z-index: 1000;
                padding: 15px;
                /* Updated Color: Vibrant Deep Red */
                background-color: brown;
                color: white;
                border-radius: 8px;
                /* Enhanced Shadow for a 'floating' look */
                box-shadow: 0 6px 12px rgba(233, 30, 99, 0.4);
                text-decoration: none;
                transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
            }

            .call-btn:hover {
                transform: translateY(-50%) scale(1.1);
                background-color: #c82333;
            }

            /* Optional custom styles for the modal content */
            .modal-body {
                text-align: center;
            }

            .modal-body h4 {
                color: #0d6efd;
                font-weight: bold;
            }
        </style>
    </head>

    <body>

        <header class="header">
            <h1>Caller Dictionary</h1>
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
                    <h3>Free Advertising!</h3>
                    <p>Get your business listed on our platform for free. Reach thousands of customers in your area.</p>
                    <a href="login.php" class="promo-btn">Get Started Now</a>
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


    </body>

    </html>
<?php } ?>