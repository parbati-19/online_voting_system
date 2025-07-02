<?php
require_once 'app/Views/layouts/header.php'
?>
<div class="bg-gradient-to-r from-gray-900 via-blue-900 to-black text-white h-screen flex items-center justify-center">
    <div class="text-center px-4">

        <!-- Logo -->
        <img src="assets/images/logo.png" alt="Logo" class="mx-auto w-40 h-40 mb-6 rounded-full shadow-lg">

        <!-- Headline -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to the Online Voting Platform: E-Vote</h1>

        <!-- Subheading -->
        <p class="text-lg md:text-xl mb-6">Your one vote can make a capable one win. Empower democracy by participating
            today!</p>

        <!-- Call-to-Action Button -->
        <a href="index.php?url=auth/login"
            class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 shadow-md">
            Start Voting
        </a>
    </div>
</div>

<?php
require_once 'app/Views/layouts/footer.php'
?>