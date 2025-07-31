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
        
    </style>
</head>
<body class="bg-brand-light-bg">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <a href="index.php">
                    <img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/044F04/FFFFFF?text=PEEF&font=quicksand';" alt="PEEF Logo" class="h-16 mx-auto">
                </a>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h1 class="text-3xl font-bold text-center text-brand-dark mb-2">Welcome Back!</h1>
                <p class="text-center text-gray-600 mb-8">Login to your PEEF account.</p>
                
                <form action="#" method="POST">
                    <div class="mb-4">
                        <label for="email" class="block font-bold mb-2 text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-gold" required>
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
                        <div class="text-sm">
                            <a href="#" class="font-medium text-brand-green hover:text-brand-gold">Forgot your password?</a>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full text-lg">Login</button>
                </form>
                <p class="text-center text-gray-600 mt-8">
                    Don't have an account? <a href="members.php" class="font-medium text-brand-green hover:text-brand-gold">Sign up here</a>.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
