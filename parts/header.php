<?php
session_start();
?>
<header>
    <nav class="navbar">
        <a href="#header"><img src="images/BTS_Logo.png" class="nav-branding"/></a>
        <ul class="nav-menu">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="index.php#about_us" class="nav-link">About BTS</a></li>
            <li class="nav-item"><a href="members.php" class="nav-link">Members</a></li>
            <li class="nav-item"><a href="faq.php" class="nav-link">Q&A</a></li>
            <li class="nav-item"><a href="#top" class="nav-link">Top</a></li>
            <li class="nav-item"><a href="discography.php" class="nav-link">Discography</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a href="#" class="nav-link"><?php echo $_SESSION['status'] . " #" . $_SESSION['user_id']; ?></a></li>
                <li class="nav-item"><a href="functions/logout.php" class="nav-link">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a href="register_form.php" class="nav-link">Register/Login</a></li>
            <?php endif; ?>
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
</header>
