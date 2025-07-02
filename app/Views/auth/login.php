<?php
include_once 'app/Views/layouts/header.php';
?>

<div class="bg-white h-screen ">
    <div class="flex justify-center items-center p-2 m-8">
        <div class="flex flex-col justify-center items-center bg-gray-100 rounded shadow-lg m-4 p-4 w-lg">
            <div class="text-2xl font-bold m-2 p-2">
                <h1>
                    Welcome users to E-Vote
                </h1>
            </div>

            <div class="m-2 p-2">
                <form action="index.php?url=auth/login" method="POST">
                    <div class="flex flex-col items-start">
                        <label for="email" class="text-xl">Email</label>
                        <input type="email" name="email" id="email"
                            class="border rounded shadow-lg p-4 my-4 w-xs focus:bg-white" placeholder="enter your email"
                            required>

                        <?php if (isset($data['errors']['email'])): ?>
                        <p class="text-red-600 text-sm"><?= htmlspecialchars($data['errors']['email']) ?></p>
                        <?php endif; ?>

                    </div>
                    <div class="flex flex-col items-start">
                        <label for="password" class="text-xl">Password</label>
                        <input type="password" name="password" id="password"
                            class="border rounded shadow-lg p-4 my-4 w-xs focus:bg-white"
                            placeholder="enter your password" required>
                        <?php if (isset($data['errors']['password'])): ?>
                        <p class="text-red-600 text-sm"><?= htmlspecialchars($data['errors']['password']) ?></p>
                        <?php endif; ?>

                    </div>

                    <div
                        class="flex justify-between bg-gradient-to-r from-orange-600 via-orange-900 to-yellow-500 bg-clip-text text-transparent rounded mb-4">
                        <div>
                            <input type="checkbox" name="remember-me" id="remember-me">
                            <label for="remember-me">Remember me</label>
                        </div>
                        <div>
                            <a href="forgotpassword.php">Forgot password?</a>
                        </div>
                    </div>
                    <div
                        class="flex justify-center align-center border border-gray-400 rounded hover:bg-white my-3 p-2">
                        <a class="flex items-center gap-2 text-black" href="">login with google <svg class="h-5 w-auto "
                                viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                                        fill="#4285F4"></path>
                                    <path
                                        d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                        fill="#34A853"></path>
                                    <path
                                        d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                                        fill="#FBBC05"></path>
                                    <path
                                        d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                                        fill="#EB4335"></path>
                                </g>
                            </svg></a>

                    </div>
                    <div
                        class="flex justify-center align-center border border-gray-400 rounded hover:bg-white my-3 p-2">
                        <a class="flex items-center gap-2 text-black" href="">login with facebook <svg
                                class="h-5 w-auto" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>Facebook-color</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs> </defs>
                                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Color-" transform="translate(-200.000000, -160.000000)" fill="#4460A0">
                                            <path
                                                d="M225.638355,208 L202.649232,208 C201.185673,208 200,206.813592 200,205.350603 L200,162.649211 C200,161.18585 201.185859,160 202.649232,160 L245.350955,160 C246.813955,160 248,161.18585 248,162.649211 L248,205.350603 C248,206.813778 246.813769,208 245.350955,208 L233.119305,208 L233.119305,189.411755 L239.358521,189.411755 L240.292755,182.167586 L233.119305,182.167586 L233.119305,177.542641 C233.119305,175.445287 233.701712,174.01601 236.70929,174.01601 L240.545311,174.014333 L240.545311,167.535091 C239.881886,167.446808 237.604784,167.24957 234.955552,167.24957 C229.424834,167.24957 225.638355,170.625526 225.638355,176.825209 L225.638355,182.167586 L219.383122,182.167586 L219.383122,189.411755 L225.638355,189.411755 L225.638355,208 L225.638355,208 Z"
                                                id="Facebook"> </path>
                                        </g>
                                    </g>
                                </g>
                            </svg></a>

                    </div>


                    <div class="flex justify-center items-center m-6">
                        <button type="submit"
                            class="bg-gradient-to-r from-orange-600 to-orange-400 hover:bg-gradient-to-r from-orange-600 to-yellow-400 px-8 py-2 rounded-full">Login</button>
                    </div>
                    <div class=" flex justify-center items-center mb-2">
                        <p>Don't have an account? </p>
                        <a href="index.php?url=auth/register" class="hover:underline">SignUp</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
include_once 'app/Views/layouts/footer.php'
?>