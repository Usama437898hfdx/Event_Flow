<?php

include("header.php"); ?>


<style>
        /* Add your fancy styling here */
        .buttn-parent {
            display: flex;align-items: center;justify-content: center;
            padding: 10px 20px;
           
        }
       

</style>

<!-- hero area -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-end">
                <h1 class="mb-0">Welcome</h1>
                <h2 class="mb-100 title-border-lg">to <i>Jhon Abraham Blog</i></h2>
                <p class="mb-80 mr-5">I’m a Freelance Interactive Art Director based in France. Focusing across branding
                    and
                    identity, digital and
                    print.</p>
                <span class="font-secondary text-dark mr-3 mr-sm-5">Follow</span>
                <ul class="list-inline d-inline-block mb-5">
                    <li class="list-inline-item mx-3"><a href="#" class="text-dark"><i class="ti-facebook"></i></a></li>
                    <li class="list-inline-item mx-3"><a href="#" class="text-dark"><i class="ti-twitter-alt"></i></a>
                    </li>
                    <li class="list-inline-item mx-3"><a href="#" class="text-dark"><i class="ti-linkedin"></i></a></li>
                    <li class="list-inline-item mx-3"><a href="#" class="text-dark"><i class="ti-github"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-6 text-right">
                <img class="img-fluid" src="assets/images/banner-img.png" alt="banner-image">
            </div>
        </div>
    </div>
</section>
<!-- /hero area -->

<!-- blog post -->
<section class="section">
    <div class="container">
        <div class="row">
        <?php
$alignment = 0;
$fetch_event = mysqli_query($con, "SELECT * FROM events WHERE is_deleted = 0 AND is_active = 1 AND parent_id IS NULL");

foreach ($fetch_event as $event) {
    $alignment++;

    if ($alignment % 2 == 0) {
        $class = "article-right";
    } else {
        $class = "";
    }
?>
                <div class="col-12 mb-100">
                    <article data-file="articles/b.html" data-target="article" class="article-full-width <?php echo $class;?>">
                        <div class="post-image">
                            <img class="img-fluid" src="assets/images/events/<?php echo $event ['image'] ?>" alt="post-thumb">
                        </div>
                        <div class="post-content">
                            <ul class="list-inline d-flex justify-content-between border-bottom post-meta pb-2 mb-4">
                                <li class="list-inline-item"><i class="ti-calendar mr-2"></i><?php echo $event ['start_date'] ?></li>
                                <li class="list-inline-item"><i class="ti-alarm-clock mr-2"></i><span class="eta">8
                                        min</span> read</li>
                            </ul>
                            <h4 class="mb-4"><a href="blog-single.html" class="text-dark"><?php echo $event ['name'] ?></a></h4>
                            <p class="mb-0 post-summary"><?php echo $event ['description'] ?></p>
                            <a class="btn btn-transparent mb-4" href="blog-single.html">Continue...</a>
                        </div>
                    </article>
                </div>
                <?php } ?>
            
    </div>
    <div class="buttn-parent">
    <a class ="btn btn-primary" href="allevents.php" style="text-decoration: none; color: inherit;">Go to Events</a>
</div>



</section>
<!-- /blog post -->

<?php

include("footer.php"); ?>