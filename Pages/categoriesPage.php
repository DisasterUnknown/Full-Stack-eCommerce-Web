<?php
$title = "View Product Page";
$scriptIndex = "/WebProject/JavaScript/index.js";
$scriptPage = "/WebProject/JavaScript/categoriesPage.js";

$content = <<<HTML
    <div class="space-y-4 min-h-[calc(100vh-92px)]" id="categoriesPage">
        <p class="text-2xl font-bold text-center mt-8 mb-10">Product Galary</p>
        <div id="productSections" class="flex flex-row flex-wrap justify-evenly mt-8">
            <!-- Page Data -->
        </div>
    </div>

    <!-- Backend replay section -->
    <div class="hidden" id="compleateResponce">null1</div>
    <div class="hidden" id="responce">null</div>
HTML;
include 'Components/layout.php';
?>