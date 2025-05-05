<?php
$role = $_SESSION['RoleID'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'Page' ?></title>

    <!-- Google Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="/WebProject/css/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#01002e] to-black text-white">

    <!-- Hamburger Icon (mobile only) -->


    <!-- Calling the sidebar -->
    <?php include 'Includes/sidebar.php'; ?>

    <!-- Adding the Mobile menu -->
    <?php include 'Includes/mobilemenu.php'; ?>

    <!-- Main body content -->
    <div id="mainBody" class="md:ml-[75px] mt-16 md:mt-0 min-h-[calc(100vh)]">
        <!-- Top Nav Bar -->
        <?php include 'Includes/topNavBar.php'; ?>

        <!-- Dynamic page content -->
        <div class="md:pt-14 px-4">
            <?= $content ?>
        </div>

        <!-- Footer -->
        <?php include 'Includes/footer.php'; ?>
    </div>


    <script defer src="/WebProject/JavaScript/layout.js"></script>
    <script defer src=<?= $scriptIndex ?>></script>
    <script defer src=<?= isset($scriptPage) ? $scriptPage : "" ?>></script>
</body>

</html>