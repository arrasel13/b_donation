<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
<!--                    <div class="sb-sidenav-menu-heading">Core</div>-->
                    <a class="nav-link" href="admin.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <?php if ($_SESSION['userrole'] == 1): ?>
                    <a class="nav-link" href="blood_group.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-droplet"></i></div>
                        Blood Group
                    </a>
                    <a class="nav-link" href="doner_list.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-droplet"></i></div>
                        Blood Doner List
                    </a>
                    <?php endif; ?>

                    <a class="nav-link" href="donation_history.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-droplet"></i></div>
                        All Donation Record
                    </a>
                    <a class="nav-link" href="doner_details.php?id=<?= $_SESSION['userid'] ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-eye"></i></div>
                        View Profile
                    </a>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php echo $_SESSION['username']; ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">