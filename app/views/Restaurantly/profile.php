<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Profile</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= ASSETS ?>/img/favicon.png" rel="icon">
    <link href="<?= ASSETS ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= ASSETS ?>/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= ASSETS ?>/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= ASSETS ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= ASSETS ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= ASSETS ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= ASSETS ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= ASSETS ?>/css/style.css" rel="stylesheet">
    <script>
    function totalOrder(numberMeals) {
        var total = 0;
        for (let i = 1; i <= numberMeals; i++) {
            total += parseFloat(document.getElementById("total" + i).innerText);
        }
        document.getElementById("total").innerHTML = "<strong>TOTAL = " + total + " $</strong>";
    }

    function increaseQuantity(id_meal) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>profile/increaseQuantityMeal?id_meal=" + id_meal, true);
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var AjaxResult = JSON.parse(this.responseText);
                document.getElementById("quantity" + id_meal).innerHTML = AjaxResult.quantity;
                document.getElementById("total" + id_meal).innerHTML = AjaxResult.total + "$";
                totalOrder(AjaxResult.numberMeals);
            }
        }
    }

    function decreaseQuantity(id_meal) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>profile/decreaseQuantityMeal?id_meal=" + id_meal, true);
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var AjaxResult = JSON.parse(this.responseText);
                document.getElementById("quantity" + id_meal).innerHTML = AjaxResult.quantity;
                document.getElementById("total" + id_meal).innerHTML = AjaxResult.total + "$";
                totalOrder(AjaxResult.numberMeals);
            }
        }
    }

    function removeMeal(id_meal, numLigne) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>profile/removeMeal?id_meal=" + id_meal, true);
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var AjaxResult = JSON.parse(this.responseText);
                document.getElementById("myTable").deleteRow(numLigne);

            }
        }
    }

    function checkout() {
        var addresse = document.getElementById("delivery_adress").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>profile/submit?addresse=" + addresse, true);
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("tbody").innerHTML = "";
                document.getElementById("total").innerHTML = "<strong>TOTAL = 0$</strong>";
                document.getElementById("delivery_adress").value = "";

            }
        }
    }
    </script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-cente">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">
            <?php if (isset($data['user'])) { ?>
            <h1 class="logo me-auto me-lg-0"><a href="index.html"><?php echo $data['user']->fullName; ?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="<?= ASSETS ?>/img/logo.png" alt="" class="img-fluid"></a>-->

            <a href="login/logout" class="book-a-table-btn scrollto d-none d-lg-flex">Log out</a>
            <?php } ?>
        </div>
    </header><!-- End Header -->

    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Your Shopping Cart</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="inner-page">
            <div class="container-fluid mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr style="color: #d2b14c;font-family: 'Roboto', sans-serif;">
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th></th>
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    $numItems = count($data);
                                    $i = 0;
                                    $totalCommande = 0;
                                    foreach ($data as $meal) {
                                        if (++$i !== $numItems) { ?>
                                    <tr style="color: #BCBCBC;" id="<?php echo $meal->id_meal; ?>">
                                        <td>
                                            <div class="img-prdct"><img style="width:50px;height:50px"
                                                    src="<?php echo $meal->image; ?>"></div>
                                        </td>
                                        <td>
                                            <p><?php echo $meal->name; ?></p>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="cart-qty-plus" type="button" value="+"
                                                    onClick="increaseQuantity(<?= $meal->id_meal; ?>)">+</button>
                                                <span
                                                    id="quantity<?php echo $meal->id_meal; ?>"><?php echo $meal->quantity; ?></span>
                                                <button class="cart-qty-minus" type="button" value="-"
                                                    onClick="decreaseQuantity(<?= $meal->id_meal; ?>)">-</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="price"><?php echo $meal->price; ?>$</div>
                                        </td>
                                        <td>
                                            <div class="product-removal">
                                                <button style="color: black;"
                                                    class="book-a-table-btn scrollto d-none d-lg-flex"
                                                    onClick="removeMeal(<?= $meal->id_meal; ?>,<?php echo $i; ?>)">
                                                    Remove
                                                </button>
                                            </div>
                                        </td>
                                        <td align="right" id="total<?php echo $meal->id_meal; ?>">
                                            <?php echo $meal->quantity * $meal->price; ?>$</td>
                                    </tr>
                                    <?php $totalCommande += $meal->quantity * $meal->price;
                                        }
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr style="color: #BCBCBC;">
                                        <td colspan="5"></td>
                                        <td align="right" id="total"><strong>TOTAL = <?php echo $totalCommande; ?>
                                                $</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="form-group mt-4">
                                <textarea type="text" class="form-control" id="delivery_adress"
                                    placeholder="Delivery address" required></textarea>
                            </div>

                            <br>
                            <button type="submit" class="book-a-table-btn scrollto d-none d-lg-flex"
                                style="color: black;" onclick="checkout()">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>Restaurantly</h3>
                            <p>
                                A108 Adam Street <br>
                                NY 535022, USA<br><br>
                                <strong>Phone:</strong> +1 5589 55488 55<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Restaurantly</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/restaurantly-restaurant-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= ASSETS ?>/vendor/aos/aos.js"></script>
    <script src="<?= ASSETS ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ASSETS ?>/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= ASSETS ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= ASSETS ?>/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= ASSETS ?>/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= ASSETS ?>/js/main.js"></script>

</body>

</html>