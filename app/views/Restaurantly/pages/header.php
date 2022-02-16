<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> <?= $data['page_title']?> </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?=ASSETS?>/img/favicon.png" rel="icon">
    <link href="<?=ASSETS?>/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="<?=ASSETS?>/css/all.min.css" type="text/css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?=ASSETS?>/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?=ASSETS?>/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?=ASSETS?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=ASSETS?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=ASSETS?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?=ASSETS?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?=ASSETS?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?=ASSETS?>/css/style.css" rel="stylesheet">
    <!-- JQUERY UI AND CS FILE-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header id="header" class="fixed-top d-flex align-items-cente">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><a href="index.html">Restaurantly</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="<?=ASSETS?>/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
                    <li><a class="nav-link scrollto" href="#chefs">Chefs</a></li>
                    <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

                    <?php if(isset($data['logged_in'])) { ?>
                    <li><a class="nav-link scrollto" style="text-decoration: underline;" href="profile">Your
                            Profile</a></li> <?php }?>

            </nav>
            <?php if(isset($data['logged_in'])) { ?>
            <a href="login/logout" target="_blank" class="book-a-table-btn scrollto d-none d-lg-flex">Log out</a>
            <?php } else {?>
            <a href="login" target="_blank" class="book-a-table-btn scrollto d-none d-lg-flex">Sign In</a>
            <?php }?>

        </div>
    </header>