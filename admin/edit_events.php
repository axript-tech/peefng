<?php
require_once __DIR__ . '/../php/includes/db_connect.php';
require_once __DIR__ . '/../php/includes/functions.php';
require_once __DIR__ . '/../php/includes/session.php';

// Secure this page
if (!is_admin_logged_in()) {
    redirect('index.php');
}

// Initialize variables
$event = ['id' => '', 'title' => '', 'description' => '', 'start_datetime' => '', 'end_datetime' => '', 'location' => '', 'ticket_price' => ''];
$page_title = 'Add New Event';
$is_editing = false;

// Check if an ID is provided for editing
if (isset($_GET['id'])) {
    $is_editing = true;
    $event_id = $_GET['id'];
    $page_title = 'Edit Event';

    try {
        $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$event_id]);
        $event = $stmt->fetch();
        if (!$event) {
            $_SESSION['error_message'] = "Event not found.";
            redirect('manage_events.php');
        }
    } catch (PDOException $e) {
        die("Error fetching event: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Admin Dashboard - PEEF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root { --brand-green: #044F04; --brand-gold: #fcb900; --brand-dark: #1a202c; --brand-light-bg: #f7fafc; }
        body { font-family: 'Quicksand', sans-serif; background-color: var(--brand-light-bg); }
        .sidebar { width: 260px; min-height: 100vh; background: linear-gradient(180deg, #033b03, var(--brand-green)); }
        .sidebar-link { transition: all 0.3s ease; color: white; text-decoration: none; }
        .sidebar-link:hover, .sidebar-link.active { background-color: var(--brand-gold); color: var(--brand-dark); border-radius: 0.5rem; }
        .sidebar-link.active { font-weight: 700; }
        .main-content { flex-grow: 1; }
        .offcanvas.offcanvas-start { width: 260px; background: linear-gradient(180deg, #033b03, var(--brand-green)); }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar text-white d-none d-lg-flex flex-column p-3">
            <div class="text-center py-4 border-bottom border-white-50">
                <a href="dashboard.php"><img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/FFFFFF/044F04?text=PEEF&font=quicksand';" alt="PEEF Logo" style="height: 50px;" class="mx-auto"></a>
            </div>
            <nav class="nav flex-column my-4">
                <a href="dashboard.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-tachometer-alt text-center" style="width: 24px;"></i><span class="ms-3">Dashboard</span></a>
                <a href="manage_members.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-users text-center" style="width: 24px;"></i><span class="ms-3">Members</span></a>
                <a href="manage_events.php" class="sidebar-link active d-flex align-items-center p-3"><i class="fas fa-calendar-check text-center" style="width: 24px;"></i><span class="ms-3">Events</span></a>
                <a href="manage_donations.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-hand-holding-dollar text-center" style="width: 24px;"></i><span class="ms-3">Donations</span></a>
                <a href="manage_blog.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-newspaper text-center" style="width: 24px;"></i><span class="ms-3">Blog</span></a>
                <a href="manage_resources.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-book text-center" style="width: 24px;"></i><span class="ms-3">Resources</span></a>
                <a href="manage_gallery.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-images text-center" style="width: 24px;"></i><span class="ms-3">Gallery</span></a>
                <a href="settings.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-cog text-center" style="width: 24px;"></i><span class="ms-3">Settings</span></a>
            </nav>
            <div class="mt-auto p-3 border-top border-white-50">
                <a href="logout.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-sign-out-alt text-center" style="width: 24px;"></i><span class="ms-3">Logout</span></a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content d-flex flex-column">
            <header class="bg-white shadow-sm p-4 d-flex justify-content-between align-items-center">
                <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile-sidebar"><i class="fas fa-bars"></i></button>
                <h1 class="h2 fw-bold text-dark mb-0 d-none d-lg-block"><?php echo htmlspecialchars($page_title); ?></h1>
                <div class="d-flex align-items-center">
                    <span class="d-none d-sm-inline me-3">Welcome, <strong>Admin User</strong></span>
                    <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2670&auto=format&fit=crop" alt="Admin" class="rounded-circle object-cover" style="width: 40px; height: 40px;">
                </div>
            </header>

            <main class="flex-grow-1 p-4 p-sm-5">
                <div class="container-fluid">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <form action="../php/api/events.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="<?php echo $is_editing ? 'update' : 'create'; ?>">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($event['id']); ?>">
                                <div class="row g-4">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="title" class="form-label fw-bold">Event Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label fw-bold">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="8" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="start_datetime" class="form-label fw-bold">Start Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" value="<?php echo htmlspecialchars(str_replace(' ', 'T', $event['start_datetime'])); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_datetime" class="form-label fw-bold">End Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" value="<?php echo htmlspecialchars(str_replace(' ', 'T', $event['end_datetime'])); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="location" class="form-label fw-bold">Location</label>
                                            <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ticket_price" class="form-label fw-bold">Ticket Price (NGN)</label>
                                            <input type="number" step="0.01" class="form-control" id="ticket_price" name="ticket_price" value="<?php echo htmlspecialchars($event['ticket_price']); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success" style="background-color: var(--brand-green); border-color: var(--brand-green);">Save Event</button>
                                    <a href="manage_events.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="mobile-sidebar" aria-labelledby="mobile-sidebar-label">
        <div class="offcanvas-header border-bottom border-white-50">
            <h5 class="offcanvas-title" id="mobile-sidebar-label"><img src="https://walkathon.peef.ng/peef2.png" onerror="this.onerror=null;this.src='https://placehold.co/180x50/FFFFFF/044F04?text=PEEF&font=quicksand';" alt="PEEF Logo" style="height: 40px;"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a href="dashboard.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-tachometer-alt text-center" style="width: 24px;"></i><span class="ms-3">Dashboard</span></a>
                <a href="manage_members.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-users text-center" style="width: 24px;"></i><span class="ms-3">Members</span></a>
                <a href="manage_events.php" class="sidebar-link active d-flex align-items-center p-3"><i class="fas fa-calendar-check text-center" style="width: 24px;"></i><span class="ms-3">Events</span></a>
                <a href="manage_donations.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-hand-holding-dollar text-center" style="width: 24px;"></i><span class="ms-3">Donations</span></a>
                <a href="manage_blog.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-newspaper text-center" style="width: 24px;"></i><span class="ms-3">Blog</span></a>
                <a href="manage_resources.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-book text-center" style="width: 24px;"></i><span class="ms-3">Resources</span></a>
                <a href="manage_gallery.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-images text-center" style="width: 24px;"></i><span class="ms-3">Gallery</span></a>
                <a href="settings.php" class="sidebar-link d-flex align-items-center p-3"><i class="fas fa-cog text-center" style="width: 24px;"></i><span class="ms-3">Settings</span></a>
                <a href="logout.php" class="sidebar-link d-flex align-items-center p-3 mt-4"><i class="fas fa-sign-out-alt text-center" style="width: 24px;"></i><span class="ms-3">Logout</span></a>
            </nav>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
