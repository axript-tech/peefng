<?php
require_once __DIR__ . '/../php/includes/session.php';
// The rest of your PHP logic can go here if needed.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - Admin Dashboard - PEEF</title>

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
                    <h2 class="hidden lg:block text-3xl font-bold">Manage Gallery</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-bold">Admin User</p>
                        <p class="text-sm text-gray-500">System Administrator</p>
                    </div>
                    <img src="https://placehold.co/40x40/1f2937/facc15?text=A" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-gray-700">
                </div>
            </header>
            
            <h2 class="lg:hidden text-2xl font-bold mb-6">Manage Gallery</h2>

            <!-- Main Table Card -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
                    <h3 class="text-xl font-bold mb-3 sm:mb-0">All Images</h3>
                    <button id="add-image-btn" class="btn btn-warning fw-bold text-dark w-100 sm:w-auto">
                        <i class="fas fa-plus me-2"></i>Upload New Image
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table id="gallery-table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>Title</th>
                                <th>Album</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Add/Edit Image Modal -->
    <div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Add New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-form-message" class="d-none"></div>
                    <form id="image-form" enctype="multipart/form-data">
                        <input type="hidden" id="image_id" name="id">
                        <input type="hidden" id="action" name="action" value="create">
                        <input type="hidden" id="existing_image_path" name="existing_image">
                        <div class="mb-3">
                            <label for="title" class="form-label">Image Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="album_id" class="form-label">Album</label>
                            <select class="form-select" id="album_id" name="album_id" required>
                                <!-- Options will be populated by jQuery -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image_file" class="form-label">Image File</label>
                            <input class="form-control" type="file" id="image_file" name="image_file">
                        </div>
                        <div id="image-preview-container" class="mb-3 d-none">
                            <label class="form-label">Current Image</label>
                            <img id="image-preview" src="" alt="Image Preview" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="save-image-btn" class="btn btn-warning text-dark fw-bold">Save Image</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete-confirm-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Confirm Deletion</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">Are you sure you want to delete this image: <strong id="image-name-to-delete"></strong>?</div>
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

            // Fetch albums for the dropdown
            $.ajax({
                url: '../php/api/gallery_albums.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.data) {
                        const albumSelect = $('#album_id');
                        albumSelect.empty();
                        albumSelect.append('<option value="">Select an Album...</option>');
                        response.data.forEach(album => {
                            albumSelect.append(`<option value="${album.id}">${album.name}</option>`);
                        });
                    }
                }
            });

            var table = $('#gallery-table').DataTable({
                "ajax": { "url": "../php/api/gallery.php", "dataSrc": "data" },
                "columns": [
                    { "data": "image_path", "render": function(data) { return `<img src="../${data}" class="rounded" style="width: 100px; height: 75px; object-fit: cover;">`; } },
                    { "data": "title" },
                    { "data": "album_name" },
                    { "data": "created_at" },
                    { 
                        "data": "id", 
                        "orderable": false,
                        "render": function(data, type, row) {
                            return `<button class="btn btn-light btn-sm action-btn edit-btn" title="Edit" data-id="${data}"><i class="fas fa-edit text-primary"></i></button>
                                    <button class="btn btn-light btn-sm action-btn delete-btn" title="Delete" data-id="${data}" data-name="${row.title}"><i class="fas fa-trash text-danger"></i></button>`;
                        }
                    }
                ],
                "order": [[3, 'desc']],
                "columnDefs": [ { "targets": [0, 2, 3, 4], "className": "text-center" } ]
            });

            const imageModal = new bootstrap.Modal(document.getElementById('image-modal'));
            
            $('#add-image-btn').on('click', function() {
                $('#image-form')[0].reset();
                $('#imageModalLabel').text('Add New Image');
                $('#action').val('create');
                $('#image_id').val('');
                $('#image_file').prop('required', true);
                $('#image-preview-container').addClass('d-none');
                imageModal.show();
            });

            $('#save-image-btn').on('click', function() {
                const formData = new FormData($('#image-form')[0]);
                $.ajax({
                    type: 'POST', url: '../php/api/gallery.php', data: formData, dataType: 'json', contentType: false, processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            table.ajax.reload();
                            imageModal.hide();
                        } else {
                            $('#modal-form-message').html('<div class="alert alert-danger">' + response.message + '</div>').removeClass('d-none');
                        }
                    },
                    error: function() { $('#modal-form-message').html('<div class="alert alert-danger">An unexpected error occurred.</div>').removeClass('d-none'); }
                });
            });

            $('#gallery-table tbody').on('click', '.edit-btn', function() {
                const rowData = table.row($(this).parents('tr')).data();
                $('#imageModalLabel').text('Edit Image');
                $('#action').val('update');
                $('#image_id').val(rowData.id);
                $('#title').val(rowData.title);
                $('#album_id').val(rowData.album_id);
                $('#description').val(rowData.description);
                $('#existing_image_path').val(rowData.image_path);
                $('#image-preview').attr('src', '../' + rowData.image_path);
                $('#image-preview-container').removeClass('d-none');
                $('#image_file').prop('required', false);
                imageModal.show();
            });

            let imageIdToDelete = null;
            const deleteModal = new bootstrap.Modal(document.getElementById('delete-confirm-modal'));

            $('#gallery-table tbody').on('click', '.delete-btn', function() {
                imageIdToDelete = $(this).data('id');
                $('#image-name-to-delete').text($(this).data('name'));
                deleteModal.show();
            });

            $('#confirm-delete-btn').on('click', function() {
                if (imageIdToDelete) {
                    $.ajax({
                        type: 'POST', url: '../php/api/gallery.php', data: { action: 'delete', id: imageIdToDelete }, dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                showToast(response.message, 'success');
                                table.ajax.reload();
                            } else {
                                showToast(response.message, 'danger');
                            }
                        },
                        error: function() { showToast('An unexpected error occurred.', 'danger'); },
                        complete: function() { deleteModal.hide(); imageIdToDelete = null; }
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
