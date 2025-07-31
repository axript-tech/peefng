 
<?php
// ------------------------------------------------------
// PEEF Platform - Member Registration Processing Script
// ------------------------------------------------------
// This script handles the server-side logic for new
// member registration. It validates all inputs, processes
// file uploads, and securely inserts data into the database.
// ------------------------------------------------------

// Include all necessary core files.
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/session.php'; // This also starts the session.

// Check if the form was submitted via the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Form Data Collection & Sanitization ---
    // Using an array to hold all sanitized POST data.
    $formData = [];
    $requiredFields = ['title', 'first_name', 'surname', 'dob', 'nationality', 'email', 'phone', 'job_title', 'organisation', 'address', 'experience', 'sector', 'discipline_primary', 'password', 'confirm_password', 'agreement'];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error_message'] = "Please fill in all required fields.";
            redirect('/members.php'); // Redirect back to the form
        }
    }
    
    // Sanitize all POST data
    foreach ($_POST as $key => $value) {
        if ($key !== 'password' && $key !== 'confirm_password') {
            $formData[$key] = sanitize_input($value);
        } else {
            $formData[$key] = $value; // Don't sanitize passwords
        }
    }

    // --- 2. Validation ---
    if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid email format.";
        redirect('/members.php');
    }

    if ($formData['password'] !== $formData['confirm_password']) {
        $_SESSION['error_message'] = "Passwords do not match.";
        redirect('/members.php');
    }

    if (strlen($formData['password']) < 8) {
        $_SESSION['error_message'] = "Password must be at least 8 characters long.";
        redirect('/members.php');
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$formData['email']]);
    if ($stmt->fetch()) {
        $_SESSION['error_message'] = "An account with this email already exists.";
        redirect('/members.php');
    }

    // --- 3. File Upload Handling ---
    $uploadDir = __DIR__ . '/../../uploads/';
    $cvPath = null;
    $passportPath = null;
    $paymentPath = null;

    // A helper function for handling file uploads
    function handle_upload($file, $uploadDir, $prefix) {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileName = $prefix . '_' . time() . '_' . basename($file['name']);
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return 'uploads/' . $fileName; // Return relative path for DB
            }
        }
        return null;
    }

    $cvPath = handle_upload($_FILES['cv'], $uploadDir . 'cvs/', 'cv');
    $passportPath = handle_upload($_FILES['passport'], $uploadDir . 'passports/', 'passport');
    $paymentPath = handle_upload($_FILES['payment_evidence'], $uploadDir . 'payments/', 'payment');

    if (empty($cvPath) || empty($passportPath)) {
        $_SESSION['error_message'] = "CV/Resume and Passport Photograph are required.";
        redirect('/members.php');
    }

    // --- 4. Database Insertion ---
    try {
        $pdo->beginTransaction();

        // Insert into `users` table
        $sqlUsers = "INSERT INTO users (title, first_name, middle_name, surname, full_name, email, official_email, password, phone_number, date_of_birth, nationality, address, role) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Member')";
        
        $fullName = trim($formData['first_name'] . ' ' . $formData['middle_name'] . ' ' . $formData['surname']);
        $hashedPassword = hash_password($formData['password']);

        $stmtUsers = $pdo->prepare($sqlUsers);
        $stmtUsers->execute([
            $formData['title'],
            $formData['first_name'],
            $formData['middle_name'],
            $formData['surname'],
            $fullName,
            $formData['email'],
            $formData['official_email'],
            $hashedPassword,
            $formData['phone'],
            $formData['dob'],
            $formData['nationality'],
            $formData['address']
        ]);

        $userId = $pdo->lastInsertId();

        // Insert into `user_professional_details` table
        $sqlDetails = "INSERT INTO user_professional_details (user_id, job_title, organisation, experience_years, sector, discipline_primary, discipline_secondary, professional_membership, membership_grade, cv_path, passport_photo_path, payment_evidence_path) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmtDetails = $pdo->prepare($sqlDetails);
        $stmtDetails->execute([
            $userId,
            $formData['job_title'],
            $formData['organisation'],
            $formData['experience'],
            $formData['sector'],
            $formData['discipline_primary'],
            $formData['discipline_secondary'],
            $formData['prof_membership'],
            $formData['membership_grade'],
            $cvPath,
            $passportPath,
            $paymentPath
        ]);

        $pdo->commit();

        // --- 5. Success Redirect ---
        $_SESSION['success_message'] = "Registration successful! You can now log in.";
        redirect('/login.php');

    } catch (PDOException $e) {
        $pdo->rollBack();
        // In production, log the error instead of displaying it.
        $_SESSION['error_message'] = "A database error occurred during registration. Please try again. " . $e->getMessage();
        // error_log($e->getMessage());
        redirect('/members.php');
    }

} else {
    // Redirect if accessed directly
    redirect('/index.php');
}
?>
