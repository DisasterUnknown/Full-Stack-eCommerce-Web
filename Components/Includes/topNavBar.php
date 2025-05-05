<div class="flex justify-between bg-blue-900/50 absolute top-0 left-0 w-full z-10 px-2 py-2 md:pl-[75px]">
    <div class="flex">
        <button id="hamburger" class="z-60 md:hidden bg-white/10 p-2 pb-0 rounded">
            <span class="material-symbols-outlined text-white">menu</span>
        </button>
        <a href="/WebProject/index" class="text-xl py-1 px-3 text-white custom-font font-bold">BlueArt</a>
    </div>

    <!-- Customer and Guest view cart -->
    <?php if (!str_starts_with($role, 'SE') && !str_starts_with($role, 'AD')): ?>
        <a href="/WebProject/Pages/cartPage"
            class="border bg-white bg-opacity-5 backdrop-blur-lg py-1 px-3 text-white font-semibold rounded hover:bg-opacity-10">Cart</a>
    <?php endif; ?>

    <!-- Admin View Users -->
    <?php if (str_starts_with($role, 'AD')): ?>
        <a href="/WebProject/Pages/viewUsers"
            class="border bg-white bg-opacity-5 backdrop-blur-lg py-1 px-3 text-white font-semibold rounded hover:bg-opacity-10">View Users</a>
    <?php endif; ?>

    <!-- Seller Add Product -->
    <?php if (str_starts_with($role, 'SE')): ?>
        <a id="topBarAddProducts"
            class="border cursor-pointer bg-white bg-opacity-5 backdrop-blur-lg py-1 px-3 text-white font-semibold rounded hover:bg-opacity-10">Add Product</a>
    <?php endif; ?>
</div>