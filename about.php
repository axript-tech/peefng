 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About PEEF - People Expertise and Excellence Foundation</title>

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
        
        .value-card {
            background: white;
            border-left: 5px solid var(--brand-gold);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .trustee-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .trustee-card:hover {
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
                <a href="about.php" class="nav-link active text-gray-600">About Us</a>
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
             <a href="index.php" class="block text-gray-600 hover:text-brand-green">Home</a>
             <a href="about.php" class="block text-brand-green font-bold">About Us</a>
             <a href="events.php" class="block text-gray-600 hover:text-brand-green">Events</a>
             <a href="knowledge_hub.php" class="block text-gray-600 hover:text-brand-green">Knowledge Hub</a>
             <a href="gallery.php" class="block text-gray-600 hover:text-brand-green">Gallery</a>
             <a href="contact.php" class="block text-gray-600 hover:text-brand-green">Contact</a>
             <hr/>
             <a href="login.php" class="block text-gray-600 hover:text-brand-green">Login</a>
             <a href="members.php" class="block mt-2 btn-primary text-center">Sign Up</a>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header" style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1543269664-56d93c1b41a6?q=80&w=2670&auto=format&fit=crop');">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">About PEEF</h1>
            <p class="text-lg mt-2">Learn about our mission, vision, and the team driving change.</p>
        </div>
    </section>

    <main>
        <!-- Our Story Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-brand-green mb-4">Our Story</h2>
                        <p class="text-gray-700 mb-4">The People Expertise and Excellence Foundation (PEEF) was founded with a singular, powerful vision: to be the most respected leader in championing skills development in Nigeria. We are a not-for-profit organization committed to increasing skill proficiency and fostering productive work within the Nigerian workforce.</p>
                        <p class="text-gray-700">From grassroots workshops to national conferences, our journey is one of passion, dedication, and an unwavering belief in the potential of every Nigerian to excel.</p>
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/333333?text=Our+Journey';" alt="Team working together" class="rounded-xl shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-brand-green text-white p-8 rounded-xl">
                        <h3 class="text-3xl font-bold mb-4 text-brand-gold">Our Vision</h3>
                        <p>To be the leader and most respected organisation championing skills development in Nigeria.</p>
                    </div>
                    <div class="bg-brand-green text-white p-8 rounded-xl">
                        <h3 class="text-3xl font-bold mb-4 text-brand-gold">Our Mission</h3>
                        <p>To increase skill proficiency and productive work within the Nigerian workforce.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Core Values Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Our Core Values (PISPE)</h2>
                <div class="grid md:grid-cols-5 gap-8 text-center">
                    <div class="value-card p-6 rounded-lg shadow">
                        <h4 class="text-xl font-bold text-brand-green">Professionalism</h4>
                    </div>
                    <div class="value-card p-6 rounded-lg shadow">
                        <h4 class="text-xl font-bold text-brand-green">Integrity</h4>
                    </div>
                    <div class="value-card p-6 rounded-lg shadow">
                        <h4 class="text-xl font-bold text-brand-green">Sincerity</h4>
                    </div>
                    <div class="value-card p-6 rounded-lg shadow">
                        <h4 class="text-xl font-bold text-brand-green">Productivity</h4>
                    </div>
                    <div class="value-card p-6 rounded-lg shadow">
                        <h4 class="text-xl font-bold text-brand-green">Excellence</h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- Aims & Objectives Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Aims & Objectives</h2>
                <div class="max-w-4xl mx-auto">
                    <ul class="space-y-4">
                        <li class="bg-white p-6 rounded-lg shadow flex items-start space-x-4">
                            <i class="fas fa-bullseye text-brand-gold text-2xl mt-1"></i>
                            <p class="text-gray-700">Collate and disseminate relevant up-to-date information on skills management trends and challenges.</p>
                        </li>
                        <li class="bg-white p-6 rounded-lg shadow flex items-start space-x-4">
                            <i class="fas fa-cogs text-brand-gold text-2xl mt-1"></i>
                            <p class="text-gray-700">Develop and design high-impact techniques for enhanced productive works.</p>
                        </li>
                        <li class="bg-white p-6 rounded-lg shadow flex items-start space-x-4">
                            <i class="fas fa-chart-line text-brand-gold text-2xl mt-1"></i>
                            <p class="text-gray-700">Increase and improve the level of skills management awareness in the Nigerian workforce.</p>
                        </li>
                        <li class="bg-white p-6 rounded-lg shadow flex items-start space-x-4">
                            <i class="fas fa-globe-africa text-brand-gold text-2xl mt-1"></i>
                            <p class="text-gray-700">Promote Nigeria as a source for a valued skills resource pool.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        
        <!-- Board of Trustees Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Meet Our Board of Trustees</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Trustee 1 -->
                    <div class="trustee-card text-center bg-white p-6 rounded-xl shadow-lg">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=2487&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/200x200/cccccc/333333?text=Trustee';" alt="Board Member" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h4 class="text-xl font-bold text-brand-green">Dr. John Adeoye</h4>
                        <p class="text-brand-gold font-semibold">Chairman</p>
                    </div>
                    <!-- Trustee 2 -->
                    <div class="trustee-card text-center bg-white p-6 rounded-xl shadow-lg">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=2488&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/200x200/cccccc/333333?text=Trustee';" alt="Board Member" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h4 class="text-xl font-bold text-brand-green">Aisha Bello</h4>
                        <p class="text-brand-gold font-semibold">Vice-Chairperson</p>
                    </div>
                    <!-- Trustee 3 -->
                    <div class="trustee-card text-center bg-white p-6 rounded-xl shadow-lg">
                        <img src="https://images.unsplash.com/photo-1557862921-37829c790f19?q=80&w=2671&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/200x200/cccccc/333333?text=Trustee';" alt="Board Member" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h4 class="text-xl font-bold text-brand-green">Chinedu Okoro</h4>
                        <p class="text-brand-gold font-semibold">Secretary</p>
                    </div>
                    <!-- Trustee 4 -->
                    <div class="trustee-card text-center bg-white p-6 rounded-xl shadow-lg">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/200x200/cccccc/333333?text=Trustee';" alt="Board Member" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h4 class="text-xl font-bold text-brand-green">Ngozi Eze</h4>
                        <p class="text-brand-gold font-semibold">Treasurer</p>
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
