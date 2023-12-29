<?php include("header.php"); ?>

<?php
$fetch_data = mysqli_query($con, "SELECT *, events.name as event_name, event_categories.name as category_name 
                                   FROM events 
                                   JOIN event_categories ON events.category_id = event_categories.category_id 
                                   WHERE events.is_deleted = 0 AND events.is_active = 1 AND events.parent_id IS null ");

$categories = array();

while ($row = mysqli_fetch_assoc($fetch_data)) {
    $category_id = $row['category_id'];

    if (!isset($categories[$category_id])) {
        $categories[$category_id] = array(
            'category_name' => $row['category_name'],
            'events' => array()
        );
    }

    $categories[$category_id]['events'][] = array(
        'event_name' => $row['event_name'],
        'image' => $row['image'],
        'event_id' => $row['event_id'],
        'description' => $row['description']
    );
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container"> <h5>Categories :- </h5>
        <ul class="navbar-nav mr-auto">
            <?php
            foreach ($categories as $category_id => $category) {
                echo '<li class="nav-item"><a class="nav-link" href="#category_' . $category_id . '">' . $category['category_name'] . '</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>

<section>
    <div class="container">
        <?php
        foreach ($categories as $category_id => $category) {
            echo '<div id="category_' . $category_id . '">';
            echo "<h1>" . $category['category_name'] . "</h1>";
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="row masonry-container pt-5">
                    <?php
                    foreach ($category['events'] as $event) {
                    ?>
                        <div class="col-sm-4 mb-5">
                            <article class="text-center">
                                <img class="img-fluid mb-4" src="assets/images/events/<?php echo $event['image'] ?>" alt="post-thumb" style="width: 100%; height: 200px; object-fit: cover;">
                                <p class="text-uppercase mb-2"><?php echo $category['category_name']; ?></p>
                                <h4 class="title-border"><a class="text-dark" href="subevents.php?id=<?php echo $event['event_id'] ?>"><?php echo $event['event_name']; ?></a></h4>
                                <p><?php echo $event['description']; ?></p>
                                <a href="subevents.php?id=<?php echo $event['event_id'] ?>" class="btn btn-transparent">View Detail</a>
                            </article>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
            echo '</div>';
        }
        ?>
    </div>
</section>

<?php include("footer.php"); ?>
