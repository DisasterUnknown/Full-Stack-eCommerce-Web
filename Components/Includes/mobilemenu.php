<div id="mobileMenu"
    class="absolute top-16 left-4 right-4 bg-black/50 backdrop-blur-md rounded-lg p-5 z-40 md:hidden hidden">
    <ul class="space-y-4">
        <li><a href="/WebProject/index" class="block text-gray-300 hover:text-white transition">Home</a></li>
        
        <!-- Seller Only: Add Product -->
        <?php if (str_starts_with($role, 'SE')): ?>
            <li><a href="/WebProject/Pages/sellerShop" class="block text-gray-300 hover:text-white transition">My Shop</a></li>
            <li><a id="addNewProductNavMobile" class="block cursor-pointer text-gray-300 hover:text-white transition">Add Product</a></li>
        <?php endif; ?>
        
        <!-- Customer Only and Guest: Cart -->
        <?php if (!str_starts_with($role, 'SE') && !str_starts_with($role, 'AD')): ?>
            <li><a href="/WebProject/Pages/cartPage" class="block text-gray-300 hover:text-white transition">My Cart</a></li>
        <?php endif; ?>

        <!-- Admin Only: Banned & Kick Users -->
        <?php if (str_starts_with($role, 'AD')): ?>
            <li><a href="/WebProject/Pages/viewBannedProducts" class="block text-gray-300 hover:text-white transition">Banned Products</a></li>
            <li><a href="/WebProject/Pages/viewKickUsers" class="block text-gray-300 hover:text-white transition">Kick Users</a></li>
        <?php endif; ?>
        
        <!-- Everyone: Profile but not ppl who haven't loged in -->
        <?php if (str_starts_with($role, 'AD') || str_starts_with($role, 'CU') || str_starts_with($role, 'SE')): ?>
            <li><a href="/WebProject/Pages/userProfilePage" class="block text-gray-300 hover:text-white transition">Profile</a></li>
        <?php endif; ?>

        <li><a id="logInOutMobile" href="/WebProject/Pages/login" class="block text-gray-300 hover:text-white transition">Logout</a></li>
    </ul>
</div>