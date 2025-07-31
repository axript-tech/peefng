 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - PEEF</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            display: inline-block;
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
        
        /* Dashboard Card */
        .dashboard-card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .profile-stat {
            border-left: 3px solid var(--brand-gold);
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
                <a href="contact.php" class="nav-link text-gray-600 hover:text-brand-green">Contact</a>
            </div>
            <div class="hidden lg:flex items-center space-x-4">
                <span class="font-semibold">Welcome, Fatima!</span>
                <img src="https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?q=80&w=2487&auto=format&fit=crop" alt="User" class="w-10 h-10 rounded-full object-cover">
                <a href="logout.php" class="text-gray-500 hover:text-brand-green" title="Logout"><i class="fas fa-sign-out-alt text-xl"></i></a>
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
             <a href="contact.php" class="block text-gray-600 hover:text-brand-green">Contact</a>
             <hr/>
             <a href="logout.php" class="block text-gray-600 hover:text-brand-green">Logout</a>
        </div>
    </header>

    <main class="py-20">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold text-brand-dark mb-8">My Dashboard</h1>
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column: Profile -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="dashboard-card p-6 text-center">
                        <img src="https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?q=80&w=2487&auto=format&fit=crop" alt="User" class="w-32 h-32 rounded-full object-cover mx-auto mb-4">
                        <h2 class="text-2xl font-bold">Fatima Bello</h2>
                        <p class="text-gray-600">fatima@example.com</p>
                        <span class="inline-block bg-green-100 text-green-800 font-semibold px-3 py-1 rounded-full text-sm mt-2">Donor Member</span>
                    </div>
                    <div class="dashboard-card p-6">
                        <h3 class="text-xl font-bold mb-4">Profile Summary</h3>
                        <div class="space-y-4">
                            <div class="profile-stat ps-4">
                                <p class="text-sm text-gray-500">Job Title</p>
                                <p class="font-semibold">Financial Analyst</p>
                            </div>
                            <div class="profile-stat ps-4">
                                <p class="text-sm text-gray-500">Organisation</p>
                                <p class="font-semibold">PEEF Inc.</p>
                            </div>
                            <div class="profile-stat ps-4">
                                <p class="text-sm text-gray-500">Membership Since</p>
                                <p class="font-semibold">November 20, 2023</p>
                            </div>
                        </div>
                        <button class="w-full mt-6 bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300">Edit Profile</button>
                    </div>
                </div>
                
                <!-- Right Column: Details -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="dashboard-card p-6">
                        <h3 class="text-xl font-bold mb-4">My Registered Events</h3>
                        <div class="space-y-4">
                            <!-- Event Item -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-bold">Annual Skills Development Conference</p>
                                    <p class="text-sm text-gray-500">October 25, 2025 | Lagos, Nigeria</p>
                                </div>
                                <a href="event_details.php" class="text-brand-green font-semibold">View Details</a>
                            </div>
                            <!-- Event Item -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-bold">PEEF End-of-Year Gala</p>
                                    <p class="text-sm text-gray-500">December 05, 2025 | Abuja, Nigeria</p>
                                </div>
                                <a href="event_details.php" class="text-brand-green font-semibold">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card p-6">
                        <h3 class="text-xl font-bold mb-4">My Donation History</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b">
                                        <th class="py-2">Date</th>
                                        <th class="py-2">Amount</th>
                                        <th class="py-2">Status</th>
                                        <th class="py-2">Transaction ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="py-3">2025-07-28</td>
                                        <td class="py-3 font-semibold">₦25,000</td>
                                        <td class="py-3"><span class="badge bg-success">Completed</span></td>
                                        <td class="py-3 text-sm text-gray-500">TXN12345</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3">2024-12-15</td>
                                        <td class="py-3 font-semibold">₦100,000</td>
                                        <td class="py-3"><span class="badge bg-success">Completed</span></td>
                                        <td class="py-3 text-sm text-gray-500">TXN09876</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script>
        $(document).ready(function(){
            // Mobile menu toggle
            $('#mobile-menu-button').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
            });
        });
    </script>
</body>
</html>
