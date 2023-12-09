<?php include("header.php"); ?>

<!-- category post -->
<section>
    <div class="container">
        <div class="row masonry-container pt-5">
            <?php
                    $fetch_event = mysqli_query($con, "SELECT * FROM events WHERE is_deleted = 0 AND is_active = 1 AND parent_id IS NULL LIMIT 1");

                    foreach ($fetch_event as $event) {
                    ?>
            <div>
                <article class="text-center">
                    <h4 class="title-border"><a class="text-dark"
                            href="blog-single.html"><?php echo $event['name']; ?></a></h4>
                            <div class="card-body p-2">
                <img src="assets/images/events/<?php echo $detail['image'] ?>" class="img-fluid w-100"
                    style="max-width: 100%  ; max-height: 50vh;">
            </div>
                    <img class="img-fluid mb-4" src="assets/images/events/<?php echo $event['image'] ?>"
                        alt="post-thumb" style="width:100px ; height: 200px; object-fit: cover;">
                    <p class="text-uppercase mb-2">event</p>
                    <p><?php echo $event['text']; ?></p>
                    <div>
                        <a href="index.php" class="btn btn-transparent"> More Events</a>
                    </div>
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