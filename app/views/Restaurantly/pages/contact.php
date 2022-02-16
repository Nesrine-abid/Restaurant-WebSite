<script type="text/javascript">
function comment() {
    var message = document.getElementById("message").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "<?= ROOT ?>home/comment?message=" + message, true);
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("comment").innerHTML = xhr.responseText;
            document.getElementById("message").value = "";
        }
    }
}
function signIn() {
    var message = document.getElementById("message").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "<?= ROOT ?>home/signIn?message=" + message, true);
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("comment").innerHTML = xhr.responseText;
            document.getElementById("message").value = "";
        }
    }
}
</script>
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Contact</h2>
            <p>Contact Us</p>
        </div>
    </div>
    <div class="container" data-aos="fade-up">

        <div class="row mt-5">

            <div class="col-lg-4">
                <div class="info">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>A108 Adam Street, New York, NY 535022</p>
                    </div>

                    <div class="open-hours">
                        <i class="bi bi-clock"></i>
                        <h4>Open Hours:</h4>
                        <p>
                            Monday-Saturday:<br>
                            11:00 AM - 2300 PM
                        </p>
                    </div>

                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>info@example.com</p>
                    </div>

                    <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>+1 5589 55488 55s</p>
                    </div>

                </div>

            </div>


            <div class="col-lg-8 mt-5 mt-lg-0">

                <div class="row php-email-form">

                    <div class="form-group mt-3 ">
                        <textarea class="form-control" id="message" rows="8" placeholder="Your feedback"
                            required></textarea>
                    </div>
                    <br><br>
                    <div class="text-center">
                        <?php if(isset($data['logged_in'])) { ?>
                            <br><br><button type="submit" onclick="comment()">Send Message</button>
                        <?php } else {?>
                            <br><br><button type="submit" onclick="signIn()">Send
                                Message</button>
                        <?php }?>
                    </div>
                    <div id="comment"></div>

                </div>

            </div>

        </div>
        <div style="margin-top:50px" data-aos="fade-up">
            <iframe style="border:0; width: 100%; height: 350px;"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                frameborder="0" allowfullscreen></iframe>
        </div>
</section>

</main>
