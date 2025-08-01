<?php
require_once __DIR__ . '/php/includes/db_connect.php';
require_once __DIR__ . '/php/includes/functions.php';

// Get post ID from URL and validate it
$post_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$post_id) {
    redirect('knowledge_hub.php');
}

try {
    // Fetch the specific blog post along with author and category name
    $sql = "SELECT 
                p.title, 
                p.content, 
                p.published_at, 
                p.featured_image,
                u.full_name AS author,
                c.name AS category
            FROM blog_posts p
            JOIN users u ON p.author_id = u.id
            LEFT JOIN blog_categories c ON p.category_id = c.id
            WHERE p.id = ? AND p.status = 'Published'";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        // If post not found or not published, redirect to 404
        redirect('404.php');
    }

} catch (PDOException $e) {
    // In a real app, you'd log this error.
    die("Error fetching post details: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - PEEF Knowledge Hub</title>

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
        .nav-link.active {
            color: var(--brand-green) !important;
        }
        
        .post-content h2 {
            font-size: 1.875rem; /* text-3xl */
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .post-content p {
            margin-bottom: 1.5rem;
            line-height: 1.75;
        }
        .post-content ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
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

    <main class="py-20">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <div class="mb-8">
                    <a href="knowledge_hub.php" class="text-brand-green font-semibold hover:underline"><i class="fas fa-arrow-left mr-2"></i>Back to Knowledge Hub</a>
                </div>
                
                <h1 class="text-4xl font-bold text-brand-dark mb-4"><?php echo htmlspecialchars($post['title']); ?></h1>
                
                <div class="flex items-center text-gray-500 text-sm mb-6">
                    <span><i class="fas fa-user mr-2"></i><?php echo htmlspecialchars($post['author']); ?></span>
                    <span class="mx-3">|</span>
                    <span><i class="fas fa-calendar-alt mr-2"></i><?php echo format_date($post['published_at']); ?></span>
                    <span class="mx-3">|</span>
                    <span><i class="fas fa-folder-open mr-2"></i><?php echo htmlspecialchars($post['category']); ?></span>
                </div>
                
                <?php if (!empty($post['featured_image'])): ?>
                <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-96 object-cover rounded-lg mb-8">
                <?php endif; ?>

                <div class="post-content text-lg text-gray-800">
                    <?php echo $post['content']; // Content is from a trusted source (admin), so not escaped here ?>
                </div>

                <hr class="my-8">

                <div class="flex items-center justify-between">
                    <h4 class="font-bold">Share this post:</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-blue-600 text-2xl"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-500 hover:text-blue-400 text-2xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-500 hover:text-blue-700 text-2xl"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-500 hover:text-green-500 text-2xl"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
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
        });
    </script>
</body>
</html>
