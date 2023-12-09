<?php session_start();
include("header.php"); 


$event_id = $_GET['id'];
$fetch_blog = mysqli_query($con, "SELECT b.* , e.*
FROM events e
JOIN blog b ON e.event_id = b.event_id
WHERE e.event_id = $event_id");


?>

<!-- category post -->
<section>
    <div class="container">
        <div class="container">
            <?php
                    foreach ($fetch_blog as $blog) { 
                       
                    ?>
            <div>
                <article class="text-center">
                    <h4 class="title-border" class="text-dark">
                           <?php echo $blog['name']; ?></h4>
                    <h3 class="text-uppercase mb-2">BLOG</h3>
                    <p><?php echo $blog['text']; ?></p>
                        <a href="index.php" class="btn btn-transparent"> More Events</a>        
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