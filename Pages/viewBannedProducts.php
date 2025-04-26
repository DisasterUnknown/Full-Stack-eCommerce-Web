<?php
$title = "View Product Page";
$scriptIndex = "/WebProject/JavaScript/index.js";
// $scriptPage = "/WebProject/JavaScript/viewBannedProducts.js";

$content = <<<HTML
    <div class="space-y-4 min-h-[calc(100vh-92px)]" id="viewBannedProducts">
        <p class="text-2xl font-bold text-center mt-8 mb-10">Banned Products</p>
        <div id="BanProducts" class="flex flex-row flex-wrap justify-evenly mt-8">
            <div class="relative border mb-3 mt-4 mx-2 h-40 md:h-60 lg:h-80 w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300"> 
                <div id="banProductId" class="hidden">null</div>    
                <img src="../assets/art1.jpg" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                <div class="relative z-10 w-full h-full flex flex-col items-center justify-center">
                    <span class="text-lg text-center font-bold text-white">Product Name</span>
                    <span class="text-lg mt-[9%] font-bold text-white">Art</span>
                    <button class="border bg-white/10 hover:bg-green-500/30 px-4 py-1 mt-[10%] font-semibold rounded-full">Restore</button>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Backend replay section -->
    <div class="" id="compleateResponce">null1</div>
    <div class="" id="responce">null</div>
HTML;
include 'Components/layout.php';
?>