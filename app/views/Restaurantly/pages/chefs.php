<style>
.row {
    display: flex;
}

.chef {
    margin-right: 40px;
    margin-left: 40px;
    height: 350px;
    width: 1000px;
}
</style>

<section id="chefs" class="chefs">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Chefs</h2>
            <p>Our Proffesional Chefs</p>
        </div>

        <div class="row">

            <div class="swiper-wrapper chef">
                <?php foreach ($data['chefs'] as $chef) { ?>
                <div class="member" data-aos="zoom-in" data-aos-delay="200">
                    <img src="<?=ASSETS?>/img/chefs/<?php echo $chef->image;?>" class="img-fluid" alt="">
                    <div class="member-info">
                        <div class="member-info-content">
                            <h4><?php echo $chef->name;?></h4>
                            <span><?php echo $chef->occupation;?></span>
                        </div>
                        <div class="social">
                            <a href="<?php echo $chef->facebook;?>"><i class="bi bi-facebook"></i></a>
                            <a href="<?php echo $chef->instagram;?>"><i class="bi bi-instagram"></i></a>
                            <a href="<?php echo $chef->linkedin;?>"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>



        </div>

    </div>
</section>