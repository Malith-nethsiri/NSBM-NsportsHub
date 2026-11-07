<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Clubs - NSBM SportsHub</title>
    <link rel="stylesheet" href="style.css?v=9.9">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <a href="index.php" class="logo">
            <img src="logo2.png" alt="Logo">
        </a>
        <nav>
            <a href="index.php">Home</a>
            <a href="sports_clubs.php" style="color: #0abf30;">Sports Clubs</a>
            <a href="schedules.php">Schedules & Matches</a>
            <a href="facility_booking.php">Facility Bookings</a>
        </nav>
        <div class="user-auth">
            <?php if (!empty($name)): ?>
            <div class="profile-box">
                <div class="avatar-circle"><?= strtoupper($name[0]) ?></div>
                <div class="dropdown">
                    <a href="profile.php">My account</a>
                    <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                        <a href="admin.php">Admin Panel</a>
                    <?php endif; ?>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <?php else: ?>
            <button type="button" class="login-btn-modal">Login</button>
            <?php endif; ?>
        </div>
    </header>

    <section class="clubs-hero">
        <h1>Sports Clubs</h1>
        <p>Find your sport, send a request to join, and wait for approval from the club.</p>
    </section>

    <main class="clubs-main">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search for a sport...">
            <i class="bx bx-search"></i>
        </div>

        <div class="sports-grid" id="sportsGrid">
            <?php foreach ($clubs as $club): ?>
                <?php 
                    $status = $my_requests[$club['club_name']] ?? null; 
                    $card_img = !empty($club['image']) ? $club['image'] : 'background.jpg';
                ?>
                <div class="sport-card" 
                     data-name="<?= htmlspecialchars(strtolower($club['club_name'])) ?>"
                     style="background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url('<?= htmlspecialchars($card_img) ?>') no-repeat center center/cover;">
                    <i class="bx <?= htmlspecialchars($club['icon']) ?> sport-icon"></i>
                    <h3><?= htmlspecialchars($club['club_name']) ?></h3>
                    <p><?= htmlspecialchars($club['description']) ?></p>

                    <?php if ($status): ?>
                        <span class="badge <?= $status ?>"><?= $status ?></span>
                    <?php endif; ?>

                    <?php if (!$status || $status === 'rejected'): ?>
                        <button type="button" class="select-btn" data-club="<?= htmlspecialchars($club['club_name']) ?>">Select</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="no-results" id="noResults">No sports found. Try another name.</p>

        <div class="join-section" id="join-form">
            <h2>Request to Join</h2>
            <p class="note">
                <?= $user_id ? 'Choose a sport and send your request.' : 'Please login to send a request.' ?>
            </p>
            <form action="sports_clubs.php" method="POST">
                <label for="club_name">Sport</label>
                <select name="club_name" id="club_name" required>
                    <option value="">Choose a sport</option>
                    <?php foreach ($clubs as $club): ?>
                        <option value="<?= htmlspecialchars($club['club_name']) ?>"><?= htmlspecialchars($club['club_name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="join_btn" class="join-btn">Request to Join</button>
            </form>
        </div>

<!-- Comment -->
