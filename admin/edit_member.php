<?php
require_once __DIR__ . '/../php/includes/db_connect.php';
require_once __DIR__ . '/../php/includes/functions.php';
require_once __DIR__ . '/../php/includes/session.php';

// Secure this page
if (!is_admin_logged_in()) {
    redirect('index.php');
}

// Initialize variables
$member = null;
$page_title = 'Edit Member';

// Check if an ID is provided for editing
if (isset($_GET['id'])) {
    $member_id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND role = 'Member'");
        $stmt->execute([$member_id]);
        $member = $stmt->fetch();
        if (!$member) {
            // Member not found
            $_SESSION['error_message'] = "Member not found.";
            redirect('manage_members.php');
        }
    } catch (PDOException $e) {
        die("Error fetching member: " . $e->getMessage());
    }
} else {
    $_SESSION['error_message'] = "No member ID provided.";
    redirect('manage_members.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Admin Dashboard - PEEF</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
        .spinner {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
                <a href="dashboard.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-tachometer-alt text-center" style="width: 24px;"></i><span class="ms-3">Dashboard</span>
                </a>
                <a href="manage_members.php" class="sidebar-link active d-flex align-items-center p-3">
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
                <h1 class="h2 font-bold text-brand-dark mb-0 d-none d-lg-block">Edit Member</h1>
                <div class="d-flex align-items-center">
                    <span class="d-none d-sm-inline me-3">Welcome, <strong>Admin User</strong></span>
                    <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2670&auto=format&fit=crop" alt="Admin" class="rounded-circle object-cover" style="width: 40px; height: 40px;">
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-grow-1 p-4 p-sm-5">
                <div class="container-fluid">
                    <div id="form-message" class="mb-4"></div>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h2 class="card-title h5 font-bold text-brand-dark mb-4">Editing Member: <?php echo htmlspecialchars($member['full_name']); ?></h2>
                            <form id="edit-member-form" method="POST">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($member['id']); ?>">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="full_name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($member['full_name']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($member['phone_number']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="membership_tier_id" class="form-label">Membership Tier</label>
                                        <select id="membership_tier_id" name="membership_tier_id" class="form-select" required>
                                            <option value="1" <?php if($member['membership_tier_id'] == 1) echo 'selected'; ?>>Basic</option>
                                            <option value="2" <?php if($member['membership_tier_id'] == 2) echo 'selected'; ?>>Premium</option>
                                            <option value="3" <?php if($member['membership_tier_id'] == 3) echo 'selected'; ?>>Donor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select id="is_active" name="is_active" class="form-select" required>
                                            <option value="1" <?php if($member['is_active'] == 1) echo 'selected'; ?>>Active</option>
                                            <option value="0" <?php if($member['is_active'] == 0) echo 'selected'; ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" id="submit-btn" class="btn btn-primary d-inline-flex align-items-center" style="background-color: var(--brand-green); border-color: var(--brand-green);">
                                            <span class="btn-text">Save Changes</span>
                                            <i class="fas fa-spinner fa-spin ms-2 d-none"></i>
                                        </button>
                                        <a href="manage_members.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
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
                <a href="dashboard.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-tachometer-alt text-center" style="width: 24px;"></i><span class="ms-3">Dashboard</span>
                </a>
                <a href="manage_members.php" class="sidebar-link active d-flex align-items-center p-3">
                    <i class="fas fa-users text-center" style="width: 24px;"></i><span class="ms-3">Members</span>
                </a>
                <!-- ... other links ... -->
            </nav>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#edit-member-form').on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $button = $('#submit-btn');
                const $btnText = $button.find('.btn-text');
                const $spinner = $button.find('.spinner');
                const $formMessage = $('#form-message');

                $btnText.text('Saving...');
                $spinner.removeClass('d-none');
                $button.prop('disabled', true);
                $formMessage.html('');

                $.ajax({
                    type: 'POST',
                    url: '../php/api/members.php',
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $formMessage.html('<div class="alert alert-success">' + response.message + '</div>');
                            setTimeout(function() {
                                window.location.href = 'manage_members.php';
                            }, 1500);
                        } else {
                            $formMessage.html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $formMessage.html('<div class="alert alert-danger">An unexpected error occurred.</div>');
                    },
                    complete: function() {
                        $btnText.text('Save Changes');
                        $spinner.addClass('d-none');
                        $button.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
