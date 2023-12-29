<?php session_start();

include("header.php"); ?>
<h3> UPCOMING EVENTS </h3>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row masonry-container pt-5">
                    <?php
                    $id = $_SESSION['uid'];

                    if (isset($_SESSION['Organizer'])) {
                        $condition = "AND `organizer_id` = $id ";
                    } else {
                        $condition = "";
                    }

                    $currentDate = date("Y-m-d");
                     $fetch_event = mysqli_query($con, "SELECT * FROM `events` where is_deleted = 0  AND is_active = 1 AND  start_date  > '$currentDate'  AND `parent_id` IS NULL $condition");
                    foreach ($fetch_event as $event) {
                    ?>
                        <div class="col-sm-4 mb-5">
                            <article class="text-center">
                                <img class="img-fluid mb-4" src="assets/images/events/<?php echo $event['image'] ?>"
                                    alt="post-thumb" style="width: 100%; height: 200px; object-fit: cover;">
                                <p class="text-uppercase mb-2">event</p>
                                <h4 class="title-border"><a class="text-dark" href="subevents.php?id=<?php echo $event ['event_id'] ?> "><?php echo $event['name']; ?></a></h4>
                                <p><?php echo $event['description']; ?></p>
                                <a href="subevents.php?id=<?php echo $event ['event_id'] ?> " class="btn btn-transparent">View Detail</a>
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

<h3> ONGOING EVENTS </h3>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row masonry-container pt-5">
                    <?php
                    $id = $_SESSION['uid'];

                    if (isset($_SESSION['Organizer'])) {
                        $condition = "AND `organizer_id` = $id ";
                    } else {
                        $condition = "";
                    }

                    $currentDate = date("Y-m-d");
                     $fetch_event = mysqli_query($con, "SELECT * FROM `events` where is_deleted = 0  AND is_active = 1 AND  start_date  = '$currentDate'  AND `parent_id` IS NULL $condition");
                    foreach ($fetch_event as $event) {
                    ?>
                        <div class="col-sm-4 mb-5">
                            <article class="text-center">
                                <img class="img-fluid mb-4" src="assets/images/events/<?php echo $event['image'] ?>"
                                    alt="post-thumb" style="width: 100%; height: 200px; object-fit: cover;">
                                <p class="text-uppercase mb-2">event</p>
                                <h4 class="title-border"><a class="text-dark" href="subevents.php?id=<?php echo $event ['event_id'] ?> "><?php echo $event['name']; ?></a></h4>
                                <p><?php echo $event['description']; ?></p>
                                <a href="subevents.php?id=<?php echo $event ['event_id'] ?> " class="btn btn-transparent">View Detail</a>
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

<h3> COMPLETED EVENTS </h3>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row masonry-container pt-5">
                    <?php
                    $id = $_SESSION['uid'];

                    if (isset($_SESSION['Organizer'])) {
                        $condition = "AND `organizer_id` = $id ";
                    } else {
                        $condition = "";
                    }

                    $currentDate = date("Y-m-d");
                     $fetch_event = mysqli_query($con, "SELECT * FROM `events` where is_deleted = 0  AND is_active = 1 AND   end_date <'$currentDate'  AND `parent_id` IS NULL $condition");
                    foreach ($fetch_event as $event) {
                    ?>
                        <div class="col-sm-4 mb-5">
                            <article class="text-center">
                                <img class="img-fluid mb-4" src="assets/images/events/<?php echo $event['image'] ?>"
                                    alt="post-thumb" style="width: 100%; height: 200px; object-fit: cover;">
                                <p class="text-uppercase mb-2">event</p>
                                <h4 class="title-border"><a class="text-dark" href="subevents.php?id=<?php echo $event ['event_id'] ?> "><?php echo $event['name']; ?></a></h4>
                                <p><?php echo $event['description']; ?></p>
                                <a href="subevents.php?id=<?php echo $event ['event_id'] ?> " class="btn btn-transparent">View Detail</a>
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
