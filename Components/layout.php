<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'Page' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
    <script defer src=<?= $scriptPage ?>></script>
</body>

</html>