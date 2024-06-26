<?php
include("header.php");
if (!isset($_SESSION['Attendee']) && !isset($_SESSION['Organizer']) && !isset($_SESSION['Admin'])  ) {
  // Redirect to the sign-in page if not signed in
  header("Location: admin/login.php");
  exit();
}



if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $parent = mysqli_query($con, "SELECT * FROM events WHERE `event_id` = $id");
    $parent = mysqli_fetch_assoc($parent);
    ?>

    <br><br>
    <!-- page-title -->
    <section class="section bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?php echo $parent['name'] ?></h2>
                    <h4><?php echo $parent['description'] ?></h4>
                </div>
            </div>
        </div>
    </section>
    <!-- /page-title -->

    <section>
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row masonry-container pt-5">
                        <?php
                        $subevent = mysqli_query($con, "SELECT * FROM events WHERE parent_id = '$id'");

                        foreach ($subevent as $event) {
                            ?>
                            <div class="col-sm-4 mb-5">
                                <article class="text-center">
                                    <img class="img-fluid mb-4"
                                      src="assets/images/events/<?php echo $event['image'] ?>"
                                      alt="post-thumb" style="object-fit: cover;">
                                    <p class="text-uppercase mb-2">NAME</p>
                                    <h4 class="title-border"><a class="text-dark"><?php echo $event['name']; ?></a>
                                    </h4>
                                    <p><?php echo $event['description']; ?></p>
                                    <a href="event_detail.php?id=<?php echo $event['event_id']; ?>"
                                     class="btn btn-transparent"> BUY NOW </a>
                                </article>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
            }
            ?>

            </div>
        </div>
    </section>

    <!-- blog single -->

    <!-- /blog single -->
    <?php include("footer.php"); ?>
