<?php

include("header.php"); ?>


<style>
        .buttn-parent {
            display: flex;align-items: center;justify-content: center;
            padding: 10px 20px;
        }
</style>

<!-- hero area -->
<section class="hero-section">
    <div class="container">
                <img class="img-fluid" src="assets/images/banners1.jpeg" >
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
                                <li class="list-inline-item"><i class="ti-calendar mr-2"></i><?php echo $event ['end_date'] ?></li>
                               
                            </ul>
                            <h4 class="mb-4"><a href="blog.php" class="text-dark"><?php echo $event ['name'] ?></a></h4>
                            <p class="mb-0 post-summary"><?php echo $event ['description'] ?></p>
                            <a class="btn btn-transparent mb-4" href="subevents.php?id=<?php echo $event ['event_id'] ?> ">View</a>
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