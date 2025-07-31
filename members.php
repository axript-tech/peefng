<?php
// Start the session to be able to access session variables.
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Member - PEEF</title>

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
        .btn-secondary {
            display: inline-block;
            font-weight: 700;
            color: var(--brand-dark);
            background-color: transparent;
            border: 2px solid var(--brand-dark);
            padding: 0.75rem 2rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: var(--brand-dark);
            color: white;
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

        /* Multi-step Form */
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
        .progress-bar-fill {
            transition: width 0.4s ease-in-out;
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
    <section class="page-header" style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2670&auto=format&fit=crop');">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">Join Our Network</h1>
            <p class="text-lg mt-2">Become a part of a thriving community of experts and professionals.</p>
        </div>
    </section>

    <main>
        <!-- PEEF Information Section -->
        <section class="py-20">
            <div class="container mx-auto px-6 max-w-4xl">
                <h3 class="text-3xl font-bold text-brand-dark mb-6 text-center">PEEF Membership Principles</h3>
                <div class="space-y-4" id="principles-accordion">
                    <!-- Accordion Item 1: Vision & Mission -->
                    <div class="border rounded-lg overflow-hidden bg-white shadow-sm">
                        <div class="accordion-header cursor-pointer p-6 flex justify-between items-center">
                            <h4 class="text-xl font-bold text-brand-green">Our Vision & Mission</h4>
                            <i class="fas fa-chevron-down transition-transform"></i>
                        </div>
                        <div class="accordion-content hidden p-6 border-t bg-gray-50">
                            <p><b>Vision:</b> To be the leader and most respected organisation championing skills development in Nigeria.</p>
                            <p><b>Mission:</b> To increase skill proficiency and productive work within the Nigerian workforce.</p>
                        </div>
                    </div>
                    <!-- Accordion Item 2: Aims & Objectives -->
                    <div class="border rounded-lg overflow-hidden bg-white shadow-sm">
                        <div class="accordion-header cursor-pointer p-6 flex justify-between items-center">
                            <h4 class="text-xl font-bold text-brand-green">Aims & Objectives</h4>
                            <i class="fas fa-chevron-down transition-transform"></i>
                        </div>
                        <div class="accordion-content hidden p-6 border-t bg-gray-50">
                             <ul class="list-disc list-inside space-y-1">
                                <li>Collate and disseminate relevant up to date information on skills management trends and challenges.</li>
                                <li>Develop and design high impact techniques for enhanced productive works in Nigeria.</li>
                                <li>Increase/Improve the level of skills management awareness in the Nigerian workforce.</li>
                                <li>Promote Nigeria as a source for a valued skills resource pool.</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Accordion Item 3: Ground Rules -->
                    <div class="border rounded-lg overflow-hidden bg-white shadow-sm">
                        <div class="accordion-header cursor-pointer p-6 flex justify-between items-center">
                            <h4 class="text-xl font-bold text-brand-green">Ground Rules</h4>
                            <i class="fas fa-chevron-down transition-transform"></i>
                        </div>
                        <div class="accordion-content hidden p-6 border-t bg-gray-50">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Members shall only share information relevant to the aims and objectives of PEEF.</li>
                                <li>No material with political, religious, or tribal connotations shall be posted.</li>
                                <li>All affairs will be conducted in line with the extant laws of Nigeria.</li>
                                <li class="text-red-600 font-semibold">Violation of rules will attract sanctions (e.g., suspension, expulsion).</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Signup Form Section -->
        <section id="signup-form" class="pb-20">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-3xl font-bold text-brand-dark mb-2 text-center">Registration Form</h2>
                    <p class="text-center text-gray-600 mb-8">Complete the following steps to apply for membership.</p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex justify-between mb-2">
                            <span id="step-name" class="text-lg font-bold text-brand-green">Step 1: Personal & Contact</span>
                            <span id="step-counter" class="text-lg font-bold text-gray-600">1 / 3</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div id="progress-bar" class="bg-brand-gold h-2.5 rounded-full progress-bar-fill" style="width: 33.33%"></div>
                        </div>
                    </div>

                    <div id="form-message" class="hidden mb-6" role="alert"></div>

                    <form id="multi-step-form" method="POST" enctype="multipart/form-data" class="space-y-8">
                        <!-- Step 1: Personal & Contact Details -->
                        <div class="form-step active">
                             <fieldset>
                                <legend class="text-2xl font-bold text-brand-dark mb-4 border-b pb-2">Personal & Contact Information</legend>
                                <div class="grid md:grid-cols-4 gap-6">
                                    <div>
                                        <label class="block font-bold text-gray-700">Title <span class="text-red-500">*</span></label>
                                        <select name="title" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1">
                                            <option value="" disabled selected>Select Title...</option>
                                            <option>Mr.</option> <option>Mrs.</option> <option>Ms.</option> <option>Alhaji</option> <option>Rev.</option> <option>Chief</option> <option>Engr.</option> <option>Dr.</option> <option>Prof.</option> <option>Barr.</option> <option>Arch.</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-3 grid md:grid-cols-3 gap-6">
                                        <div>
                                            <label class="block font-bold text-gray-700">First Name <span class="text-red-500">*</span></label>
                                            <input type="text" name="first_name" placeholder="e.g., John" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                        </div>
                                        <div>
                                            <label class="block font-bold text-gray-700">Middle Name</label>
                                            <input type="text" name="middle_name" placeholder="e.g., Ade" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1">
                                        </div>
                                        <div>
                                            <label class="block font-bold text-gray-700">Surname <span class="text-red-500">*</span></label>
                                            <input type="text" name="surname" placeholder="e.g., Doe" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
                                        <input type="date" name="dob" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Nationality <span class="text-red-500">*</span></label>
                                        <select name="nationality" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                            <option>Nigeria</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Personal Email <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" placeholder="you@example.com" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Mobile Number <span class="text-red-500">*</span></label>
                                        <input type="tel" name="phone" placeholder="e.g., 08012345678" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Step 2: Professional Details -->
                        <div class="form-step">
                            <fieldset>
                                <legend class="text-2xl font-bold text-brand-dark mb-4 border-b pb-2">Professional Details</legend>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block font-bold text-gray-700">Job Title <span class="text-red-500">*</span></label>
                                        <input type="text" name="job_title" placeholder="e.g., Managing Director" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-700">Organisation <span class="text-red-500">*</span></label>
                                        <input type="text" name="organisation" placeholder="e.g., PEEF Inc." class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Business or Office Address <span class="text-red-500">*</span></label>
                                        <input type="text" name="address" placeholder="Street, City, State" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-700">Years of Experience (SME) <span class="text-red-500">*</span></label>
                                        <input type="number" name="experience" placeholder="e.g., 10" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-700">Sectors of the Economy <span class="text-red-500">*</span></label>
                                        <select name="sector" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                            <option value="" disabled selected>Select Sector...</option>
                                            <option>Agriculture</option><option>Manufacturing</option><option>Oil and Gas</option><option>ICT</option><option>Finance</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Primary Discipline <span class="text-red-500">*</span></label>
                                        <select name="discipline_primary" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                            <option value="" disabled selected>Select Discipline...</option>
                                            <option>Engineering</option><option>Human Resources</option><option>Finance</option><option>Legal</option><option>Health</option>
                                        </select>
                                    </div>
                                     <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Professional Membership</label>
                                        <select name="prof_membership" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1">
                                            <option value="" disabled selected>Select Membership...</option>
                                            <option>Nigerian Society of Engineers (NSE)</option><option>Nigerian Bar Association (NBA)</option><option>Institute of Chartered Accountants of Nigeria (ICAN)</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        
                        <!-- Step 3: Documents & Submission -->
                        <div class="form-step">
                            <fieldset>
                                <legend class="text-2xl font-bold text-brand-dark mb-4 border-b pb-2">Documents & Final Steps</legend>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block font-bold text-gray-700">CV/Resume <span class="text-red-500">*</span></label>
                                        <input type="file" name="cv" class="w-full p-2 border rounded-lg mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-gold file:text-brand-dark hover:file:bg-yellow-400" required>
                                    </div>
                                    <div>
                                        <label class="block font-bold text-gray-700">Passport Photograph <span class="text-red-500">*</span></label>
                                        <input type="file" name="passport" class="w-full p-2 border rounded-lg mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-gold file:text-brand-dark hover:file:bg-yellow-400" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Evidence of Payment</label>
                                        <input type="file" name="payment_evidence" class="w-full p-2 border rounded-lg mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-gold file:text-brand-dark hover:file:bg-yellow-400">
                                        <p class="text-sm text-gray-500 mt-1">Bank: UBA | Account: 1021423115 | Name: People Expertise and Excellence Foundation</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Password <span class="text-red-500">*</span></label>
                                        <input type="password" name="password" placeholder="Choose a secure password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                     <div class="md:col-span-2">
                                        <label class="block font-bold text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                                        <input type="password" name="confirm_password" placeholder="Confirm your password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold mt-1" required>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                            <input id="agreement-final" name="agreement" type="checkbox" class="h-5 w-5 text-brand-green focus:ring-brand-gold border-gray-300 rounded mt-1" required>
                                            <label for="agreement-final" class="ml-3 text-gray-700">I confirm that I have read and agree to the PEEF principles. <span class="text-red-500">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between mt-8">
                            <button type="button" id="prev-btn" class="btn-secondary" style="display: none;">Previous</button>
                            <button type="button" id="next-btn" class="btn-primary ml-auto">Next</button>
                            <button type="submit" id="submit-btn" class="btn-primary ml-auto" style="display: none;">
                                <span class="btn-text">Submit Application</span>
                                <i class="fas fa-spinner spinner ml-2 hidden"></i>
                            </button>
                        </div>
                    </form>
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

            // Accordion for PEEF Principles
            $('.accordion-header').on('click', function() {
                const content = $(this).next('.accordion-content');
                const icon = $(this).find('i');

                content.slideToggle();
                icon.toggleClass('rotate-180');
            });

            // Multi-step form logic
            let currentStep = 0;
            const steps = $('.form-step');
            const stepNames = [
                "Step 1: Personal & Contact",
                "Step 2: Professional Details",
                "Step 3: Documents & Submission"
            ];

            function showStep(stepIndex) {
                steps.removeClass('active');
                $(steps[stepIndex]).addClass('active');
                
                const progress = ((stepIndex + 1) / steps.length) * 100;
                $('#progress-bar').css('width', progress + '%');
                $('#step-name').text(stepNames[stepIndex]);
                $('#step-counter').text(`${stepIndex + 1} / ${steps.length}`);

                $('#prev-btn').toggle(stepIndex > 0);
                $('#next-btn').toggle(stepIndex < steps.length - 1);
                $('#submit-btn').toggle(stepIndex === steps.length - 1);
            }

            $('#next-btn').on('click', function() {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            $('#prev-btn').on('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);

            // AJAX Form Submission
            $('#multi-step-form').on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $button = $('#submit-btn');
                const $btnText = $button.find('.btn-text');
                const $spinner = $button.find('.spinner');
                const $formMessage = $('#form-message');

                $btnText.text('Submitting...');
                $spinner.removeClass('hidden');
                $button.prop('disabled', true);
                $formMessage.addClass('hidden');

                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'php/process/process_registration.php',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            $formMessage.html('<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"><strong class="font-bold">Success!</strong> ' + response.message + '</div>');
                            $form[0].reset();
                            currentStep = 0; // Reset to first step
                            showStep(currentStep);
                        } else {
                            $formMessage.html('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"><strong class="font-bold">Error:</strong> ' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $formMessage.html('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"><strong class="font-bold">Error:</strong> An unexpected error occurred.</div>');
                    },
                    complete: function() {
                        $btnText.text('Submit Application');
                        $spinner.addClass('hidden');
                        $button.prop('disabled', false);
                        $formMessage.removeClass('hidden');
                        window.scrollTo({ top: $formMessage.offset().top - 100, behavior: 'smooth' });
                    }
                });
            });
        });
    </script>
</body>
</html>
