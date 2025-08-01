<?php
    $pageLink = 'about.php';
    $pageTitle = 'About PEEF';
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


    <!-- Page Header -->
    <section class="page-header" style="background-image: linear-gradient(rgba(4, 79, 4, 0.7), rgba(0, 0, 0, 0.6)), url('assets/images/gallery/peef6.jpeg');">
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
                        <img src="assets/images/gallery/peef6.jpeg" onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/333333?text=Our+Journey';" alt="Team working together" class="rounded-xl shadow-lg">
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
        <?php require_once 'page-sections/footer.php'; ?>


    <!-- Scripts -->
           <?php require_once 'php/includes/footscripts.php'; ?>

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
