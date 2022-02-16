<style>
    .aside + .aside {
        margin-top: 30px;
    }

    .aside > .aside-title {
        text-transform: uppercase;
        font-size: 18px;
        margin: 15px 0px 30px;
    }

    .section {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .row {
        display: flex;
    }

    .col {
        flex: 1;
    }

    .price-range-search {
        width: 40.5%;
        background-color: #f9f9f9;
        border: 1px solid #6e6666;
        min-width: 40%;
        display: inline-block;
        height: 32px;
        border-radius: 5px;
        float: left;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .price-range-field {
        width: 32%;
        min-width: 16%;
        background-color: #F8F4F4E8;
        border: 2px solid #cda45e;
        color: black;
        font-family: myFont;
        font: normal 14px Arial, Helvetica, sans-serif;
        border-radius: 5px;
        height: 26px;
        padding: 5px;
    }

    .search-results-block {
        position: relative;
        display: block;
        clear: both;
    }

    .search-box {
        width: fit-content;
        height: fit-content;
        position: relative;
    }

    .input-search {
        height: 50px;
        width: 50px;
        border-style: none;
        padding: 10px;
        font-size: 18px;
        letter-spacing: 2px;
        outline: none;
        border-radius: 25px;
        transition: all .5s ease-in-out;
        background-color: #cda45e;
        padding-right: 40px;
        color: #cda45e;
    }

    .input-search::placeholder {
        color: rgba(255, 255, 255, .5);
        font-size: 18px;
        letter-spacing: 2px;
        font-weight: 100;
    }

    .btn-search {
        width: 50px;
        height: 50px;
        border-style: none;
        font-size: 20px;
        font-weight: bold;
        outline: none;
        cursor: pointer;
        border-radius: 50%;
        position: absolute;
        right: 0px;
        color: #ffffff;
        background-color: transparent;
        pointer-events: painted;
    }

    .btn-search:focus ~ .input-search {
        width: 300px;
        border-radius: 0px;
        background-color: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, .5);
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }

    .input-search:focus {
        width: 300px;
        border-radius: 0px;
        background-color: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, .5);
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }
</style>
<script type="text/javascript">
    function filterByCategorie(code) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>home/filterByCategorie?code=" + code, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("menu_meal").innerHTML = xhr.responseText;

            }
        }
    }

    function filterByPrice() {
        var min = document.getElementById("min_price").value;
        var max = document.getElementById("max_price").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>home/filterByPrice?min=" + min + "&max=" + max, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("menu_meal").innerHTML = xhr.responseText;

            }
        }

    }


    function search(str) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>home/search?find=" + str, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("menu_meal").innerHTML = xhr.responseText;
            }
        }
    }

    function add(id_meal) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= ROOT ?>home/addToCart?id_meal=" + id_meal, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("cart").innerHTML = xhr.responseText;
            }
        }
    }
</script>
<section id="menu" class="menu section-bg">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="section-title col">
                <h2>Menu</h2>
                <p>Check Our Tasty Menu</p>
            </div>
            <div class="search-box ">
                <button class="btn-search "><img src="<?= ASSETS ?>/img/search..png"
                                                 style="width:45px; height:30px ;padding-right:20px" alt=""></button>
                <input type="text" class="input-search" onkeyup="search(this.value)" placeholder="Type to Search...">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="aside-title">Categories</h3>
                <br>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="menu-flters">
                            <li onClick="filterByCategorie(0)">All</li>
                            <?php foreach ($data['categorie'] as $c) { ?>
                                <li onClick="filterByCategorie(<?= $c->code; ?>)"><?= $c->nom; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="search-box ">
                <h3 class="aside-title">Price</h3>
                <div class="price-range-block ">
                    <div style="margin:35px auto">
                        <input type="number" min=3 max=100 value=3 id="min_price" oninput="filterByPrice()"
                               class="price-range-field"/>
                        <input type="number" min=3 max=100 value=100 id="max_price" oninput="filterByPrice()"
                               class="price-range-field"/>
                    </div>


                </div>

            </div>
        </div>


        <div>
            <!-- product -->
            <div id="menu_meal" class="row " data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($data['meals'] as $meal) { ?>
                <div class="col-lg-6 menu-item filter-starters">
                    <img src="<?php echo $meal->image; ?>"
                         style='width: 80px;border-radius: 50%;float: left;margin-right:20px;margin-bottom:60px;border: 3px solid rgba(255, 255, 255, 0.2);'
                         alt="">
                    <div class="menu-content">
                        <a href="menu"><?php echo $meal->name; ?></a><span><?php echo $meal->price; ?>
                            €</span>
                    </div>
                    <div class="menu-ingredients">
                        <?php echo $meal->description; ?>
                    </div>
                    <br>
                    <div>

                            <a href="#menu" onclick="add(<?= $meal->id; ?>)" class="book-a-table-btn scrollto "><img
                                        src="<?= ASSETS ?>/img/panier.png"
                                        style="width:45px; height:30px ;padding-right:20px"
                                        alt="">Add
                                to
                                cart</a>

                    </div>
                </div>
            <?php }?>
            </div>

        </div>
    </div>


</section>
