<?php
$title = "Home Page";
$scriptIndex = "/WebProject/JavaScript/index.js";
// $scriptPage = "/WebProject/JavaScript/checkOutPage.js";

$content = <<<HTML
    <div class="flex flex-col items-center justify-center space-y-4 min-h-[calc(80vh)]">
        <p class="text-2xl mb-5 mt-8 font-bold">Complete Your Purchase</p>
        <div class="flex w-[100%] sm:w-auto items-center justify-center " id="checkOutPage">        
            <Form class="flex flex-col bg-white bg-opacity-5 backdrop-blur-lg p-8 w-[100%] sm:w-[350px] shadow-lg rounded-xl shadow-lg hover:scale-101 hover:shadow-[0_0_15px_2px_rgba(100,100,255,0.8)] transition-colors duration-500">
                <div class="flex flex-row justify-between mb-2">
                    <input type="text" placeholder="Full&nbsp;Name:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="fullNameIN">
                </div>
                <div class="flex flex-row justify-between mb-2">
                    <input type="email" placeholder="Email&nbsp;Address:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="emailIN">
                </div>
                <div class="flex flex-row justify-between mb-2">
                    <input type="tel" placeholder="Phone&nbsp;Number:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="telIN">
                </div>
                <div class="flex flex-row justify-between mb-2">
                    <input type="text" placeholder="Address:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="addressIN">
                </div>
                <div class="flex flex-row justify-between mb-2">
                    <input type="text" placeholder="Shipping&nbsp;Method:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="addressIN">
                </div>
                <div class="flex flex-row justify-between mb-2">
                    <input type="text" placeholder="Cardholder&nbsp;Name:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="cardHolderNameIN">
                </div>
                <div class="flex flex-row justify-between mb-2">
                    <input type="text" placeholder="Card&nbsp;Number:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="cardNumberIN">
                </div>
                <div class="flex flex-row justify-between mb-2">
                    <input type="text" placeholder="CVC:"
                            class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                            id="cvcIN">
                </div>

                <div class="mx-auto">
                    <button class="border font-bold py-1 px-4 mt-5 rounded-xl hover:scale-101 hover:bg-white/10 hover:shadow-[0_0_15px_2px_rgba(100,100,255,0.8)] transition-colors duration-500">Check Out</button>
                </div>
            </Form>
        </div>
    </div>

    <!-- Backend replay section -->
    <div class="hidden" id="compleateResponce">null1</div>
    <div class="hidden" id="responce">null</div>
HTML;
include 'Components/layout.php';
?>