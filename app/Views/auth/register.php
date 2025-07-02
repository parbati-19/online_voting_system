<?php
include_once 'app/Views/layouts/header.php';
    
// Get today's date minus 18 years
$maxDob = date('Y-m-d', strtotime('-18 years'));
?>

<div class="bg-white h-screen ">
    <div class="flex justify-center items-center m-4">
        <div class="flex flex-col justify-center items-center bg-gray-100 rounded shadow-lg m-4 p-4 w-lg">
            <div class="text-2xl font-bold m-2 p-2">
                <h1>
                    Register
                </h1>
            </div>
            <?php if (!empty($_SESSION['message'])): ?>
            <div class="mb-4 rounded-md bg-green-100 p-4 border border-green-300 text-green-800">
                <?= htmlspecialchars($_SESSION['message']) ?>
                <?php unset($_SESSION['message']); ?>
            </div>
            <?php endif; ?>

            <div class="m-2 p-2">
                <form action="index.php?url=auth/register" method="POST">
                    <div class="flex flex-col items-start">
                        <label for="username" class="text-xl">Fullname</label>
                        <input type="text" name="username" id="username"
                            class="border rounded shadow-lg p-4 my-4 w-xs focus:bg-white" placeholder="Ram sharma"
                            required>
                    </div>
                    <div class="flex flex-col items-start">
                        <label for="email" class="text-xl">Email</label>
                        <input type="email" name="email" id="email"
                            class="border rounded shadow-lg p-4 my-4 w-xs focus:bg-white" placeholder="ram@gmail.com"
                            required>
                    </div>

                    <div class="flex flex-col items-start">
                        <label for="dob" class="text-xl">Date of Birth</label>
                        <input type="date" name="dob" id="dob" max="<?=$maxDob?>"
                            class="border rounded shadow-lg p-4 my-4 w-xs focus:bg-white" placeholder="" required>
                    </div>

                    <div class="flex flex-col items-start">
                        <label for="password" class="text-xl">Password</label>
                        <input type="password" name="password" id="password"
                            class="border rounded shadow-lg p-4 my-4 w-xs focus:bg-white" placeholder="********"
                            required>
                    </div>

                    <div class="flex flex-col items-start">
                        <label for="confirmpassword" class="text-xl">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword"
                            class="border rounded shadow-lg p-4 my-4 w-xs focus:bg-white" placeholder="********"
                            required>
                    </div>

                    <div
                        class="bg-gradient-to-r from-orange-600 via-orange-900 to-yellow-500 bg-clip-text text-transparent rounded m-4">
                        <input type="checkbox" name="agree" id="agree" required>
                        <label for="agree">I agree to all terms and conditions</label>
                    </div>

                    <div class="flex justify-center items-center m-6">
                        <button type="submit"
                            class="bg-gradient-to-r from-orange-600 to-orange-400 hover:bg-gradient-to-r from-orange-600 to-yellow-400 px-8 py-2 rounded-full">SignUp</button>
                    </div>
                    <div class=" flex justify-center items-center mb-2">
                        <p>Already have an account? </p>
                        <a href="index.php?url=auth/login" class="hover:underline"> Login</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php
include_once 'app/Views/layouts/footer.php'
?>