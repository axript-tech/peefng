<?php
// In a real application, you might start a session here
// session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PEEF</title>

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

    <div class="min-h-screen flex items-center justify-center p-4" style="background-image: linear-gradient(rgba(4, 79, 4, 0.8), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2670&auto=format&fit=crop'); background-size: cover; background-position: center;">
        <div class="w-full max-w-md bg-white/95 p-8 rounded-xl shadow-2xl">
            <div class="text-center mb-8">
                <a href="index.php">
                    <img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/044F04/FFFFFF?text=PEEF&font=quicksand';" alt="PEEF Logo" class="h-16 mx-auto">
                </a>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-center text-brand-dark mb-2">Member Login</h1>
                <p class="text-center text-gray-600 mb-8">Welcome back! Please sign in to your account.</p>
                
                <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline" id="error-text"></span>
                </div>
                
                <form id="login-form" method="POST">
                    <div class="mb-4">
                        <label for="email" class="block font-bold mb-2 text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block font-bold mb-2 text-gray-700">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
                    </div>
                    <button type="submit" id="login-btn" class="btn-primary w-full text-lg">
                        <span class="btn-text">Login</span>
                        <i class="fas fa-spinner spinner ml-2 hidden"></i>
                    </button>
                </form>
                <p class="text-center text-gray-600 mt-6">
                    Don't have an account? <a href="members.php" class="font-bold text-brand-green hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $button = $('#login-btn');
                const $btnText = $button.find('.btn-text');
                const $spinner = $button.find('.spinner');
                const $errorMessage = $('#error-message');
                const $errorText = $('#error-text');

                $btnText.text('Signing In...');
                $spinner.removeClass('hidden');
                $button.prop('disabled', true);
                $errorMessage.addClass('hidden');

                $.ajax({
                    type: 'POST',
                    url: 'php/process/process_login.php',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = response.redirect;
                        } else {
                            $errorText.text(response.message);
                            $errorMessage.removeClass('hidden');
                            $btnText.text('Login');
                            $spinner.addClass('hidden');
                            $button.prop('disabled', false);
                        }
                    },
                    error: function() {
                        $errorText.text('An unexpected error occurred. Please try again.');
                        $errorMessage.removeClass('hidden');
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
