<?php
$title = "Home Page";
$scriptIndex = "/WebProject/JavaScript/index.js";
$scriptPage = "/WebProject/JavaScript/viewProductDetails.js";

$content = <<<HTML
    <div class="space-y-4" id="viewProductDetails">
        <div class="mx-auto">
            <p id="productName" class="text-2xl text-center font-bold text-white my-5">Product Name</p>
            <div class="flex flex-col md:flex-row">
                <div id="mainImg" class="border w-[90%] md:w-[20%] lg:w-[20%] xl:w-[15%] aspect-w-16 h-[300px] md:h-[250px] xl:h-[280px] mx-auto md:mx-1 rounded-2xl bg-cover bg-center" style="background-image: url('../assets/collectebils1.avif')"></div>
                <div class="border w-[90%] md:w-[50%] px-3 py-2 mt-10 ml-10 md:mt-0 rounded-xl">
                    <div id="priceDiv">
                        <p>Price: </p>
                    </div>
                    <div id="discountDiv">
                        <p>Discount: </p>
                    </div>
                    <button id="productActionBtn"></button>
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