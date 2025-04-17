<?php
$title = "Home Page";
$content = <<<HTML
    <div class="space-y-4">
        <!-- Advertisment Section -->
        <div class="pb-10">
            <p class="text-2xl text-center font-bold text-white mt-5 mb-8">Sponsored Spotlight!</p>
            <div class="border rounded-2xl w-[90%] md:w-[80%] mx-auto">
                <img src="assets/banner1.png" alt="" class="rounded-2xl">
            </div>
        </div>

        <!-- Art display section -->
        <div>
            <p class="text-2xl text-center font-bold text-white mt-15">Art</p>
            <div class="flex justify-evenly mt-8">
                <div class="border p-20 rounded">1</div>
                <div class="border p-20 rounded hidden md:block">2</div>
                <div class="border p-20 rounded hidden lg:block">3</div>
                <div class="border p-20 rounded hidden">4</div>
                <div class="border p-20 rounded hidden">5</div>
                <div class="border p-20 rounded">6</div>
            </div>
        </div>

        <!-- Collectibles display section -->
        <!-- <div>
            <p class="text-2xl text-center font-bold text-white mt-15">Collectibles</p>
            <div class="flex justify-between ml-20 mr-20 mt-8">
                <div class="border p-20 rounded"></div>
                <div class="border p-20 rounded"></div>
                <div class="border p-20 rounded"></div>
                <div class="border p-20 rounded"></div>
                <div class="border p-20 rounded"></div>
                <div class="border p-20 rounded"></div>
            </div>
        </div> -->
    </div>
HTML;
include 'Components/layout.php';
?>