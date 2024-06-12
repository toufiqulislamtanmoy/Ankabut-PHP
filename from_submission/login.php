<?php
include("backend/main.php");
$connectionObj = new Main();
if (isset($_POST['login'])) {
    $result = $connectionObj->userLogin($_POST);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="h-screen flex items-center justify-center">
        <div class="bg-gray-900/15  flex-1 max-w-5xl p-10">
            <h1 class="text-5xl text-center mb-10 font-bold  ">Login</h1>
            <form action="" method="post" class="my-5">
                
                <!-- email details -->
                <div class="flex my-5 flex-col lg:flex-row items-center justify-evenly gap-5">
                    
                    <div class="w-full bg-white shadow-md shadow-orange-400/10 flex items-center justify-between gap-5 px-5">
                        <div><i class="fa-regular fa-envelope"></i></div>
                        <input required class="flex-1 py-2 bg-transparent  focus:outline-none rounded-md" type="email" placeholder="Email" name="email">
                    </div>
                </div>
                <!-- password details -->
                <div class="flex my-5 flex-col lg:flex-row items-center justify-evenly gap-5">
                    <!-- password -->
                    <div class="w-full bg-white shadow-md shadow-orange-400/10 flex items-center justify-between gap-5 px-5">
                        <div><i class="fa-solid fa-lock"></i></div>
                        <input required class="flex-1 py-2 bg-transparent  focus:outline-none rounded-md" type="password" placeholder="Password" name="password">
                    </div>
                   
                </div>
                <button value="Login" name="login" type="submit" class="bg-orange-400 text-white shadow-2xl shadow-orange-400/15 px-5 py-2">Login</button>
                <div class="text-red-400 my-2 text-center">
                    <?php
                    if (
                        isset($result)
                        &&
                        ($result == 'Confirm password did not match'
                        ||
                        $result == 'Fill all the required field')
                    ) {
                        echo $result;
                    } else {
                        echo '';
                    } ?>
                </div>
            </form>
            <p class="text-center">Do not have any account? <a href="./index.php" class="text-blue-400 hover:underline">signup</a></p>
        </div>
    </div>
</body>

</html>