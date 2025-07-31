<?php
require_once __DIR__ . '/../php/includes/functions.php';
require_once __DIR__ . '/../php/includes/session.php';

// Secure this page: Check if the admin is logged in.
// If not, redirect them to the login page.
if (!is_admin_logged_in()) {
    redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PEEF</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Chart.js for Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        
        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #033b03, var(--brand-green));
        }
        .sidebar-link {
            transition: background-color 0.3s ease, color 0.3s ease;
            color: white;
            text-decoration: none;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background-color: var(--brand-gold);
            color: var(--brand-dark);
            border-radius: 0.5rem;
        }
        .sidebar-link.active {
            font-weight: 700;
        }
        
        .main-content {
            flex-grow: 1;
        }
        
        .offcanvas.offcanvas-start {
            width: 260px;
            background: linear-gradient(180deg, #033b03, var(--brand-green));
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- Desktop Sidebar -->
        <aside class="sidebar text-white d-none d-lg-flex flex-column p-3">
            <div class="text-center py-4 border-bottom border-white-50">
                <a href="dashboard.php">
                    <img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/FFFFFF/044F04?text=PEEF&font=quicksand';" alt="PEEF Logo" style="height: 50px;" class="mx-auto">
                </a>
            </div>
            <nav class="nav flex-column my-4">
                <a href="dashboard.php" class="sidebar-link active d-flex align-items-center p-3">
                    <i class="fas fa-tachometer-alt text-center" style="width: 24px;"></i><span class="ms-3">Dashboard</span>
                </a>
                <a href="manage_members.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-users text-center" style="width: 24px;"></i><span class="ms-3">Members</span>
                </a>
                <a href="manage_events.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-calendar-check text-center" style="width: 24px;"></i><span class="ms-3">Events</span>
                </a>
                <a href="manage_donations.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-hand-holding-dollar text-center" style="width: 24px;"></i><span class="ms-3">Donations</span>
                </a>
                <a href="manage_blog.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-newspaper text-center" style="width: 24px;"></i><span class="ms-3">Blog</span>
                </a>
                <a href="manage_resources.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-book text-center" style="width: 24px;"></i><span class="ms-3">Resources</span>
                </a>
                <a href="manage_gallery.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-images text-center" style="width: 24px;"></i><span class="ms-3">Gallery</span>
                </a>
                <a href="settings.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-cog text-center" style="width: 24px;"></i><span class="ms-3">Settings</span>
                </a>
            </nav>
            <div class="mt-auto p-3 border-top border-white-50">
                <a href="logout.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-sign-out-alt text-center" style="width: 24px;"></i><span class="ms-3">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content d-flex flex-column">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm p-4 d-flex justify-content-between align-items-center">
                <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile-sidebar" aria-controls="mobile-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h2 font-bold text-brand-dark mb-0 d-none d-lg-block">Dashboard</h1>
                <div class="d-flex align-items-center">
                    <span class="d-none d-sm-inline me-3">Welcome, <strong>Admin User</strong></span>
                    <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2670&auto=format&fit=crop" alt="Admin" class="rounded-circle object-cover" style="width: 40px; height: 40px;">
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-grow-1 p-4 p-sm-5">
                <div class="container-fluid">
                    <!-- Stat Cards -->
                    <div class="row g-4">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-sm border-0 h-100"><div class="card-body d-flex justify-content-between align-items-center"><div><p class="text-muted">Total Members</p><p id="total-members" class="h2 fw-bold">...</p></div><i class="fas fa-users fa-2x text-primary opacity-50"></i></div></div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-sm border-0 h-100"><div class="card-body d-flex justify-content-between align-items-center"><div><p class="text-muted">Total Donations</p><p id="total-donations" class="h2 fw-bold">...</p></div><i class="fas fa-hand-holding-dollar fa-2x text-success opacity-50"></i></div></div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-sm border-0 h-100"><div class="card-body d-flex justify-content-between align-items-center"><div><p class="text-muted">Upcoming Events</p><p id="upcoming-events" class="h2 fw-bold">...</p></div><i class="fas fa-calendar-check fa-2x text-warning opacity-50"></i></div></div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-sm border-0 h-100"><div class="card-body d-flex justify-content-between align-items-center"><div><p class="text-muted">Blog Posts</p><p id="total-posts" class="h2 fw-bold">...</p></div><i class="fas fa-newspaper fa-2x text-info opacity-50"></i></div></div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="row g-4 mt-4">
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Member Growth (Last 6 Months)</h5>
                                    <div style="height: 300px;">
                                        <canvas id="memberGrowthChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Donations by Month</h5>
                                    <div style="height: 300px;">
                                        <canvas id="donationChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Recent Activity</h5>
                            <div id="recent-activity-list" class="list-group">
                                <!-- Activity items will be loaded here by AJAX -->
                                <p class="text-muted">Loading activity...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Mobile Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="mobile-sidebar" aria-labelledby="mobile-sidebar-label">
        <div class="offcanvas-header border-bottom border-white-50">
            <h5 class="offcanvas-title" id="mobile-sidebar-label">
                <img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/FFFFFF/044F04?text=PEEF&font=quicksand';" alt="PEEF Logo" style="height: 40px;">
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a href="dashboard.php" class="sidebar-link active d-flex align-items-center p-3">
                    <i class="fas fa-tachometer-alt text-center" style="width: 24px;"></i><span class="ms-3">Dashboard</span>
                </a>
                <a href="manage_members.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-users text-center" style="width: 24px;"></i><span class="ms-3">Members</span>
                </a>
                <a href="manage_events.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-calendar-check text-center" style="width: 24px;"></i><span class="ms-3">Events</span>
                </a>
                <a href="manage_donations.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-hand-holding-dollar text-center" style="width: 24px;"></i><span class="ms-3">Donations</span>
                </a>
                <a href="manage_blog.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-newspaper text-center" style="width: 24px;"></i><span class="ms-3">Blog</span>
                </a>
                <a href="manage_resources.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-book text-center" style="width: 24px;"></i><span class="ms-3">Resources</span>
                </a>
                <a href="manage_gallery.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-images text-center" style="width: 24px;"></i><span class="ms-3">Gallery</span>
                </a>
                <a href="settings.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-cog text-center" style="width: 24px;"></i><span class="ms-3">Settings</span>
                </a>
                <a href="logout.php" class="sidebar-link d-flex align-items-center p-3 mt-4">
                    <i class="fas fa-sign-out-alt text-center" style="width: 24px;"></i><span class="ms-3">Logout</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../php/api/dashboard.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const data = response.data;
                        
                        // Update Stat Cards
                        $('#total-members').text(data.stats.total_members || 0);
                        $('#total-donations').text('₦' + new Intl.NumberFormat().format(data.stats.total_donations || 0));
                        $('#upcoming-events').text(data.stats.upcoming_events || 0);
                        $('#total-posts').text(data.stats.total_posts || 0);

                        // Populate recent activity
                        const activityList = $('#recent-activity-list');
                        activityList.empty();
                        if (data.recent_activity && data.recent_activity.length > 0) {
                            data.recent_activity.forEach(item => {
                                const icon = item.action === 'New Member' ? 'fa-user-plus text-primary' : 'fa-donate text-success';
                                const activityHtml = `<div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas ${icon} me-3"></i>
                                        <strong>${item.action}:</strong> ${item.detail}
                                    </div>
                                    <small class="text-muted">${new Date(item.date).toLocaleString()}</small>
                                </div>`;
                                activityList.append(activityHtml);
                            });
                        } else {
                            activityList.html('<p class="text-muted">No recent activity.</p>');
                        }

                        // Member Growth Chart
                        const memberLabels = data.charts.member_growth.map(item => new Date(item.month + '-01').toLocaleString('default', { month: 'short' }));
                        const memberData = data.charts.member_growth.map(item => item.new_members);
                        const memberCtx = document.getElementById('memberGrowthChart').getContext('2d');
                        new Chart(memberCtx, {
                            type: 'line',
                            data: {
                                labels: memberLabels,
                                datasets: [{
                                    label: 'New Members',
                                    data: memberData,
                                    borderColor: '#044F04',
                                    backgroundColor: 'rgba(4, 79, 4, 0.1)',
                                    fill: true,
                                    tension: 0.4
                                }]
                            },
                            options: { responsive: true, maintainAspectRatio: false }
                        });

                        // Donation Chart
                        const donationLabels = data.charts.donations.map(item => new Date(item.month + '-01').toLocaleString('default', { month: 'short' }));
                        const donationData = data.charts.donations.map(item => item.total_donations);
                        const donationCtx = document.getElementById('donationChart').getContext('2d');
                        new Chart(donationCtx, {
                            type: 'bar',
                            data: {
                                labels: donationLabels,
                                datasets: [{
                                    label: 'Donations (NGN)',
                                    data: donationData,
                                    backgroundColor: '#fcb900'
                                }]
                            },
                            options: { responsive: true, maintainAspectRatio: false }
                        });
                    }
                },
                error: function() {
                    // Handle error loading dashboard data
                    console.error("Failed to load dashboard data.");
                }
            });
        });
    </script>
</body>
</html>
