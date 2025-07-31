<?php
// Start the session to be able to access session variables.
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PEEF</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Leaflet CSS for Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!-- Custom Styles -->
    <style>
        :root {
            --brand-green: #044F04;
            --brand-gold: #fcb900;
            --brand-dark: #1a202c;
            --brand-light-bg: #f7fafc;
        }
        body {
            font-family: 'Quicksand', sans-serif;
            color: var(--brand-dark);
            background-color: var(--brand-light-bg);
        }
        .bg-brand-green { background-color: var(--brand-green); }
        .text-brand-green { color: var(--brand-green); }
        .bg-brand-gold { background-color: var(--brand-gold); }
        .text-brand-gold { color: var(--brand-gold); }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--brand-dark);
            background-color: var(--brand-gold);
            padding: 0.75rem 2rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .btn-primary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(252, 185, 0, 0.3);
        }
        
        /* Navbar styling */
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background-color: var(--brand-gold);
            transition: all 0.3s ease-in-out;
        }
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
            left: 0;
        }
        .nav-link.active {
            color: var(--brand-green) !important;
        }
        
        /* Page Header */
        .page-header {
            height: 40vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            background-size: cover;
            background-position: center;
        }
        
        #map {
            height: 400px;
            border-radius: 1rem;
            z-index: 1;
        }

        .spinner {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-brand-light-bg">

    <!-- Navigation Bar -->
    <header class="bg-white/90 backdrop-blur-md shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="index.php">
                <img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/044F04/FFFFFF?text=PEEF&font=quicksand';" alt="PEEF Logo" class="h-12">
            </a>
            <div class="hidden lg:flex items-center space-x-8 font-semibold">
                <a href="index.php" class="nav-link text-gray-600 hover:text-brand-green">Home</a>
                <a href="about.php" class="nav-link text-gray-600 hover:text-brand-green">About Us</a>
                <a href="events.php" class="nav-link text-gray-600 hover:text-brand-green">Events</a>
                <a href="knowledge_hub.php" class="nav-link text-gray-600 hover:text-brand-green">Knowledge Hub</a>
                <a href="gallery.php" class="nav-link text-gray-600 hover:text-brand-green">Gallery</a>
                <a href="contact.php" class="nav-link active text-gray-600">Contact</a>
            </div>
            <div class="hidden lg:flex items-center space-x-6">
                 <a href="login.php" class="font-semibold text-gray-600 hover:text-brand-green">Login</a>
                 <a href="members.php" class="btn-primary !py-2 !px-6 !text-sm">Sign Up</a>
            </div>
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="text-brand-dark focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden px-6 pt-2 pb-4 space-y-3 bg-white/95">
             <a href="index.php" class="block text-gray-600 hover:text-brand-green">Home</a>
             <a href="about.php" class="block text-gray-600 hover:text-brand-green">About Us</a>
             <a href="events.php" class="block text-gray-600 hover:text-brand-green">Events</a>
             <a href="knowledge_hub.php" class="block text-gray-600 hover:text-brand-green">Knowledge Hub</a>
             <a href="gallery.php" class="block text-gray-600 hover:text-brand-green">Gallery</a>
             <a href="contact.php" class="block text-brand-green font-bold">Contact</a>
             <hr/>
             <a href="login.php" class="block text-gray-600 hover:text-brand-green">Login</a>
             <a href="members.php" class="block mt-2 btn-primary text-center">Sign Up</a>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header" style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1556740738-b6a63e2775d2?q=80&w=2670&auto=format&fit=crop');">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">Get In Touch</h1>
            <p class="text-lg mt-2">We'd love to hear from you. Reach out with any questions or inquiries.</p>
        </div>
    </section>

    <main>
        <!-- Contact Form & Info Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- Contact Form -->
                    <div class="lg:col-span-2 bg-white p-8 rounded-xl shadow-lg">
                        <h2 class="text-3xl font-bold text-brand-dark mb-6">Send us a Message</h2>
                        
                        <div id="form-message" class="hidden mb-6" role="alert"></div>

                        <form id="contact-form" method="POST">
                            <div class="grid md:grid-cols-2 gap-6 mb-6">
                                <input type="text" name="name" placeholder="Your Name" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
                                <input type="email" name="email" placeholder="Your Email" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
                            </div>
                            <input type="text" name="subject" placeholder="Subject" class="w-full p-3 border rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
                            <textarea name="message" placeholder="Your Message" rows="6" class="w-full p-3 border rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-brand-gold" required></textarea>
                            <button type="submit" id="submit-btn" class="btn-primary w-full">
                                <span class="btn-text">Send Message</span>
                                <i class="fas fa-spinner spinner ml-2 hidden"></i>
                            </button>
                        </form>
                    </div>
                    <!-- Contact Info -->
                    <div class="space-y-8">
                        <div class="bg-white p-8 rounded-xl shadow-lg">
                            <h3 class="text-2xl font-bold text-brand-dark mb-4">Contact Details</h3>
                            <ul class="space-y-4 text-gray-700">
                                <li class="flex items-start"><i class="fas fa-map-marker-alt w-6 text-center text-brand-gold text-xl mt-1"></i><span class="ml-4">Infinity House, 11 Kaura Namoda Street, Area 3, Garki, Abuja, Nigeria.</span></li>
                                <li class="flex items-start"><i class="fas fa-envelope w-6 text-center text-brand-gold text-xl mt-1"></i><a href="mailto:info@peef.ng" class="ml-4 hover:text-brand-green">info@peef.ng</a></li>
                                <li class="flex items-start"><i class="fas fa-phone w-6 text-center text-brand-gold text-xl mt-1"></i><a href="tel:+2348066068596" class="ml-4 hover:text-brand-green">+234 806 606 8596</a></li>
                            </ul>
                        </div>
                        <div class="bg-white p-8 rounded-xl shadow-lg">
                            <h3 class="text-2xl font-bold text-brand-dark mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a href="https://x.com/PeefSdg" target="_blank" class="text-gray-500 hover:text-brand-gold transition-colors text-2xl"><i class="fab fa-twitter"></i></a>
                                <a href="https://web.facebook.com/peef.sdg" target="_blank" class="text-gray-500 hover:text-brand-gold transition-colors text-2xl"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://ng.linkedin.com/in/peef-sdg-4b6403372" target="_blank" class="text-gray-500 hover:text-brand-gold transition-colors text-2xl"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.instagram.com/peefsdg" target="_blank" class="text-gray-500 hover:text-brand-gold transition-colors text-2xl"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.youtube.com/@peopleexpertiseandexcellen4625" target="_blank" class="text-gray-500 hover:text-brand-gold transition-colors text-2xl"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Map Section -->
        <section class="pb-20">
            <div class="container mx-auto px-6">
                <div id="map"></div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-brand-green text-white pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About Section -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4"><span class="text-brand-gold">PEEF</span> Foundation</h3>
                    <p class="text-sm text-gray-200">People Expertise and Excellence Foundation is a not-for-profit organisation championing skills development in Nigeria.</p>
                     <div class="flex space-x-4 mt-6">
                        <a href="https://x.com/PeefSdg" target="_blank" class="text-gray-200 hover:text-brand-gold transition-colors"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="https://web.facebook.com/peef.sdg" target="_blank" class="text-gray-200 hover:text-brand-gold transition-colors"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="https://ng.linkedin.com/in/peef-sdg-4b6403372" target="_blank" class="text-gray-200 hover:text-brand-gold transition-colors"><i class="fab fa-linkedin-in fa-lg"></i></a>
                        <a href="https://www.instagram.com/peefsdg" target="_blank" class="text-gray-200 hover:text-brand-gold transition-colors"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="https://www.youtube.com/@peopleexpertiseandexcellen4625" target="_blank" class="text-gray-200 hover:text-brand-gold transition-colors"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="about.php" class="text-gray-200 hover:text-brand-gold transition-colors">About Us</a></li>
                        <li><a href="events.php" class="text-gray-200 hover:text-brand-gold transition-colors">Events</a></li>
                        <li><a href="members.php" class="text-gray-200 hover:text-brand-gold transition-colors">Become a Member</a></li>
                        <li><a href="contact.php" class="text-gray-200 hover:text-brand-gold transition-colors">Contact Us</a></li>
                         <li><a href="knowledge_hub.php" class="text-gray-200 hover:text-brand-gold transition-colors">Knowledge Hub</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                 <div>
                    <h3 class="text-lg font-bold text-white mb-4">Contact Info</h3>
                     <ul class="space-y-3 text-sm">
                        <li class="flex items-start"><i class="fas fa-map-marker-alt mr-3 mt-1 text-brand-gold"></i><span class="text-gray-200">Infinity House, 11 Kaura Namoda Street, Area 3, Garki, Abuja, Nigeria.</span></li>
                        <li class="flex items-start"><i class="fas fa-envelope mr-3 mt-1 text-brand-gold"></i><a href="mailto:info@peef.ng" class="text-gray-200 hover:text-brand-gold">info@peef.ng</a></li>
                        <li class="flex items-start"><i class="fas fa-phone mr-3 mt-1 text-brand-gold"></i><a href="tel:+2348066068596" class="text-gray-200 hover:text-brand-gold">+234 806 606 8596</a></li>
                    </ul>
                </div>
                <!-- Newsletter -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">Join Our Newsletter</h3>
                    <p class="text-sm text-gray-200 mb-4">Get exclusive updates on our events and initiatives.</p>
                    <form action="#" method="POST">
                        <div class="flex">
                            <input type="email" placeholder="Your Email" class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-l-md focus:outline-none focus:ring-2 focus:ring-brand-gold text-white text-sm placeholder-gray-300">
                            <button type="submit" class="bg-brand-gold text-brand-dark px-4 py-2 rounded-r-md font-bold hover:bg-yellow-300 transition-colors">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-12 py-6 border-t border-white/20 flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="text-gray-300 mb-4 md:mb-0">&copy; 2025 People Expertise and Excellence Foundation. All Rights Reserved.</p>
                
                <div class="flex items-center space-x-2 text-gray-300 mb-4 md:mb-0">
                    <i class="fas fa-eye"></i>
                    <span>Visitors: 1,234</span>
                </div>

                <p class="text-gray-300">Developed by <a href="https://axript.com.ng" target="_blank" rel="noopener noreferrer" class="text-brand-gold hover:underline">Axript Tech</a></p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        $(document).ready(function(){
            // Mobile menu toggle
            $('#mobile-menu-button').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
            });

            // Leaflet Map
            var map = L.map('map').setView([9.05785, 7.49508], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            var marker = L.marker([9.05785, 7.49508]).addTo(map);
            marker.bindPopup("<b>PEEF Headquarters</b><br>Infinity House, Abuja.").openPopup();

            // Contact Form AJAX Submission
            $('#contact-form').on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $button = $('#submit-btn');
                const $btnText = $button.find('.btn-text');
                const $spinner = $button.find('.spinner');
                const $formMessage = $('#form-message');

                // Show loading state
                $btnText.text('Sending...');
                $spinner.removeClass('hidden');
                $button.prop('disabled', true);
                $formMessage.addClass('hidden').removeClass('bg-green-100 border-green-400 text-green-700 bg-red-100 border-red-400 text-red-700');

                $.ajax({
                    type: 'POST',
                    url: 'php/process/process_contact.php',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $formMessage.html('<strong class="font-bold">Success!</strong> <span class="block sm:inline">' + response.message + '</span>')
                                       .addClass('bg-green-100 border-green-400 text-green-700');
                            $form[0].reset(); // Clear the form
                        } else {
                            $formMessage.html('<strong class="font-bold">Error:</strong> <span class="block sm:inline">' + response.message + '</span>')
                                       .addClass('bg-red-100 border-red-400 text-red-700');
                        }
                    },
                    error: function() {
                        $formMessage.html('<strong class="font-bold">Error:</strong> <span class="block sm:inline">An unexpected error occurred. Please try again.</span>')
                                   .addClass('bg-red-100 border-red-400 text-red-700');
                    },
                    complete: function() {
                        // Reset button state
                        $btnText.text('Send Message');
                        $spinner.addClass('hidden');
                        $button.prop('disabled', false);
                        $formMessage.removeClass('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>
