<?php
$title = "View Users";
$scriptIndex = "/WebProject/JavaScript/index.js";
$scriptPage = "/WebProject/JavaScript/viewUsers.js";

$content = <<<HTML
    <div class="space-y-4 min-h-[calc(100vh-92px)]" id="viewUsersPage">
        <p class="text-2xl font-bold text-center mt-8 mb-10">View Users</p>
        <div id="userSections" class="flex flex-row flex-wrap justify-center items-center mt-8 gap-4">
            <!-- Page Data -->
        </div>
    </div>

    <!-- Backend replay section -->
    <div class="hidden" id="compleateResponce">null1</div>
    <div class="hidden" id="responce">null</div>
HTML;
include 'Components/layout.php';
?>