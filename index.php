<?php
$title = "Home Page";
$scriptIndex = "JavaScript/index.js";
$scriptPage = "JavaScript/home.js";
$content = <<<HTML
    <div class="space-y-4" id="homePage">
        <!-- Advertisment Section (TODO if there is extra time) -->
        <!-- <div>
            <p class="text-2xl text-center font-bold text-white mt-5 mb-8">Sponsored Spotlight!</p>
            <div class="border rounded-2xl w-[90%] md:w-[80%] mx-auto">
                <img src="assets/banner1.png" alt="" class="rounded-2xl">
            </div>
        </div> -->

        <!-- Art display section -->
        <div>
            <p class="text-2xl text-center font-bold text-white mt-20 lg:mt-5">Art</p>
            <div id="artIndexDisplaySection" class="flex justify-evenly mt-8">
                <!-- Art Cards Section -->
                <div id="artCategory" class="relative border h-[150px] md:h-[200px] xl:h-[225px] w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300"> 
                    <img src="assets/art1.jpg" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                    <div class="relative z-10 w-full h-full flex items-center justify-center">
                        <span class="text-lg font-bold text-white">View All</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Collectibles display section -->
        <div>
            <p class="text-2xl text-center font-bold text-white mt-10 lg:mt-20">Collectibles</p>
            <div id="collectiblesIndexDisplaySection" class="flex justify-evenly mt-8">
                <!-- Collectebles Cards Section -->
                <div id="collectablesCategory" class="relative border h-[150px] md:h-[200px] xl:h-[225px] w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">  
                    <img src="assets/collectebils1.avif" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                    <div class="relative z-10 w-full h-full flex items-center justify-center">
                        <span class="text-lg font-bold text-white">View All</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Backend replay section -->
    <div class="hidden" id="compleateResponce">null</div>
    <div class="hidden" id="responce">null</div>
HTML;
include 'Components/layout.php';
?>