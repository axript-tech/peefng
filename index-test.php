<?php
    $pageLink = 'index.php';
    $pageTitle = 'PEEF';
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <?php require_once 'php/includes/headscripts.php'; ?>

    <!-- Custom Styles -->
    <style>
       
    </style>
</head>
<body class="bg-brand-light-bg">

    <!-- Navigation Bar -->
    <?php require_once 'page-sections/header.php'; ?>
    

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
                        <p class="text-5xl font-bold text-brand-green mb-2">1,200+</p>
                        <p class="text-lg text-gray-600">Members & Experts</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <i class="fas fa-calendar-check text-5xl text-brand-gold mb-4"></i>
                        <p class="text-5xl font-bold text-brand-green mb-2">50+</p>
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
        <section class="py-20 bg-brand-light-bg">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Our National Footprint</h2>
                <div class="grid md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-2">
                        <div id="map-container" class="w-full aspect-square"></div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-brand-green mb-4">A Nationwide Network</h3>
                        <p class="text-gray-700">Our members are spread across all 36 states of Nigeria, forming a diverse and powerful network of professionals dedicated to national development. Hover over the map to see our presence in each state.</p>
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
    </main>

    <!-- Footer -->
    <?php require_once 'page-sections/footer.php'; ?>
    <?php require_once 'php/includes/footscripts.php'; ?>

    
    
    <script>
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
                        // Populate Upcoming Events
                        const eventsGrid = $('#upcoming-events-grid');
                        eventsGrid.empty();
                        response.data.upcoming_events.forEach(event => {
                            const eventHtml = `
                                <div class="event-card" style="background-image: url(${event.poster_image});" data-event-date="${event.start_datetime}">
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
                }
            });

            

           
            
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
