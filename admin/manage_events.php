<?php
require_once __DIR__ . '/../php/includes/session.php';
// The rest of your PHP logic can go here if needed.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Admin Dashboard - PEEF</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

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
        
        /* DataTables Customization */
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.5rem !important;
        }
        .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
            background-color: var(--brand-green);
            border-color: var(--brand-green);
        }
        
        /* Modern Table Style */
        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .table thead th {
            background-color: var(--brand-light-bg);
            border-bottom: 2px solid #dee2e6;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
            text-align: center;
        }
        .table tbody tr {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s ease-in-out;
        }
        .table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .table td, .table th {
            border: none;
            vertical-align: middle;
        }
        .table td:first-child, .table th:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }
        .table td:last-child, .table th:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
        .table th:nth-child(2), .table td:nth-child(2) {
            text-align: left;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
        .child-row-card {
            background-color: #f8f9fa;
            border-left: 4px solid var(--brand-green);
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
            <!-- Top Bar -->
            <header class="bg-white shadow-sm p-4 d-flex justify-content-between align-items-center">
                <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile-sidebar" aria-controls="mobile-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h2 font-bold text-brand-dark mb-0 d-none d-lg-block">Manage Events</h1>
                <div class="d-flex align-items-center">
                    <span class="d-none d-sm-inline me-3">Welcome, <strong>Admin User</strong></span>
                    <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2670&auto=format&fit=crop" alt="Admin" class="rounded-circle object-cover" style="width: 40px; height: 40px;">
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-grow-1 p-4 p-sm-5">
                <div class="container-fluid">
                    <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1100"></div>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
                                <h2 class="card-title h5 font-bold text-brand-dark mb-3 mb-sm-0">All Events</h2>
                                <button id="add-event-btn" class="btn btn-success" style="background-color: var(--brand-green); border-color: var(--brand-green);">
                                    <i class="fas fa-plus me-2"></i>Add New Event
                                </button>
                            </div>
                            
                            <!-- Events Table -->
                            <div class="table-responsive">
                                <table id="events-table" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Event Title</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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

    <!-- Add/Edit Event Modal -->
    <div class="modal fade" id="event-modal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add New Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-form-message" class="d-none"></div>
                    <form id="event-form" enctype="multipart/form-data">
                        <input type="hidden" id="event_id" name="id">
                        <input type="hidden" id="action" name="action" value="create">
                        <input type="hidden" id="existing_poster" name="existing_poster">
                        <div class="mb-3">
                            <label for="title" class="form-label">Event Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6"><label for="start_datetime" class="form-label">Start Date & Time</label><input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required></div>
                            <div class="col-md-6"><label for="end_datetime" class="form-label">End Date & Time</label><input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required></div>
                            <div class="col-md-6"><label for="location" class="form-label">Location</label><input type="text" class="form-control" id="location" name="location" required></div>
                            <div class="col-md-6"><label for="poster_image" class="form-label">Poster Image</label><input class="form-control" type="file" id="poster_image" name="poster_image"></div>
                        </div>
                        <hr class="my-4">
                        <h5 class="mb-3">Participation Tiers</h5>
                        <div id="tier-inputs">
                            <div class="row g-3 mb-2 align-items-center">
                                <div class="col-5"><input type="text" name="tier_name[]" class="form-control" placeholder="Tier Name (e.g., Regular)" required></div>
                                <div class="col-5"><input type="number" name="tier_cost[]" class="form-control" placeholder="Cost (NGN)" required></div>
                            </div>
                        </div>
                        <button type="button" id="add-tier-btn" class="btn btn-sm btn-outline-success mt-2"><i class="fas fa-plus me-1"></i> Add Tier</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="save-event-btn" class="btn btn-primary" style="background-color: var(--brand-green); border-color: var(--brand-green);">Save Event</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete-confirm-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm Deletion</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this event: <strong id="event-name-to-delete"></strong>?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm-delete-btn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        function format(d) {
            let tiersHtml = '<ul class="list-unstyled">';
            d.tiers.forEach(tier => {
                tiersHtml += `<li>${tier.tier_name}: <strong>₦${new Intl.NumberFormat().format(tier.cost)}</strong></li>`;
            });
            tiersHtml += '</ul>';

            return (
                `<div class="p-4 child-row-card">
                    <div class="row align-items-center">
                        <div class="col-lg-4 text-center mb-3 mb-lg-0">
                            <img src="../${d.poster_image || 'assets/images/hero-bg.jpg'}" class="img-fluid rounded shadow-sm" alt="Event Poster">
                        </div>
                        <div class="col-lg-8">
                            <h5 class="fw-bold">${d.title}</h5>
                            <p>${d.description}</p>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Participation Tiers:</strong></p>
                                    ${tiersHtml}
                                </div>
                                <div class="col-md-6">
                                    <a href="manage_attendees.php?event_id=${d.id}" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-users me-2"></i>Manage Attendees
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
            );
        }

        $(document).ready(function() {
            var table = $('#events-table').DataTable({
                "ajax": { "url": "../php/api/events.php", "dataSrc": "data" },
                "columns": [
                    { "className": 'details-control', "orderable": false, "data": null, "defaultContent": '' },
                    { "data": "title" },
                    { "data": "start_datetime" },
                    { "data": "location" },
                    { 
                        "data": "id", 
                        "orderable": false,
                        "render": function(data, type, row) {
                            return `<button class="btn btn-light btn-sm action-btn edit-btn" title="Edit" data-id="${data}"><i class="fas fa-edit text-primary"></i></button>
                                    <button class="btn btn-light btn-sm action-btn delete-btn" title="Delete" data-id="${data}" data-name="${row.title}"><i class="fas fa-trash text-danger"></i></button>`;
                        }
                    }
                ],
                "order": [[2, 'desc']],
                "columnDefs": [ { "targets": [0, 2, 3, 4], "className": "text-center" } ]
            });

            const eventModal = new bootstrap.Modal(document.getElementById('event-modal'));
            
            $('#add-event-btn').on('click', function() {
                $('#event-form')[0].reset();
                $('#eventModalLabel').text('Add New Event');
                $('#action').val('create');
                $('#event_id').val('');
                $('#tier-inputs').html('<div class="row g-3 mb-2 align-items-center"><div class="col-5"><input type="text" name="tier_name[]" class="form-control" placeholder="Tier Name (e.g., Regular)" required></div><div class="col-5"><input type="number" name="tier_cost[]" class="form-control" placeholder="Cost (NGN)" required></div></div>');
                eventModal.show();
            });

            $('#add-tier-btn').on('click', function() {
                $('#tier-inputs').append('<div class="row g-3 mb-2 align-items-center"><div class="col-5"><input type="text" name="tier_name[]" class="form-control" placeholder="Tier Name"></div><div class="col-5"><input type="number" name="tier_cost[]" class="form-control" placeholder="Cost (NGN)"></div><div class="col-2"><button type="button" class="btn btn-sm btn-outline-danger remove-tier-btn"><i class="fas fa-times"></i></button></div></div>');
            });

            $('#tier-inputs').on('click', '.remove-tier-btn', function() {
                $(this).closest('.row').remove();
            });

            $('#save-event-btn').on('click', function() {
                const formData = new FormData($('#event-form')[0]);
                $.ajax({
                    type: 'POST', url: '../php/api/events.php', data: formData, dataType: 'json', contentType: false, processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            table.ajax.reload();
                            eventModal.hide();
                        } else {
                            $('#modal-form-message').html('<div class="alert alert-danger">' + response.message + '</div>').removeClass('d-none');
                        }
                    },
                    error: function() { $('#modal-form-message').html('<div class="alert alert-danger">An unexpected error occurred.</div>').removeClass('d-none'); }
                });
            });

            $('#events-table tbody').on('click', '.edit-btn', function() {
                const rowData = table.row($(this).parents('tr')).data();
                
                $('#eventModalLabel').text('Edit Event');
                $('#action').val('update');
                $('#event_id').val(rowData.id);
                $('#title').val(rowData.title);
                $('#description').val(rowData.description);
                $('#start_datetime').val(rowData.start_datetime.replace(' ', 'T'));
                $('#end_datetime').val(rowData.end_datetime.replace(' ', 'T'));
                $('#location').val(rowData.location);
                $('#existing_poster').val(rowData.poster_image);
                
                const tierInputs = $('#tier-inputs');
                tierInputs.empty();
                if (rowData.tiers && rowData.tiers.length > 0) {
                    rowData.tiers.forEach(tier => {
                        tierInputs.append(`<div class="row g-3 mb-2 align-items-center"><div class="col-5"><input type="text" name="tier_name[]" class="form-control" value="${tier.tier_name}" required></div><div class="col-5"><input type="number" name="tier_cost[]" class="form-control" value="${tier.cost}" required></div><div class="col-2"><button type="button" class="btn btn-sm btn-outline-danger remove-tier-btn"><i class="fas fa-times"></i></button></div></div>`);
                    });
                } else {
                     tierInputs.html('<div class="row g-3 mb-2 align-items-center"><div class="col-5"><input type="text" name="tier_name[]" class="form-control" placeholder="Tier Name (e.g., Regular)" required></div><div class="col-5"><input type="number" name="tier_cost[]" class="form-control" placeholder="Cost (NGN)" required></div></div>');
                }

                eventModal.show();
            });

            let eventIdToDelete = null;
            const deleteModal = new bootstrap.Modal(document.getElementById('delete-confirm-modal'));

            $('#events-table tbody').on('click', '.delete-btn', function() {
                eventIdToDelete = $(this).data('id');
                $('#event-name-to-delete').text($(this).data('name'));
                deleteModal.show();
            });

            $('#confirm-delete-btn').on('click', function() {
                if (eventIdToDelete) {
                    $.ajax({
                        type: 'POST', url: '../php/api/events.php', data: { action: 'delete', id: eventIdToDelete }, dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                showToast(response.message, 'success');
                                table.ajax.reload();
                            } else { showToast(response.message, 'danger'); }
                        },
                        error: function() { showToast('An unexpected error occurred.', 'danger'); },
                        complete: function() { deleteModal.hide(); eventIdToDelete = null; }
                    });
                }
            });

            function showToast(message, type = 'success') {
                const toastHtml = `<div class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true"><div class="d-flex"><div class="toast-body">${message}</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>`;
                $('#toast-container').append(toastHtml);
                const newToast = new bootstrap.Toast($('#toast-container .toast').last());
                newToast.show();
            }

            $('#events-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('details');
                } else {
                    row.child(format(row.data())).show();
                    tr.addClass('details');
                }
            });
        });
    </script>
</body>
</html>
