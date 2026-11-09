<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedules & Matches - NSBM SportsHub</title>
    <link rel="stylesheet" href="style.css?v=9.6">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="profile-page-body">

    <!-- HEADER -->
    <header>
        <a href="index.php" class="logo">
            <img src="logo2.png" alt="Logo">
        </a>
        <nav>
            <a href="index.php">Home</a>
            <a href="sports_clubs.php">Sports Clubs</a>
            <a href="schedules.php" style="color: #0abf30;">Schedules & Matches</a>
            <a href="facility_booking.php">Facility Bookings</a>
        </nav>
        <div class="user-auth">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="profile-box">
                    <div class="avatar-circle"><?= strtoupper($_SESSION['name'][0] ?? 'U') ?></div>
                    <div class="dropdown">
                        <a href="profile.php">My Account</a>
                        <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                            <a href="admin.php">Admin Panel</a>
                        <?php endif; ?>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <button class="login-btn-modal">Login</button>
            <?php endif; ?>
        </div>
    </header>