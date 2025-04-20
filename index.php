<?php
$title = "Home Page";
$scriptIndex = "JavaScript/index.js";
$scriptPage = "JavaScript/home.js";

// Creating Art Section Cards 
$artCards = "";
for ($i = 1; $i < 5; $i++) {
    $visibility = "";
    if ($i == 2) $visibility = "hidden md:block";
    elseif ($i == 3) $visibility = "hidden lg:block";
    elseif ($i == 4) $visibility = "hidden xl:block";

    $artCards .= <<<HTML
        <div id="artCard{$i}" class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl {$visibility} hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
            <div id="artSection{$i}ProductID" class="hidden"></div>
            <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="artSectionImg{$i}"></div>
            <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                <span id="artSectionName{$i}">Metal Art</span>
                <p>Price:- Rs. <span id="artSectionPrice{$i}">10,000</span></p>
            </div>
        </div>
    HTML;
}

// Creating Collectebles Section Cards 
$collecteblesCards = "";
for ($i = 1; $i < 5; $i++) {
    $visibility = "";
    if ($i == 2) $visibility = "hidden md:block";
    elseif ($i == 3) $visibility = "hidden lg:block";
    elseif ($i == 4) $visibility = "hidden xl:block";

    $collecteblesCards .= <<<HTML
        <div id="collecteblesCard{$i}" class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl {$visibility} hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
            <div id="collectiblesSection{$i}ProductID" class="hidden"></div>
            <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="collectiblesSectionImg{$i}"></div>
            <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                <span id="collectiblesSectionName{$i}">Metal Art</span>
                <p>Price:- Rs. <span id="collectiblesSectionPrice{$i}">10,000</span></p>
            </div>
        </div>
    HTML;
}


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
            <div class="flex justify-evenly mt-8">
                $artCards
                <div class="relative border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <a href="">    
                        <img src="assets/art1.jpg" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                        <div class="relative z-10 w-full h-full flex items-center justify-center">
                            <span class="text-lg font-bold text-white">View All</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Collectibles display section -->
        <div>
            <p class="text-2xl text-center font-bold text-white mt-10 lg:mt-20">Collectibles</p>
            <div class="flex justify-evenly mt-8">
                $collecteblesCards
                <div class="relative border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <a href="">    
                        <img src="assets/collectebils1.avif" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                        <div class="relative z-10 w-full h-full flex items-center justify-center">
                            <span class="text-lg font-bold text-white">View All</span>
                        </div>
                    </a>
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