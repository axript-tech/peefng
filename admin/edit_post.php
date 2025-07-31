<?php
// require_once __DIR__ . '/../php/includes/db_connect.php';
// require_once __DIR__ . '/../php/includes/functions.php';
// require_once __DIR__ . '/../php/includes/session.php';

// // Secure this page
// if (!is_admin_logged_in()) {
//     redirect('index.php');
// }

// // Initialize variables
// $post = ['id' => '', 'title' => '', 'content' => '', 'category_id' => '', 'status' => 'Draft', 'featured_image' => ''];
// $page_title = 'Add New Post';
// $is_editing = false;

// // Check if an ID is provided for editing
// if (isset($_GET['id'])) {
//     $is_editing = true;
//     $post_id = $_GET['id'];
//     $page_title = 'Edit Post';

//     try {
//         $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
//         $stmt->execute([$post_id]);
//         $post = $stmt->fetch();
//         if (!$post) {
//             // Post not found, redirect or show error
//             redirect('manage_blog.php');
//         }
//     } catch (PDOException $e) {
//         // Handle error
//         die("Error fetching post: " . $e->getMessage());
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php // echo $page_title; ?> - Admin Dashboard - PEEF</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Quicksand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

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
        
        /* CKEditor Styling */
        .ck-editor__editable_inline {
            min-height: 350px;
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
                <a href="manage_members.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-users text-center" style="width: 24px;"></i><span class="ms-3">Members</span>
                </a>
                <a href="manage_events.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-calendar-check text-center" style="width: 24px;"></i><span class="ms-3">Events</span>
                </a>
                <a href="manage_donations.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-hand-holding-dollar text-center" style="width: 24px;"></i><span class="ms-3">Donations</span>
                </a>
                <a href="manage_blog.php" class="sidebar-link active d-flex align-items-center p-3">
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
                <h1 class="h2 font-bold text-brand-dark mb-0 d-none d-lg-block">Add New Post</h1>
                <div class="d-flex align-items-center">
                    <span class="d-none d-sm-inline me-3">Welcome, <strong>Admin User</strong></span>
                    <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=2670&auto=format&fit=crop" alt="Admin" class="rounded-circle object-cover" style="width: 40px; height: 40px;">
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-grow-1 p-4 p-sm-5">
                <div class="container-fluid">
                    <div id="form-message" class="mb-4"></div>
                    <form id="post-form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="post_id" value="<?php // echo htmlspecialchars($post['id']); ?>">
                        <div class="row g-4">
                            <!-- Main Content Area -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <label for="post-title" class="form-label fs-5 fw-bold">Post Title</label>
                                            <input type="text" class="form-control form-control-lg" id="post-title" name="title" value="<?php // echo htmlspecialchars($post['title']); ?>" required>
                                        </div>
                                        <div>
                                            <label for="post-content" class="form-label fs-5 fw-bold">Content</label>
                                            <textarea id="post-content" name="content"><?php // echo htmlspecialchars($post['content']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar for Settings -->
                            <div class="col-lg-4">
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light fw-bold">Publish</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="Draft" <?php // if ($post['status'] == 'Draft') echo 'selected'; ?>>Draft</option>
                                                <option value="Published" <?php // if ($post['status'] == 'Published') echo 'selected'; ?>>Published</option>
                                            </select>
                                        </div>
                                        <button type="submit" id="submit-btn" name="save_post" class="btn btn-primary w-100 d-flex align-items-center justify-content-center" style="background-color: var(--brand-green); border-color: var(--brand-green);">
                                            <span class="btn-text">Save Post</span>
                                            <i class="fas fa-spinner spinner ms-2 d-none"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card shadow-sm border-0">
                                    <div class="card-header bg-light fw-bold">Post Settings</div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select" id="category" name="category_id">
                                                <option value="1">Workforce Development</option>
                                                <option value="2">Technology</option>
                                                <option value="3">Announcements</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="featured-image" class="form-label">Featured Image</label>
                                            <input class="form-control" type="file" id="featured-image" name="featured_image">
                                            <?php // if (!empty($post['featured_image'])): ?>
                                                <img src="../<?php // echo htmlspecialchars($post['featured_image']); ?>" alt="Featured Image" class="img-fluid rounded mt-3">
                                            <?php // endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                <a href="manage_members.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-users text-center" style="width: 24px;"></i><span class="ms-3">Members</span>
                </a>
                <a href="manage_events.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-calendar-check text-center" style="width: 24px;"></i><span class="ms-3">Events</span>
                </a>
                <a href="manage_donations.php" class="sidebar-link d-flex align-items-center p-3">
                    <i class="fas fa-hand-holding-dollar text-center" style="width: 24px;"></i><span class="ms-3">Donations</span>
                </a>
                <a href="manage_blog.php" class="sidebar-link active d-flex align-items-center p-3">
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
        let editor;
        ClassicEditor
            .create( document.querySelector( '#post-content' ) )
            .then( newEditor => {
                editor = newEditor;
            } )
            .catch( error => {
                console.error( error );
            } );

        $(document).ready(function() {
            $('#post-form').on('submit', function(e) {
                e.preventDefault();
                
                // Update the textarea with the editor's content
                const editorData = editor.getData();
                $('#post-content').val(editorData);

                const $form = $(this);
                const $button = $('#submit-btn');
                const $btnText = $button.find('.btn-text');
                const $spinner = $button.find('.spinner');
                const $formMessage = $('#form-message');
                
                $btnText.text('Saving...');
                $spinner.removeClass('d-none');
                $button.prop('disabled', true);
                $formMessage.html('');

                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'process_post.php',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            $formMessage.html('<div class="alert alert-success">' + response.message + '</div>');
                            // Optionally redirect after a short delay
                            setTimeout(function() {
                                window.location.href = 'manage_blog.php';
                            }, 2000);
                        } else {
                            $formMessage.html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $formMessage.html('<div class="alert alert-danger">An unexpected error occurred.</div>');
                    },
                    complete: function() {
                        $btnText.text('Save Post');
                        $spinner.addClass('d-none');
                        $button.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
