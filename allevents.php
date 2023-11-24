<?php include("header.php"); ?>

<!-- category post -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row masonry-container pt-5">
                    <?php
                    $fetch_event = mysqli_query($con, "SELECT * FROM events WHERE is_deleted = 0 AND is_active = 1 AND parent_id IS NULL");

                    foreach ($fetch_event as $event) {
                    ?>
                        <div class="col-sm-4 mb-5">
                            <article class="text-center">
                                <img class="img-fluid mb-4" src="assets/images/events/<?php echo $event['image'] ?>"
                                     alt="post-thumb" style="width: 100%; height: 200px; object-fit: cover;">
                                <p class="text-uppercase mb-2">TRAVEL</p>
                                <h4 class="title-border"><a class="text-dark"
                                                            href="blog-single.html"><?php echo $event['name']; ?></a></h4>
                                <p><?php echo $event['description']; ?></p>
                                <a href="blog-single.html" class="btn btn-transparent">View Detail</a>
                            </article>
                        </div>
                    <?php                  
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
