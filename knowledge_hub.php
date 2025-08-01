<?php
require_once __DIR__ . '/php/includes/session.php';
// The rest of your PHP logic can go here if needed.
?>
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
        
        .resource-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .resource-card:hover {
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
            <p class="text-lg mt-2">Insights, reports, and resources from industry experts.</p>
        </div>
    </section>

    <main>
        <!-- Blog Posts Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Latest Articles & Insights</h2>
                <div id="blog-posts-container" class="grid md:grid-cols-3 gap-8">
                    <!-- Blog posts will be loaded here by jQuery -->
                    <p class="text-center text-gray-500 col-span-3">Loading posts...</p>
                </div>
            </div>
        </section>

        <!-- Resources Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="section-title">Downloadable Resources</h2>
                <div id="resources-container" class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- Resources will be loaded here by jQuery -->
                    <p class="text-center text-gray-500 col-span-2">Loading resources...</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-brand-green text-white pt-16 pb-8">
        <!-- Footer content remains the same -->
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // Mobile menu toggle
            $('#mobile-menu-button').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
            });

            // AJAX to fetch knowledge hub data
            $.ajax({
                url: 'php/api/public/knowledge_hub.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Populate Blog Posts
                        const postsContainer = $('#blog-posts-container');
                        postsContainer.empty();
                        if (response.data.posts.length > 0) {
                            response.data.posts.forEach(post => {
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
                                postsContainer.append(postHtml);
                            });
                        } else {
                            postsContainer.html('<p class="text-center text-gray-500 col-span-3">No blog posts found.</p>');
                        }

                        // Populate Resources
                        const resourcesContainer = $('#resources-container');
                        resourcesContainer.empty();
                        if (response.data.resources.length > 0) {
                            response.data.resources.forEach(resource => {
                                const fileTypeDetails = getFileTypeDetails(resource.file_type);
                                const resourceHtml = `
                                    <div class="resource-card bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                                        <div class="flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center ${fileTypeDetails.bgColor}">
                                            <i class="fas ${fileTypeDetails.icon} text-3xl ${fileTypeDetails.textColor}"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h4 class="font-bold text-lg">${resource.title}</h4>
                                            <p class="text-sm text-gray-600">${resource.description}</p>
                                        </div>
                                        <a href="${resource.file_path}" download class="btn-primary !py-2 !px-4 !text-sm !rounded-md">
                                            <i class="fas fa-download mr-2"></i>Download
                                        </a>
                                    </div>`;
                                resourcesContainer.append(resourceHtml);
                            });
                        } else {
                            resourcesContainer.html('<p class="text-center text-gray-500 col-span-2">No resources found.</p>');
                        }
                    }
                },
                error: function() {
                    $('#blog-posts-container').html('<p class="text-center text-red-500 col-span-3">Could not load posts.</p>');
                    $('#resources-container').html('<p class="text-center text-red-500 col-span-2">Could not load resources.</p>');
                }
            });

            function getFileTypeDetails(fileType) {
                if (fileType.includes('pdf')) {
                    return { icon: 'fa-file-pdf', bgColor: 'bg-red-100', textColor: 'text-red-600' };
                } else if (fileType.includes('word')) {
                    return { icon: 'fa-file-word', bgColor: 'bg-blue-100', textColor: 'text-blue-600' };
                } else if (fileType.includes('excel') || fileType.includes('spreadsheet')) {
                    return { icon: 'fa-file-excel', bgColor: 'bg-green-100', textColor: 'text-green-600' };
                } else if (fileType.includes('powerpoint')) {
                    return { icon: 'fa-file-powerpoint', bgColor: 'bg-yellow-100', textColor: 'text-yellow-600' };
                }
                return { icon: 'fa-file-alt', bgColor: 'bg-gray-100', textColor: 'text-gray-600' };
            }
        });
    </script>
</body>
</html>
