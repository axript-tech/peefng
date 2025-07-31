 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Hub - PEEF</title>

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
        
        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .resource-item {
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .resource-item:hover {
            background-color: white;
            border-color: var(--brand-gold);
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
                <a href="knowledge_hub.php" class="nav-link active text-gray-600">Knowledge Hub</a>
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
             <a href="events.php" class="block text-gray-600 hover:text-brand-green">Events</a>
             <a href="knowledge_hub.php" class="block text-brand-green font-bold">Knowledge Hub</a>
             <a href="gallery.php" class="block text-gray-600 hover:text-brand-green">Gallery</a>
             <a href="contact.php" class="block text-gray-600 hover:text-brand-green">Contact</a>
             <hr/>
             <a href="login.php" class="block text-gray-600 hover:text-brand-green">Login</a>
             <a href="members.php" class="block mt-2 btn-primary text-center">Sign Up</a>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header" style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1457369804613-52c61a468e7d?q=80&w=2670&auto=format&fit=crop');">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">Knowledge Hub</h1>
            <p class="text-lg mt-2">Insights, reports, and tools to drive skills development in Nigeria.</p>
        </div>
    </section>

    <main>
        <!-- Featured Content Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden lg:flex">
                    <div class="lg:w-1/2">
                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/600x400/dddddd/333333?text=Featured';" alt="Featured article" class="h-64 lg:h-full w-full object-cover">
                    </div>
                    <div class="lg:w-1/2 p-8 md:p-12">
                        <p class="text-sm font-semibold text-brand-gold">FEATURED POST</p>
                        <h2 class="text-3xl font-bold text-brand-dark my-3">The Future of Work in Nigeria: Preparing for 2030</h2>
                        <p class="text-gray-600 mb-6">A deep dive into the evolving job market and the critical skills needed for the next decade. This report outlines key strategies for individuals, corporations, and policymakers.</p>
                        <a href="blog_post.php" class="btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog & Resources Section -->
        <section class="py-20 bg-brand-light-bg">
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- Main Content: Blog -->
                    <div class="lg:col-span-2">
                        <h2 class="text-3xl font-bold text-brand-dark mb-8">Latest Articles</h2>
                        <div class="space-y-8">
                            <!-- Blog Post 1 -->
                            <div class="blog-card bg-white rounded-lg shadow-md overflow-hidden md:flex">
                                <div class="md:w-1/3">
                                    <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?q=80&w=2670&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x250/dddddd/333333?text=Blog+Image';" alt="Blog post image" class="h-full w-full object-cover">
                                </div>
                                <div class="md:w-2/3 p-6">
                                    <p class="text-sm text-gray-500">July 20, 2025 | By Dr. Amina Bello</p>
                                    <h3 class="text-xl font-bold my-2">5 Key Strategies for Upskilling Your Workforce</h3>
                                    <p class="text-gray-600 mb-4">In a rapidly changing world, continuous learning is not just an option; it's a necessity...</p>
                                    <a href="blog_post.php" class="font-semibold text-brand-green hover:text-brand-gold">Read More &rarr;</a>
                                </div>
                            </div>
                            <!-- Blog Post 2 -->
                            <div class="blog-card bg-white rounded-lg shadow-md overflow-hidden md:flex">
                                <div class="md:w-1/3">
                                    <img src="https://images.unsplash.com/photo-1551843122-4a34b95af9c7?q=80&w=2574&auto=format&fit=crop" onerror="this.onerror=null;this.src='https://placehold.co/400x250/dddddd/333333?text=Blog+Image';" alt="Blog post image" class="h-full w-full object-cover">
                                </div>
                                <div class="md:w-2/3 p-6">
                                    <p class="text-sm text-gray-500">July 15, 2025 | By Engr. Tunde Cole</p>
                                    <h3 class="text-xl font-bold my-2">The Impact of Digital Literacy on National Productivity</h3>
                                    <p class="text-gray-600 mb-4">Exploring the correlation between a digitally literate population and economic growth...</p>
                                    <a href="blog_post.php" class="font-semibold text-brand-green hover:text-brand-gold">Read More &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar: Resources -->
                    <aside>
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-2xl font-bold text-brand-dark mb-6">Resource Library</h3>
                            <ul class="space-y-4">
                                <li>
                                    <a href="#" class="resource-item p-4 border rounded-lg flex items-center space-x-4">
                                        <i class="fas fa-file-pdf text-2xl text-red-500"></i>
                                        <div>
                                            <h4 class="font-semibold">Annual Skills Gap Report 2025</h4>
                                            <p class="text-sm text-gray-500">PDF Document</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="resource-item p-4 border rounded-lg flex items-center space-x-4">
                                        <i class="fas fa-file-alt text-2xl text-blue-500"></i>
                                        <div>
                                            <h4 class="font-semibold">Mentorship Program Guide</h4>
                                            <p class="text-sm text-gray-500">DOCX File</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="resource-item p-4 border rounded-lg flex items-center space-x-4">
                                        <i class="fas fa-file-powerpoint text-2xl text-orange-500"></i>
                                        <div>
                                            <h4 class="font-semibold">Webinar Presentation Slides</h4>
                                            <p class="text-sm text-gray-500">PPTX File</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>
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
