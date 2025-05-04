<?php
$title = "View Product Page";
$scriptIndex = "/WebProject/JavaScript/index.js";
// $scriptPage = "/WebProject/JavaScript/categoriesPage.js";

$content = <<<HTML
    <div class="space-y-4 min-h-[calc(100vh-92px)]" id="categoriesPage">
        <p class="text-2xl font-bold text-center mt-8 mb-10">View Users</p>
        <div id="userSections" class="flex flex-row flex-wrap justify-evenly mt-8">
            <!-- Page Data -->
            <!-- <div class="flex flex-col md:flex-row items-center justify-between py-5 mb-5 md:mb-1 bg-blue-600/10 w-90% xl:w-[80%] rounded-xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                <p id="userIdContainer" class="hidden"></p>
                <div class="flex flex-row items-center justify-between px-10 lx:px-5 md:pl-10 py-1">
                    <img src="/WebProject/assets/uploadImg.webp" alt="PFP" class="aspect-square w-[13%] md:w-[5%] rounded-full">
                    <p class="font-semibold">Name</p>
                    <p class="font-semibold hidden md:block">Email</p>
                    <p class="font-semibold">Role</p>
                </div>
                <div class="flex mt-5 md:mt-0 mx-5 w-[100%] md:w-[10%] justify-center">
                    <button class="border w-[30%] md:w-[100%] xl:px-5 py-1 rounded-xl hover:bg-white/5 hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(0,0,255,0.8)] transition-transform duration-300">Kick</button>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Backend replay section -->
    <div class="hidden" id="compleateResponce">null1</div>
    <div class="hidden" id="responce">null</div>
HTML;
include 'Components/layout.php';
?>