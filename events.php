<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - PEEF</title>

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
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--brand-green);
            text-align: center;
            margin-bottom: 3rem;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--brand-gold);
            margin: 10px auto 0;
            border-radius: 2px;
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

        .event-list-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .event-list-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
                <a href="events.php" class="nav-link active text-gray-600">Events</a>
                <a href="knowledge_hub.php" class="nav-link text-gray-600 hover:text-brand-green">Knowledge Hub</a>
                <a href="gallery.php" class="nav-link text-gray-600 hover:text-brand-green">Gallery</a>
                <a href="contact.php" class="nav-link text-gray-600 hover:text-brand-green">Contact</a>
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
             <a href="events.php" class="block text-brand-green font-bold">Events</a>
             <a href="knowledge_hub.php" class="block text-gray-600 hover:text-brand-green">Knowledge Hub</a>
             <a href="gallery.php" class="block text-gray-600 hover:text-brand-green">Gallery</a>
             <a href="contact.php" class="block text-gray-600 hover:text-brand-green">Contact</a>
             <hr/>
             <a href="login.php" class="block text-gray-600 hover:text-brand-green">Login</a>
             <a href="members.php" class="block mt-2 btn-primary text-center">Sign Up</a>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header" style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?q=80&w=2670&auto=format&fit=crop');">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">Our Events</h1>
            <p class="text-lg mt-2">Connect, learn, and grow with PEEF's exclusive events.</p>
        </div>
    </section>

    <main>
        <!-- Events Listing Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Upcoming Events</h2>
                <div class="space-y-8">
                    <!-- Event 1 -->
                    <div class="event-list-card bg-white rounded-lg shadow-md overflow-hidden md:flex">
                        <div class="md:w-1/3">
                            <img src="https://images.unsplash.com/photo-1560523160-754a9e25c68f?q=80&w=2574&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x300/dddddd/333333?text=Event';" alt="Conference" class="w-full h-full object-cover">
                        </div>
                        <div class="md:w-2/3 p-6 flex flex-col justify-between">
                            <div>
                                <p class="text-sm text-brand-green font-bold">October 25, 2025</p>
                                <h3 class="text-2xl font-bold text-brand-dark my-2">Annual Skills Development Conference</h3>
                                <p class="text-gray-600 mb-4">Join industry leaders to discuss the future of work and skills management in Nigeria. A premier event for networking and learning.</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <p class="font-semibold"><i class="fas fa-map-marker-alt mr-2 text-brand-gold"></i>Lagos, Nigeria</p>
                                <a href="event_details.php" class="btn-primary !py-2 !px-6 !text-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <!-- Event 2 -->
                    <div class="event-list-card bg-white rounded-lg shadow-md overflow-hidden md:flex">
                        <div class="md:w-1/3">
                            <img src="https://images.unsplash.com/photo-1587825140708-df876c1b5df1?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x300/dddddd/333333?text=Event';" alt="Webinar" class="w-full h-full object-cover">
                        </div>
                        <div class="md:w-2/3 p-6 flex flex-col justify-between">
                            <div>
                                <p class="text-sm text-brand-green font-bold">November 12, 2025</p>
                                <h3 class="text-2xl font-bold text-brand-dark my-2">Webinar: The Role of AI in HR</h3>
                                <p class="text-gray-600 mb-4">An insightful online session on how Artificial Intelligence is transforming human resource management and talent acquisition.</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <p class="font-semibold"><i class="fas fa-video mr-2 text-brand-gold"></i>Online Event</p>
                                <a href="event_details.php" class="btn-primary !py-2 !px-6 !text-sm">Register Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Event 3 -->
                    <div class="event-list-card bg-white rounded-lg shadow-md overflow-hidden md:flex">
                        <div class="md:w-1/3">
                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x300/dddddd/333333?text=Event';" alt="Gala" class="w-full h-full object-cover">
                        </div>
                        <div class="md:w-2/3 p-6 flex flex-col justify-between">
                            <div>
                                <p class="text-sm text-brand-green font-bold">December 05, 2025</p>
                                <h3 class="text-2xl font-bold text-brand-dark my-2">PEEF End-of-Year Gala</h3>
                                <p class="text-gray-600 mb-4">A night to celebrate our achievements and honor our top contributors and members. Join us for an evening of elegance and networking.</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <p class="font-semibold"><i class="fas fa-map-marker-alt mr-2 text-brand-gold"></i>Abuja, Nigeria</p>
                                <a href="event_details.php" class="btn-primary !py-2 !px-6 !text-sm">Get Tickets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Past Events Section -->
        <section class="py-20 bg-brand-light-bg">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Past Events</h2>
                <p class="text-center text-gray-600 max-w-2xl mx-auto -mt-8 mb-12">Explore moments from our previous gatherings and see the impact we've made together.</p>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Past Event 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2832&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x250/dddddd/333333?text=Past+Event';" alt="Past Event" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <p class="text-sm text-gray-500">August 15, 2025</p>
                            <h4 class="font-bold text-lg mt-1">Youth Empowerment Summit</h4>
                            <a href="gallery.php" class="text-brand-green font-semibold mt-2 inline-block hover:text-brand-gold">View Gallery <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                    <!-- Past Event 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x250/dddddd/333333?text=Past+Event';" alt="Past Event" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <p class="text-sm text-gray-500">June 20, 2025</p>
                            <h4 class="font-bold text-lg mt-1">Leadership Masterclass</h4>
                            <a href="gallery.php" class="text-brand-green font-semibold mt-2 inline-block hover:text-brand-gold">View Gallery <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                    <!-- Past Event 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x250/dddddd/333333?text=Past+Event';" alt="Past Event" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <p class="text-sm text-gray-500">April 10, 2025</p>
                            <h4 class="font-bold text-lg mt-1">Digital Skills Workshop</h4>
                            <a href="gallery.php" class="text-brand-green font-semibold mt-2 inline-block hover:text-brand-gold">View Gallery <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
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
 
