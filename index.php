<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEEF - People Expertise and Excellence Foundation</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

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
        .btn-secondary {
            display: inline-block;
            font-weight: 700;
            color: #ffffff;
            background-color: transparent;
            border: 2px solid var(--brand-gold);
            padding: 0.75rem 2rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: var(--brand-gold);
            color: var(--brand-dark);
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
        
        /* Hero Slider Styling */
        .hero-slider .slick-slide {
            height: 85vh;
            display: flex !important;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            background-size: cover;
            background-position: center;
        }
        .hero-slider .slick-dots {
            bottom: 25px;
        }
        .hero-slider .slick-dots li button:before {
            font-size: 12px;
            color: white;
            opacity: 0.5;
            transition: all 0.3s ease;
        }
        .hero-slider .slick-dots li.slick-active button:before {
            color: var(--brand-gold);
            opacity: 1;
        }
        
        .slide-content {
            animation: fadeInDown 1s ease-in-out;
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }
        .whatsapp-float:hover {
            transform: scale(1.1);
        }
        
        /* Stylish Event Card */
        .event-card {
            background-size: cover;
            background-position: center;
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.1) 100%);
            z-index: 1;
        }
        .event-card-content {
            position: relative;
            z-index: 2;
            padding: 1.5rem;
        }
        .countdown-timer {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .countdown-timer > div {
            background: rgba(255,255,255,0.1);
            padding: 0.5rem;
            border-radius: 0.5rem;
            text-align: center;
            backdrop-filter: blur(5px);
        }
        .countdown-timer .time {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .countdown-timer .label {
            font-size: 0.7rem;
            text-transform: uppercase;
        }
        
        /* YouTube Video Section */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .video-playlist .playlist-item {
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .video-playlist .playlist-item.active {
            background-color: var(--brand-gold);
            color: var(--brand-dark);
        }
        .video-playlist .playlist-item:hover:not(.active) {
            background-color: #f3f4f6;
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
                <a href="index.php" class="nav-link active text-gray-600">Home</a>
                <a href="about.php" class="nav-link text-gray-600 hover:text-brand-green">About Us</a>
                <a href="events.php" class="nav-link text-gray-600 hover:text-brand-green">Events</a>
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
             <a href="index.php" class="block text-brand-green font-bold">Home</a>
             <a href="about.php" class="block text-gray-600 hover:text-brand-green">About Us</a>
             <a href="events.php" class="block text-gray-600 hover:text-brand-green">Events</a>
             <a href="knowledge_hub.php" class="block text-gray-600 hover:text-brand-green">Knowledge Hub</a>
             <a href="gallery.php" class="block text-gray-600 hover:text-brand-green">Gallery</a>
             <a href="contact.php" class="block text-gray-600 hover:text-brand-green">Contact</a>
             <hr/>
             <a href="login.php" class="block text-gray-600 hover:text-brand-green">Login</a>
             <a href="members.php" class="block mt-2 btn-primary text-center">Sign Up</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-slider">
        <div style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1541746972996-4e0b0f43e02a?q=80&w=2670&auto=format&fit=crop');">
             <div class="relative z-10 p-8 max-w-4xl mx-auto slide-content">
                <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">
                   Championing Skills Development in Nigeria
                </h1>
                <p class="text-xl md:text-2xl mb-8 font-light">Join us to increase skill proficiency and create a productive workforce across the nation.</p>
                <div class="space-x-4">
                    <a href="members.php" class="btn-primary">Become a Member</a>
                    <a href="about.php" class="btn-secondary">Our Mission</a>
                </div>
            </div>
        </div>
        <div style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2670&auto=format&fit=crop');">
             <div class="relative z-10 p-8 max-w-4xl mx-auto slide-content">
                <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">
                   Empowering the Next Generation
                </h1>
                <p class="text-xl md:text-2xl mb-8 font-light">We provide training, mentorship, and opportunities for Nigeria's youth.</p>
                <div class="space-x-4">
                    <a href="knowledge_hub.php" class="btn-primary">Explore Resources</a>
                </div>
            </div>
        </div>
        <div style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1556761175-b413da4b248b?q=80&w=2574&auto=format&fit=crop');">
             <div class="relative z-10 p-8 max-w-4xl mx-auto slide-content">
                <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">
                   Building a Network of Experts
                </h1>
                <p class="text-xl md:text-2xl mb-8 font-light">Connect with professionals and leaders from various industries across Nigeria.</p>
                <div class="space-x-4">
                    <a href="events.php" class="btn-primary">See Our Events</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <!-- Our Impact Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Our Impact</h2>
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <i class="fas fa-users text-5xl text-brand-gold mb-4"></i>
                        <p id="impact-members" class="text-5xl font-bold text-brand-green mb-2">...</p>
                        <p class="text-lg text-gray-600">Members & Experts</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <i class="fas fa-calendar-check text-5xl text-brand-gold mb-4"></i>
                        <p id="impact-events" class="text-5xl font-bold text-brand-green mb-2">...</p>
                        <p class="text-lg text-gray-600">Events Hosted</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <i class="fas fa-seedling text-5xl text-brand-gold mb-4"></i>
                        <p class="text-5xl font-bold text-brand-green mb-2">3,000+</p>
                        <p class="text-lg text-gray-600">Professionals Trained</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- About Us Snippet -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/600x400/044f04/ffffff?text=PEEF+Team';" alt="Professional Nigerian team collaborating" class="rounded-2xl shadow-2xl w-full h-full object-cover">
                </div>
                <div class="md:w-1/2">
                    <h2 class="section-title !text-left !ml-0">About PEEF</h2>
                    <p class="text-lg text-gray-700 mb-4">The People Expertise and Excellence Foundation (PEEF) is a not-for-profit organization dedicated to enhancing the skills and productivity of the Nigerian workforce. Our vision is to be the most respected leader in championing skills development in Nigeria.</p>
                    <p class="text-lg text-gray-700 mb-6"><strong>Our Core Values:</strong> Professionalism, Integrity, Sincerity, Productivity and Excellence (PISPE).</p>
                    <a href="about.php" class="btn-primary">Learn More About Us</a>
                </div>
            </div>
        </section>
        
        <!-- Our National Footprint Section -->
        <section class="py-20 bg-brand-light-bg relative">
            <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('https://images.unsplash.com/photo-1568992687947-868a62a9f521?q=80&w=2832&auto=format&fit=crop');"></div>
            <div class="absolute inset-0 bg-brand-green opacity-80"></div>
            <div class="container mx-auto px-6 relative z-10 text-white">
                <h2 class="section-title !text-white">Our National Footprint</h2>
                <p class="text-center text-xl max-w-3xl mx-auto mb-12">We are a truly national organization, with a diverse and powerful network of professionals dedicated to development in every corner of the country.</p>
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div class="bg-white/10 p-8 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-map-marker-alt text-5xl text-brand-gold mb-4"></i>
                        <p class="text-5xl font-bold mb-2">36+</p>
                        <p class="text-lg">States Represented</p>
                    </div>
                    <div class="bg-white/10 p-8 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-users text-5xl text-brand-gold mb-4"></i>
                        <p class="text-5xl font-bold mb-2">1,200+</p>
                        <p class="text-lg">Members Nationwide</p>
                    </div>
                    <div class="bg-white/10 p-8 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-globe-africa text-5xl text-brand-gold mb-4"></i>
                        <p class="text-5xl font-bold mb-2">6</p>
                        <p class="text-lg">Geopolitical Zones</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Upcoming Events Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Upcoming Events</h2>
                <div id="upcoming-events-grid" class="grid md:grid-cols-3 gap-8">
                    <!-- Events will be loaded here by jQuery -->
                </div>
                <div class="text-center mt-12">
                    <a href="events.php" class="btn-primary">View All Events</a>
                </div>
            </div>
        </section>
        
        <!-- Testimonials Section -->
        <section class="py-20 bg-brand-light-bg">
            <div class="container mx-auto px-6">
                <h2 class="section-title">What Our Members Say</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-xl flex items-start space-x-6">
                        <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/80x80/cccccc/333333?text=Member';" alt="Member photo" class="w-20 h-20 rounded-full object-cover">
                        <div>
                            <p class="text-gray-600 italic">"PEEF has been instrumental in my professional growth. The network and resources are invaluable for anyone serious about making an impact in Nigeria."</p>
                            <h4 class="font-bold text-brand-green mt-4">- Adebayo Adekunle</h4>
                            <p class="text-sm text-gray-500">Tech Entrepreneur, Nigeria</p>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-xl flex items-start space-x-6">
                        <img src="https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?q=80&w=2487&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/80x80/cccccc/333333?text=Member';" alt="Member photo" class="w-20 h-20 rounded-full object-cover">
                        <div>
                            <p class="text-gray-600 italic">"The mentorship program at PEEF connected me with industry leaders who have guided my career. I'm grateful for the community and support."</p>
                            <h4 class="font-bold text-brand-green mt-4">- Fatima Bello</h4>
                            <p class="text-sm text-gray-500">Financial Analyst, Nigeria</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest Blog Posts -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="section-title">From Our Knowledge Hub</h2>
                <div id="latest-posts-grid" class="grid md:grid-cols-3 gap-8">
                    <!-- Blog posts will be loaded here by jQuery -->
                </div>
                 <div class="text-center mt-12">
                    <a href="knowledge_hub.php" class="btn-primary">Visit Knowledge Hub</a>
                </div>
            </div>
        </section>
        
        <!-- Recent Exploits (YouTube) Section -->
        <section class="py-20 bg-brand-light-bg">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Our Recent Exploits</h2>
                <div class="grid lg:grid-cols-3 gap-8 items-start">
                    <div class="lg:col-span-2">
                        <div class="video-container">
                            <iframe id="youtube-player" src="https://www.youtube.com/embed/-7C0cqDidt4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="video-playlist bg-white rounded-xl p-4 max-h-[450px] overflow-y-auto">
                        <div class="playlist-item p-4 rounded-lg flex items-center space-x-4 active" data-video-id="-7C0cqDidt4">
                            <img src="https://img.youtube.com/vi/-7C0cqDidt4/mqdefault.jpg" class="w-24 h-16 object-cover rounded-md" alt="Video thumbnail">
                            <div>
                                <h4 class="font-bold">PEEF Event Highlight 1</h4>
                                <p class="text-sm text-gray-500">Community Outreach</p>
                            </div>
                        </div>
                        <div class="playlist-item p-4 rounded-lg flex items-center space-x-4" data-video-id="L_RjhmVVLn0">
                            <img src="https://img.youtube.com/vi/L_RjhmVVLn0/mqdefault.jpg" class="w-24 h-16 object-cover rounded-md" alt="Video thumbnail">
                            <div>
                                <h4 class="font-bold">PEEF Empowerment Series</h4>
                                <p class="text-sm text-gray-500">Skills for the Future</p>
                            </div>
                        </div>
                        <div class="playlist-item p-4 rounded-lg flex items-center space-x-4" data-video-id="X0gGwatG3tU">
                            <img src="https://img.youtube.com/vi/X0gGwatG3tU/mqdefault.jpg" class="w-24 h-16 object-cover rounded-md" alt="Video thumbnail">
                            <div>
                                <h4 class="font-bold">A Message from PEEF</h4>
                                <p class="text-sm text-gray-500">Our Vision for Nigeria</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Get Involved Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Get Involved</h2>
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div class="p-6">
                        <div class="bg-brand-gold text-brand-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto text-2xl font-bold">1</div>
                        <h3 class="text-2xl font-bold text-brand-green my-4">Join as a Member</h3>
                        <p class="text-gray-600">Become part of our growing network of professionals and experts. Access exclusive resources, events, and opportunities.</p>
                    </div>
                    <div class="p-6">
                        <div class="bg-brand-gold text-brand-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto text-2xl font-bold">2</div>
                        <h3 class="text-2xl font-bold text-brand-green my-4">Sponsor Our Vision</h3>
                        <p class="text-gray-600">Partner with us to make a larger impact. We offer various sponsorship packages with great visibility and benefits.</p>
                    </div>
                    <div class="p-6">
                        <div class="bg-brand-gold text-brand-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto text-2xl font-bold">3</div>
                        <h3 class="text-2xl font-bold text-brand-green my-4">Donate to the Cause</h3>
                        <p class="text-gray-600">Your financial support helps us fund critical training programs and initiatives across the nation.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-20 bg-brand-green">
            <div class="container mx-auto px-6 text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold">Make a Difference Today</h2>
                <p class="text-lg md:text-xl max-w-3xl mx-auto my-6 text-gray-200">Your contribution, whether through membership or a donation, directly supports our mission to empower Nigeria's workforce. Join us in building a better future.</p>
                <div class="space-x-4">
                    <a href="members.php" class="btn-primary">Join PEEF</a>
                    <a href="donate.php" class="btn-secondary">Donate</a>
                </div>
            </div>
        </section>

        <!-- Our Sponsors -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Our Valued Sponsors</h2>
                <div class="flex justify-center items-center gap-8 md:gap-16 flex-wrap">
                    <img src="https://logo.clearbit.com/mtn.com" onerror="this.onerror=null;this.src='https://placehold.co/150x60/cccccc/333333?text=Sponsor';" alt="Sponsor Logo" class="h-16 object-contain transition-transform duration-300 transform hover:scale-110" style="filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='none'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
                    <img src="https://logo.clearbit.com/dangote.com" onerror="this.onerror=null;this.src='https://placehold.co/150x60/cccccc/333333?text=Sponsor';" alt="Sponsor Logo" class="h-16 object-contain transition-transform duration-300 transform hover:scale-110" style="filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='none'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
                    <img src="https://logo.clearbit.com/accessbankplc.com" onerror="this.onerror=null;this.src='https://placehold.co/150x60/cccccc/333333?text=Sponsor';" alt="Sponsor Logo" class="h-16 object-contain transition-transform duration-300 transform hover:scale-110" style="filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='none'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
                    <img src="https://logo.clearbit.com/zenithbank.com" onerror="this.onerror=null;this.src='https://placehold.co/150x60/cccccc/333333?text=Sponsor';" alt="Sponsor Logo" class="h-16 object-contain transition-transform duration-300 transform hover:scale-110" style="filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='none'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
                    <img src="https://logo.clearbit.com/globacom.com" onerror="this.onerror=null;this.src='https://placehold.co/150x60/cccccc/333333?text=Sponsor';" alt="Sponsor Logo" class="h-16 object-contain transition-transform duration-300 transform hover:scale-110" style="filter: grayscale(100%); opacity: 0.7;" onmouseover="this.style.filter='none'; this.style.opacity='1';" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7';">
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
    
    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/2348066068596" target="_blank" class="whatsapp-float" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            // Mobile menu toggle
            $('#mobile-menu-button').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
            });

            // Hero Slider
            $('.hero-slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                autoplay: true,
                autoplaySpeed: 5000,
                arrows: false
            });
            
            // AJAX to fetch homepage data
            $.ajax({
                url: 'php/api/homepage.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Populate Impact Stats
                        $('#impact-members').text((response.data.stats.total_members || '1,200') + '+');
                        $('#impact-events').text((response.data.stats.total_events || '50') + '+');

                        // Populate Upcoming Events
                        const eventsGrid = $('#upcoming-events-grid');
                        eventsGrid.empty();
                        response.data.upcoming_events.forEach(event => {
                            const eventHtml = `
                                <div class="event-card" style="background-image: url('https://placehold.co/600x400/044f04/ffffff?text=Event');" data-event-date="${event.start_datetime}">
                                    <div class="event-card-content flex flex-col justify-end h-full min-h-[400px]">
                                        <div>
                                            <h3 class="text-2xl font-bold mb-2">${event.title}</h3>
                                            <p class="mb-4"><i class="fas fa-map-marker-alt mr-2 text-brand-gold"></i>${event.location}</p>
                                            <div class="countdown-timer"></div>
                                        </div>
                                    </div>
                                </div>`;
                            eventsGrid.append(eventHtml);
                        });

                        // Populate Latest Blog Posts
                        const postsGrid = $('#latest-posts-grid');
                        postsGrid.empty();
                        response.data.latest_posts.forEach(post => {
                            const postHtml = `
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transform hover:-translate-y-2 transition-transform duration-300">
                                    <a href="blog_post.php?id=${post.id}"><img src="${post.featured_image || 'https://placehold.co/400x250/dddddd/333333?text=Blog+Image'}" class="w-full h-48 object-cover" alt="${post.title}"></a>
                                    <div class="p-6 flex-grow">
                                        <p class="text-sm text-gray-500 mb-2">${new Date(post.published_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })} | By ${post.author}</p>
                                        <h3 class="text-xl font-bold text-brand-green mb-3">${post.title}</h3>
                                        <p class="text-gray-700">${post.snippet}...</p>
                                    </div>
                                     <a href="blog_post.php?id=${post.id}" class="mt-auto text-brand-green p-4 text-left font-bold hover:text-brand-gold transition-colors duration-300">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                                </div>`;
                            postsGrid.append(postHtml);
                        });
                        
                        // Initialize countdown timers
                        initializeCountdownTimers();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Failed to fetch homepage data:", error);
                    $('#upcoming-events-grid').html('<p class="text-center col-span-3">Could not load upcoming events.</p>');
                    $('#latest-posts-grid').html('<p class="text-center col-span-3">Could not load latest posts.</p>');
                }
            });

            function initializeCountdownTimers() {
                $('.event-card').each(function() {
                    const eventDate = $(this).data('event-date');
                    const countdownContainer = $(this).find('.countdown-timer');
                    const targetDate = new Date(eventDate).getTime();

                    const interval = setInterval(() => {
                        const now = new Date().getTime();
                        const distance = targetDate - now;

                        if (distance < 0) {
                            clearInterval(interval);
                            countdownContainer.html('<div class="bg-red-500/50 p-2 rounded-lg">Event has started</div>');
                            return;
                        }

                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        countdownContainer.html(`
                            <div><div class="time">${days}</div><div class="label">Days</div></div>
                            <div><div class="time">${hours}</div><div class="label">Hours</div></div>
                            <div><div class="time">${minutes}</div><div class="label">Mins</div></div>
                            <div><div class="time">${seconds}</div><div class="label">Secs</div></div>
                        `);
                    }, 1000);
                });
            }
            
            // YouTube Playlist
            $('.playlist-item').on('click', function() {
                const videoId = $(this).data('video-id');
                const newSrc = `https://www.youtube.com/embed/${videoId}`;
                $('#youtube-player').attr('src', newSrc);

                $('.playlist-item').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
</body>
</html>
