<section id="testimonials" class="testimonials section-bg">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="section-title col-sm-9">
                <h2>Testimonials</h2>
                <p>What they're saying about us</p>
            </div>
            <div class="section-title col-sm-3">
                <div></div>
                <a href="#contact" class="book-a-table-btn scrollto d-none d-lg-flex">Add your feedback !</a>

            </div>

        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                <?php foreach ($data['comments'] as $comment) { ?>
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <p style="height:200px">
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            <?=$comment->comment?>
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                        <img src="<?=ASSETS?>/img/testimonials/profile.png" class="testimonial-img" alt="">
                        <h3> <?= $comment->fullName?></h3>

                    </div>
                </div><!-- End testimonial item -->
                <?php }?>

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>