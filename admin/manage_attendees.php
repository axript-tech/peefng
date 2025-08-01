<?php
require_once __DIR__ . '/../php/includes/session.php';
// In a real application, you would fetch the event title based on $_GET['event_id']
$event_title = "Sample Event Title"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Attendees - <?php echo htmlspecialchars($event_title); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --brand-green: #044F04; --brand-gold: #fcb900; }
        body { font-family: 'Quicksand', sans-serif; background-color: #f7fafc; }
        .sidebar { width: 260px; min-height: 100vh; background: linear-gradient(180deg, #033b03, var(--brand-green)); }
        .sidebar-link { color: white; text-decoration: none; transition: all 0.3s ease; }
        .sidebar-link:hover, .sidebar-link.active { background-color: var(--brand-gold); color: #1a202c; border-radius: 0.5rem; }
        .sidebar-link.active { font-weight: 700; }
        .main-content { flex-grow: 1; }
    </style>
</head>
<body>
    <div class="d-flex">
        <aside class="sidebar text-white d-none d-lg-flex flex-column p-3">
            <!-- Sidebar content would be included here -->
        </aside>
        <div class="main-content d-flex flex-column">
            <header class="bg-white shadow-sm p-4 d-flex justify-content-between align-items-center">
                <h1 class="h2 fw-bold text-dark mb-0">Manage Attendees</h1>
                <!-- Header content would be included here -->
            </header>
            <main class="flex-grow-1 p-4 p-sm-5">
                <div class="container-fluid">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <a href="manage_events.php" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left me-2"></i>Back to Events</a>
                            <h2 class="card-title h5 font-bold mb-4">Attendees for: <?php echo htmlspecialchars($event_title); ?></h2>
                            <p>This page will list all registered participants for this event. Functionality to check in attendees, export lists, and send communications can be built here.</p>
                            <!-- Attendee table will go here -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
