<?php
// Start the session to be able to access session variables.
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PEEF</title>

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

    <div class="min-h-screen flex items-center justify-center p-4" style="background-image: url('https://images.unsplash.com/photo-1553028826-f4804a6dba3b?q=80&w=2574&auto=format&fit=crop'); background-size: cover; background-position: center;">
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm p-8 rounded-xl shadow-2xl">
            <div class="text-center mb-8">
                <a href="../index.php">
                    <img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/FFFFFF/044F04?text=PEEF&font=quicksand';" alt="PEEF Logo" class="h-16 mx-auto">
                </a>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-center text-brand-dark mb-2">Admin Portal</h1>
                <p class="text-center text-gray-600 mb-8">Please sign in to continue.</p>
                
                <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline" id="error-text"></span>
                </div>
                
                <form id="login-form" method="POST">
                    <div class="mb-4">
                        <label for="email" class="block font-bold mb-2 text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="admin@peef.ng" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block font-bold mb-2 text-gray-700">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-brand-green focus:ring-brand-gold border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                        </div>
                    </div>
                    <button type="submit" id="login-btn" class="btn-primary w-full text-lg">
                        <span class="btn-text">Login</span>
                        <i class="fas fa-spinner spinner ml-2 hidden"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const $form = $(this);
                const $button = $('#login-btn');
                const $btnText = $button.find('.btn-text');
                const $spinner = $button.find('.spinner');
                const $errorMessage = $('#error-message');
                const $errorText = $('#error-text');

                // Show loading state
                $btnText.text('Authenticating...');
                $spinner.removeClass('hidden');
                $button.prop('disabled', true);
                $errorMessage.addClass('hidden');

                $.ajax({
                    type: 'POST',
                    url: 'login_process.php',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // On success, redirect to the dashboard
                            window.location.href = response.redirect;
                        } else {
                            // On failure, show the error message
                            $errorText.text(response.message);
                            $errorMessage.removeClass('hidden');
                            
                            // Reset button state
                            $btnText.text('Login');
                            $spinner.addClass('hidden');
                            $button.prop('disabled', false);
                        }
                    },
                    error: function() {
                        // Handle server errors (e.g., 500)
                        $errorText.text('An unexpected error occurred. Please try again.');
                        $errorMessage.removeClass('hidden');
                        
                        // Reset button state
                        $btnText.text('Login');
                        $spinner.addClass('hidden');
                        $button.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
