<?php
require_once __DIR__ . '/../php/includes/session.php';
// The rest of your PHP logic can go here if needed.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Albums - Admin Dashboard - PEEF</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap CSS for DataTables & Modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

    <!-- Google Fonts: Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f3f4f6; /* bg-gray-100 */
            color: #1f2937; /* text-gray-800 */
        }
        
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-link {
            transition: all 0.3s ease;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background-color: #facc15; /* yellow-400 */
            color: #111827; /* text-gray-900 */
            transform: translateX(10px);
            border-radius: 0.5rem;
        }

        /* DataTables Customization */
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.5rem !important;
        }
        .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
    </style>
</head>
<body class="text-gray-800">

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar w-64 bg-gray-800 text-white p-6 shadow-2xl flex-shrink-0 fixed h-screen z-20 -translate-x-full lg:translate-x-0">
            <div class="text-center mb-10">
                <a href="dashboard.php"><img src="https://placehold.co/80x80/ffffff/333333?text=PEEF" alt="PEEF Logo" class="mx-auto mb-3 rounded-full"></a>
                <h1 class="text-xl font-bold text-yellow-400">Admin Panel</h1>
            </div>
            <nav>
                <ul>
                    <li class="mb-4"><a href="dashboard.php" class="sidebar-link flex items-center p-3"><i class="fas fa-tachometer-alt w-6 text-center"></i><span class="ml-4 font-semibold">Dashboard</span></a></li>
                    <li class="mb-4"><a href="manage_members.php" class="sidebar-link flex items-center p-3"><i class="fas fa-users w-6 text-center"></i><span class="ml-4 font-semibold">Members</span></a></li>
                    <li class="mb-4"><a href="manage_events.php" class="sidebar-link flex items-center p-3"><i class="fas fa-calendar-check w-6 text-center"></i><span class="ml-4 font-semibold">Events</span></a></li>
                    <li class="mb-4"><a href="manage_donations.php" class="sidebar-link flex items-center p-3"><i class="fas fa-hand-holding-dollar w-6 text-center"></i><span class="ml-4 font-semibold">Donations</span></a></li>
                    <li class="mb-4"><a href="manage_blog.php" class="sidebar-link flex items-center p-3"><i class="fas fa-newspaper w-6 text-center"></i><span class="ml-4 font-semibold">Blog</span></a></li>
                    <li class="mb-4"><a href="manage_resources.php" class="sidebar-link flex items-center p-3"><i class="fas fa-book w-6 text-center"></i><span class="ml-4 font-semibold">Resources</span></a></li>
                    <li class="mb-4"><a href="manage_gallery.php" class="sidebar-link active flex items-center p-3"><i class="fas fa-images w-6 text-center"></i><span class="ml-4 font-semibold">Gallery</span></a></li>
                    <li class="mb-4"><a href="settings.php" class="sidebar-link flex items-center p-3"><i class="fas fa-cog w-6 text-center"></i><span class="ml-4 font-semibold">Settings</span></a></li>
                </ul>
            </nav>
            <div class="absolute bottom-6 left-6 right-6">
                <a href="logout.php" class="sidebar-link flex items-center p-3 bg-gray-700 hover:bg-red-500">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    <span class="ml-4 font-semibold">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 lg:p-8 lg:ml-64 bg-gray-100 min-h-screen">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <div>
                    <button id="menu-btn" class="lg:hidden text-2xl text-gray-600">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2 class="hidden lg:block text-3xl font-bold">Manage Gallery Albums</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-bold">Admin User</p>
                        <p class="text-sm text-gray-500">System Administrator</p>
                    </div>
                    <img src="https://placehold.co/40x40/1f2937/facc15?text=A" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-gray-700">
                </div>
            </header>
            
            <h2 class="lg:hidden text-2xl font-bold mb-6">Manage Gallery Albums</h2>

            <!-- Main Table Card -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
                    <h3 class="text-xl font-bold mb-3 sm:mb-0">All Albums</h3>
                    <button id="add-album-btn" class="btn btn-warning fw-bold text-dark w-100 sm:w-auto">
                        <i class="fas fa-plus me-2"></i>Add New Album
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table id="albums-table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Album Name</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Add/Edit Album Modal -->
    <div class="modal fade" id="album-modal" tabindex="-1" aria-labelledby="albumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="albumModalLabel">Add New Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-form-message" class="d-none"></div>
                    <form id="album-form">
                        <input type="hidden" id="album_id" name="id">
                        <input type="hidden" id="action" name="action" value="create">
                        <div class="mb-3">
                            <label for="name" class="form-label">Album Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="save-album-btn" class="btn btn-warning text-dark fw-bold">Save Album</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete-confirm-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm Deletion</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this album: <strong id="album-name-to-delete"></strong>?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm-delete-btn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toast Container -->
    <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1150"></div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            // Sidebar Toggle for Mobile
            const menuBtn = document.getElementById('menu-btn');
            const sidebar = document.getElementById('sidebar');
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });

            var table = $('#albums-table').DataTable({
                "ajax": { "url": "../php/api/gallery_albums.php", "dataSrc": "data" },
                "columns": [
                    { "data": "name" },
                    { "data": "description" },
                    { "data": "created_at" },
                    { 
                        "data": "id", 
                        "orderable": false,
                        "render": function(data, type, row) {
                            return `<button class="btn btn-light btn-sm action-btn edit-btn" title="Edit" data-id="${data}"><i class="fas fa-edit text-primary"></i></button>
                                    <button class="btn btn-light btn-sm action-btn delete-btn" title="Delete" data-id="${data}" data-name="${row.name}"><i class="fas fa-trash text-danger"></i></button>`;
                        }
                    }
                ],
                "order": [[2, 'desc']],
                "columnDefs": [ { "targets": [1, 2, 3], "className": "text-center" } ]
            });

            const albumModal = new bootstrap.Modal(document.getElementById('album-modal'));
            
            $('#add-album-btn').on('click', function() {
                $('#album-form')[0].reset();
                $('#albumModalLabel').text('Add New Album');
                $('#action').val('create');
                $('#album_id').val('');
                albumModal.show();
            });

            $('#save-album-btn').on('click', function() {
                const formData = new FormData($('#album-form')[0]);
                $.ajax({
                    type: 'POST', url: '../php/api/gallery_albums.php', data: formData, dataType: 'json', contentType: false, processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            table.ajax.reload();
                            albumModal.hide();
                        } else {
                            $('#modal-form-message').html('<div class="alert alert-danger">' + response.message + '</div>').removeClass('d-none');
                        }
                    },
                    error: function() { $('#modal-form-message').html('<div class="alert alert-danger">An unexpected error occurred.</div>').removeClass('d-none'); }
                });
            });

            $('#albums-table tbody').on('click', '.edit-btn', function() {
                const rowData = table.row($(this).parents('tr')).data();
                $('#albumModalLabel').text('Edit Album');
                $('#action').val('update');
                $('#album_id').val(rowData.id);
                $('#name').val(rowData.name);
                $('#description').val(rowData.description);
                albumModal.show();
            });

            let albumIdToDelete = null;
            const deleteModal = new bootstrap.Modal(document.getElementById('delete-confirm-modal'));

            $('#albums-table tbody').on('click', '.delete-btn', function() {
                albumIdToDelete = $(this).data('id');
                $('#album-name-to-delete').text($(this).data('name'));
                deleteModal.show();
            });

            $('#confirm-delete-btn').on('click', function() {
                if (albumIdToDelete) {
                    $.ajax({
                        type: 'POST', url: '../php/api/gallery_albums.php', data: { action: 'delete', id: albumIdToDelete }, dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                showToast(response.message, 'success');
                                table.ajax.reload();
                            } else {
                                showToast(response.message, 'danger');
                            }
                        },
                        error: function() { showToast('An unexpected error occurred.', 'danger'); },
                        complete: function() { deleteModal.hide(); albumIdToDelete = null; }
                    });
                }
            });

            function showToast(message, type = 'success') {
                const toastHtml = `
                    <div class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>`;
                const $toastEl = $(toastHtml);
                $('#toast-container').append($toastEl);
                
                const toast = new bootstrap.Toast($toastEl[0]);
                
                $toastEl.on('hidden.bs.toast', function () {
                    $(this).remove();
                });
                
                toast.show();
            }
        });
    </script>
</body>
</html>
