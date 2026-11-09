<?php

session_start();
require_once 'config.php';

function getNsbmRole($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (str_ends_with($email, '@nsbm.ac.lk')) {
            return 'admin';
        }
        if (str_ends_with($email, '@students.nsbm.ac.lk')) {
            return 'student';
        }
    }
    return null;
}

if (isset($_POST['register_btn'])) {
    $name     = trim($_POST['name']);
    $email    = strtolower(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $assigned_role = getNsbmRole($email);
 if (!$assigned_role) {
        $_SESSION['alerts'][] = [
            'type' => 'error',
            'message' => 'Registration allowed only with official NSBM emails (@students.nsbm.ac.lk or @nsbm.ac.lk)!'
        ];
        $_SESSION['active_form'] = 'register';
        header('Location: index.php');
        exit();
    }
