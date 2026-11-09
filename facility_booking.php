<?php
session_start();
require_once 'config.php';

$user_id = $_SESSION['user_id'] ?? null;
$name = $_SESSION['name'] ?? null;

// Handle Form Submission with Lahiruni's Validation Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_booking'])) {
    if (!$user_id) {
        $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'Please login to submit a facility booking!'];
        header('Location: facility_booking.php');
        exit();
    }
