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

     $facility_name = trim($_POST['facility_name'] ?? '');
    $booking_date  = trim($_POST['booking_date'] ?? '');
    $time_slot     = trim($_POST['time_slot'] ?? '');
    $purpose       = trim($_POST['purpose'] ?? '');

    // List of ALL 12 Campus Sports & Gear Facilities
    $allowed_facilities = [
        'Athletics Track & Field Grid',
        'Badminton Court A (Indoor)',
        'Badminton Court B (Indoor)',
        'Chess Gear Set & Board',
        'Main Cricket Pitch & Nets',
        'Martial Arts Dojo Room',
        'Netball Court (Outdoor)',
        'Powerlifting Gym Section',
        'Rugby Training Ground',
        'Swimming Pool (Lap Lanes)',
        'Table Tennis Gear & Arena',
        'Tennis Court A (Outdoor)',
        'Volleyball Court'
    ];
     $allowed_slots = [
        '08:00 - 10:00',
        '10:00 - 12:00',
        '12:00 - 14:00',
        '14:00 - 16:00',
        '16:00 - 18:00',
        '18:00 - 20:00'
    ];

    // 1. Validation Checks
    if (!in_array($facility_name, $allowed_facilities, true) || 
        !in_array($time_slot, $allowed_slots, true) || 
        empty($booking_date) || empty($purpose)) {
        $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'Please fill in all fields with valid options!'];
    } elseif ($booking_date < date('Y-m-d')) {
        $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'Booking date cannot be in the past!'];
    } else {
        // 2. Lahiruni's Double-Booking Check
        $check = $conn->prepare("
            SELECT id FROM facility_bookings 
            WHERE facility_name = ? AND booking_date = ? AND time_slot = ? 
            AND status IN ('pending', 'approved')
        ");
        $check->bind_param("sss", $facility_name, $booking_date, $time_slot);
        $check->execute();

         if ($check->get_result()->num_rows > 0) {
            $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'That facility is already reserved for the selected date and time slot!'];
        } else {
            // 3. Insert Booking Request
            $stmt = $conn->prepare("
                INSERT INTO facility_bookings (user_id, facility_name, booking_date, time_slot, purpose, status) 
                VALUES (?, ?, ?, ?, ?, 'pending')
            ");
            $stmt->bind_param("issss", $user_id, $facility_name, $booking_date, $time_slot, $purpose);
            
            if ($stmt->execute()) {
                $_SESSION['alerts'][] = ['type' => 'success', 'message' => 'Booking request submitted! Waiting for admin approval.'];
            } else {
                $_SESSION['alerts'][] = ['type' => 'error', 'message' => 'Failed to process request. Please try again.'];
            }
        }
    }
