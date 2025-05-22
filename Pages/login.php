<!-- Removing existing sesstions -->
<?php
if (!empty($_SESSION)) {
    session_unset();
    session_destroy();
}
?>

<?php
require_once __DIR__ . '/../Classes/Base/GoogleOauth/GoogleOauthHelper.php';

try {
    $GoogleOauthHelper = new GoogleOauthHelper();
    $clientConnection = $GoogleOauthHelper->GoogleOauthConnect();

    if (isset($_GET['code'])) {
        $token = $clientConnection->fetchAccessTokenWithAuthCode($_GET['code']);

        if (isset($token['access_token'])) {
            $clientConnection->setAccessToken($token['access_token']);

            $oauth = new Google\Service\Oauth2($clientConnection);

            $userInfo = $oauth->userinfo->get();
        }
    }
} catch (Exception $e) {

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Page</title>
</head>

<body class="relative" id="loginPage">
    <div class="bg-cover bg-center h-screen" style="background-image: url('/WebProject/assets/LoginBackground.gif')">
        <!-- Top Nav Bar      -->
        <div class="flex justify-between absolute top-0 left-0 w-full">
            <a href="/WebProject/index"
                class="border bg-white bg-opacity-5 backdrop-blur-lg mt-2 ml-2 py-0.5 pb-1 px-3 text-white font-semibold rounded">BlueArt</a>
            <a href="/WebProject/Pages/aboutUsPage"
                class="border bg-white bg-opacity-5 backdrop-blur-lg mt-2 mr-2 py-0.5 pb-1 px-3 text-white font-semibold rounded">About
                Us</a>
        </div>

        <!-- Login Form  -->
        <div class="flex items-center justify-center h-screen">
            <form class="bg-white bg-opacity-5 backdrop-blur-lg p-8 w-[85%] sm:w-[350px] shadow-lg rounded shadow-lg"
                id="loginForm">
                <h1 class="text-3xl text-white text-center font-bold mb-7">Login</h1>

                <div class="flex justify-center mb-2">
                    <input type="email" placeholder="Email"
                        class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 mb-3 w-full rounded-full hover:bg-opacity-10"
                        id="emailIN">
                </div>

                <div class="flex justify-center mb-2">
                    <input type="text" placeholder="Password"
                        class="border border-balck bg-white text-white bg-opacity-5 px-3 py-0.5 w-full rounded-full hover:bg-opacity-10"
                        id="passIN">
                </div>

                <p class="mb-2 text-white text-sm text-center" id="errorOut">&nbsp;</p>
                <button type="button"
                    class="bg-white px-4 py-1 block mx-auto w-full rounded-full font-bold hover:bg-white hover:bg-opacity-70"
                    id="loginBtn">Login</button>
                <p class="text-white text-sm text-center mt-2 mb-0.5 opacity-80">Don't have an account?
                    <a href="/WebProject/Pages/register" class="font-semibold hover:font-bold">Register</a>
                </p>

                <hr class="my-5">

                <p class="mb-2 text-white text-sm text-center hidden" id="googleErrorOut">&nbsp;</p>
                <a href="" id="googleOauthBtn"
                    class="bg-white px-4 py-1 block text-center mx-auto w-full rounded-full font-bold hover:bg-white hover:bg-opacity-70">Sign
                    in with Google</a>
            </form>

            <div class="hidden" id="compleateResponce">null</div>
            <div class="hidden" id="responce">null</div>
            <?php
            if (isset($userInfo)) {
                echo "<p class='mb-2 text-white text-sm text-center hidden' id='googleDataResponce'>$userInfo->email, $userInfo->name</p>";
            } else {
                echo "<p class='mb-2 text-white text-sm text-center hidden' id='googleDataResponce'>null</p>";
            }
            ?>
        </div>

        <!-- Footer with absolute positioning -->
        <footer
            class="absolute bottom-0 left-0 w-full bg-gradient-to-r from-gray-700 via-gray-800 to-gray-700 pt-2 pb-2">
            <p class="text-center text-white">&copy; 2025 BlueArt. All Rights Reserved.</p>
        </footer>
    </div>

    <script src="/WebProject/JavaScript/index.js"></script>
    <script src="/WebProject/JavaScript/login_register.js"></script>
</body>

</html>