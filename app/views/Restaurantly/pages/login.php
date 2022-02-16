<!DOCTYPE html>
<html>

<head>
    <title> Login & Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=ASSETS?>/css/styleLog.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="cont <?php if(!isset($_SESSION['error'])){?> s-signup <?php }?>">
        <div class="form sign-in">
            <h2>Sign In</h2>
            <form class="formulaire" method="post">
                <label>
                    <span>Email Address</span>
                    <input type="email" name="email1" required>
                </label>
                <p id="demo"></p>
                <label>
                    <span>Password</span>
                    <input type="password" name="password1" required>
                </label>
                <p id="demo1"></p>
                <button class="submit" type="submit">Sign In</button>
            </form>
            <p class="forgot-pass">Forgot Password ?</p>
        </div>

        <div class="sub-cont">
            <div class="img">
                <div class="img-text m-up">
                    <h2>New here?</h2>
                    <p>Sign up and discover great amount of new opportunities!</p>
                </div>
                <div class="img-text m-in">
                    <h2>One of us?</h2>
                    <p>If you already has an account, just sign in. We've missed you!</p>
                </div>
                <div class="img-btn">
                    <span class="m-up">Sign Up</span>
                    <span class="m-in">Sign In</span>
                </div>
            </div>
            <div class="form sign-up">

                <h2>Sign Up</h2>
                <form method="post" class="formulaire">
                    <label>
                        <span>Full Name</span>
                        <input name="fullName" type="text" required>
                        <p id="demo"></p>
                    </label>

                    <label>
                        <span>Email</span>
                        <input name="email" type="email" required>
                    </label>
                    <label>
                        <span>Password</span>
                        <input name="password" type="password" required>
                    </label>
                    <label>
                        <span>Confirm Password</span>
                        <input name="password2" type="password" required>
                    </label>
                    <div style="text-align: center;">
                        <p style="font-size:12px;  color:red;"><?php check_message()?></p>
                    </div>
                    <button class="submit" type="submit">Sign Up Now</button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=ASSETS?>/js/script.js"></script>
</body>

</html>