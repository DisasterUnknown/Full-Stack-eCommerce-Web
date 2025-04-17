<?php
$title = "Home Page";
$scriptIndex = "JavaScript/index.js";
$scriptPage = "JavaScript/home.js";
$content = <<<HTML
    <div class="space-y-4" id="homePage">
        <!-- Advertisment Section -->
        <div>
            <p class="text-2xl text-center font-bold text-white mt-5 mb-8">Sponsored Spotlight!</p>
            <div class="border rounded-2xl w-[90%] md:w-[80%] mx-auto">
                <img src="assets/banner1.png" alt="" class="rounded-2xl">
            </div>
        </div>

        <!-- Art display section -->
        <div>
            <p class="text-2xl text-center font-bold text-white mt-10 lg:mt-20">Art</p>
            <div class="flex justify-evenly mt-8">
                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="artSection1ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="artSectionImg1"></div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="artSectionName1">Metal Art</span>
                        <p>Price:- Rs. <span id="artSectionPrice1">10,000</span></p>
                    </div>
                </div>

                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hidden md:block hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="artSection2ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="artSectionImg2">    
                        <!-- <img src="assets/temp1.jpg" alt="" id="artSectionImg2" class="object-cover rounded-2xl w-full h-full"> -->
                    </div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="artSectionName2">Metal Art</span>
                        <p>Price:- Rs. <span id="artSectionPrice2">10,000</span></p>
                    </div>
                </div>

                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hidden lg:block hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="artSection3ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="artSectionImg3">    
                        <!-- <img src="assets/temp1.jpg" alt="" id="artSectionImg3" class="object-cover rounded-2xl w-full h-full"> -->
                    </div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="artSectionName3">Metal Art</span>
                        <p>Price:- Rs. <span id="artSectionPrice3">10,000</span></p>
                    </div>
                </div>

                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hidden xl:block hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="artSection4ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="artSectionImg4">    
                        <!-- <img src="assets/temp1.jpg" alt="" id="artSectionImg4" class="object-cover rounded-2xl w-full h-full"> -->
                    </div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="artSectionName4">Metal Art</span>
                        <p>Price:- Rs. <span id="artSectionPrice4">10,000</span></p>
                    </div>
                </div>

                <div class="relative border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
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
            <div class="flex justify-evenly mt-8">
                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="collectiblesSection1ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="collectiblesSectionImg1">    
                        <!-- <img src="assets/temp1.jpg" alt="" id="collectiblesSectionImg1" class="object-cover rounded-2xl w-full h-full"> -->
                    </div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="collectiblesSectionName1">Metal Art</span>
                        <p>Price:- Rs. <span id="collectiblesSectionPrice1">10,000</span></p>
                    </div>
                </div>

                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hidden md:block hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="collectiblesSection2ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="collectiblesSectionImg2">    
                        <!-- <img src="assets/temp1.jpg" alt="" id="collectiblesSectionImg2" class="object-cover rounded-2xl w-full h-full"> -->
                    </div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="collectiblesSectionName2">Metal Art</span>
                        <p>Price:- Rs. <span id="collectiblesSectionPrice2">10,000</span></p>
                    </div>
                </div>

                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hidden lg:block hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="collectiblesSection3ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="collectiblesSectionImg3">    
                        <!-- <img src="assets/temp1.jpg" alt="" id="collectiblesSectionImg3" class="object-cover rounded-2xl w-full h-full"> -->
                    </div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="collectiblesSectionName3">Metal Art</span>
                        <p>Price:- Rs. <span id="collectiblesSectionPrice3">10,000</span></p>
                    </div>
                </div>

                <div class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hidden xl:block hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="collectiblesSection4ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="collectiblesSectionImg4">    
                        <!-- <img src="assets/temp1.jpg" alt="" id="collectiblesSectionImg4" class="object-cover rounded-2xl w-full h-full"> -->
                    </div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="collectiblesSectionName4">Metal Art</span>
                        <p>Price:- Rs. <span id="collectiblesSectionPrice4">10,000</span></p>
                    </div>
                </div>

                <div class="relative border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
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