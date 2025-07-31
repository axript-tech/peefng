<?php
// Start the session to be able to access session variables.
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - PEEF</title>

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
        
        .donation-amount-btn {
            transition: all 0.3s ease;
        }
        .donation-amount-btn.selected {
            background-color: var(--brand-green);
            color: white;
            border-color: var(--brand-green);
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
             <a href="knowledge_hub.php" class="block text-gray-600 hover:text-brand-green">Knowledge Hub</a>
             <a href="gallery.php" class="block text-gray-600 hover:text-brand-green">Gallery</a>
             <a href="contact.php" class="block text-gray-600 hover:text-brand-green">Contact</a>
             <hr/>
             <a href="login.php" class="block text-gray-600 hover:text-brand-green">Login</a>
             <a href="members.php" class="block mt-2 btn-primary text-center">Sign Up</a>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header" style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1593113646773-028c64a8f1b8?q=80&w=2670&auto=format&fit=crop');">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">Support Our Mission</h1>
            <p class="text-lg mt-2">Your generosity fuels our work and empowers Nigeria's future.</p>
        </div>
    </section>

    <main>
        <!-- Donation Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Donation Form -->
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <h2 class="text-3xl font-bold text-brand-dark mb-6">Make a Donation</h2>
                        
                        <div id="form-message" class="hidden mb-6" role="alert"></div>

                        <form id="donation-form" method="POST">
                            <div class="mb-6">
                                <label class="block font-bold mb-2">Choose an Amount (NGN)</label>
                                <div class="grid grid-cols-3 gap-4">
                                    <button type="button" class="donation-amount-btn border-2 border-gray-300 p-4 rounded-lg font-bold text-lg" data-amount="5000">₦5,000</button>
                                    <button type="button" class="donation-amount-btn border-2 border-gray-300 p-4 rounded-lg font-bold text-lg" data-amount="10000">₦10,000</button>
                                    <button type="button" class="donation-amount-btn border-2 border-gray-300 p-4 rounded-lg font-bold text-lg" data-amount="25000">₦25,000</button>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="custom-amount" class="block font-bold mb-2">Or Enter a Custom Amount</label>
                                <input type="number" id="custom-amount" name="amount" placeholder="e.g., 50000" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold">
                            </div>
                            <div class="mb-6">
                                <label class="block font-bold mb-2">Personal Information (Optional)</label>
                                <div class="space-y-4">
                                    <input type="text" name="full_name" placeholder="Full Name (for Guest donors)" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold">
                                    <input type="email" name="email" placeholder="Email Address (for Guest donors)" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold">
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Leave blank to donate anonymously. If you are a member, your details will be automatically linked if you use your registered email.</p>
                            </div>
                            <button type="submit" id="submit-btn" class="btn-primary w-full text-lg">
                                <span class="btn-text">Donate Now</span>
                                <i class="fas fa-spinner spinner ml-2 hidden"></i>
                            </button>
                        </form>
                    </div>
                    <!-- Why Donate Info -->
                    <div>
                        <h2 class="text-3xl font-bold text-brand-green mb-4">Your Donation Matters</h2>
                        <p class="text-gray-700 mb-6">Every naira you contribute goes directly towards our core initiatives. Your support helps us to:</p>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-brand-green text-xl mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-bold">Fund Training Programs</h4>
                                    <p class="text-gray-600">Provide essential skills training to unemployed youth and professionals looking to upskill.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-brand-green text-xl mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-bold">Develop Resources</h4>
                                    <p class="text-gray-600">Create and distribute valuable reports, toolkits, and learning materials.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-brand-green text-xl mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-bold">Host Empowerment Events</h4>
                                    <p class="text-gray-600">Organize workshops, seminars, and conferences that connect and inspire.</p>
                                </div>
                            </li>
                        </ul>
                        <div class="mt-8 p-6 bg-brand-green text-white rounded-xl">
                            <p class="font-bold">PEEF is a registered not-for-profit organization. All donations are securely processed and contribute to our nation-building mission.</p>
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

            // Donation amount selection
            $('.donation-amount-btn').on('click', function() {
                $('.donation-amount-btn').removeClass('selected');
                $(this).addClass('selected');
                $('#custom-amount').val($(this).data('amount'));
            });

            $('#custom-amount').on('input', function() {
                $('.donation-amount-btn').removeClass('selected');
                const customValue = $(this).val();
                $('.donation-amount-btn').each(function() {
                    if ($(this).data('amount') == customValue) {
                        $(this).addClass('selected');
                    }
                });
            });

            // Donation Form AJAX Submission
            $('#donation-form').on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $button = $('#submit-btn');
                const $btnText = $button.find('.btn-text');
                const $spinner = $button.find('.spinner');
                const $formMessage = $('#form-message');

                $btnText.text('Processing...');
                $spinner.removeClass('hidden');
                $button.prop('disabled', true);
                $formMessage.addClass('hidden').removeClass('bg-green-100 border-green-400 text-green-700 bg-red-100 border-red-400 text-red-700');

                $.ajax({
                    type: 'POST',
                    url: 'php/process/process_donation.php',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $formMessage.html('<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"><strong class="font-bold">Success!</strong> ' + response.message + '</div>');
                            $form[0].reset();
                            $('.donation-amount-btn').removeClass('selected');
                        } else {
                            $formMessage.html('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"><strong class="font-bold">Error:</strong> ' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $formMessage.html('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"><strong class="font-bold">Error:</strong> An unexpected error occurred. Please try again.</div>');
                    },
                    complete: function() {
                        // Reset button state
                        $btnText.text('Donate Now');
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
