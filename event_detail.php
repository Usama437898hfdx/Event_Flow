<?php 
session_start();
include("header.php");
$event_id = $_GET['id'];

$fetch_detail = mysqli_query($con, "SELECT
    tt.ticket_type_id,
    tt.name AS ticket_type_name,
    tt.price,
    COUNT(t.ticket_id) AS available_quantity,
    e.*,
    o.id as organizer_id, 
    o.username as organizer
FROM
    ticket_type AS tt
LEFT JOIN
    ticket AS t ON tt.ticket_type_id = t.ticket_type_id AND t.event_id = $event_id AND t.is_booked = 0
JOIN
    events AS e ON tt.event_id = e.event_id
JOIN
    users AS o ON e.organizer_id = o.id
WHERE
    tt.event_id = $event_id
GROUP BY
    tt.ticket_type_id, tt.name, tt.price, o.id, o.username;
");
// session_destroy();
if (isset($_POST['addcart'])) {


    $tt_id = $_POST['ticket_type_id'];
    $ticket_type = $_POST['ticket_type'];
    $event_id = $_POST['event_id'];
    $price = $_POST['price'];
    $available_quantity = $_POST['available_quantity'];
    $quantity = $_POST['quantity'];
    $name = $_POST['event_name'];

    if (isset($_SESSION['cart'][$tt_id])) {
  
        $currentCart = $_SESSION['cart'][$tt_id];

        $currentCart['quantity'] += $quantity;

        $_SESSION['cart'][$tt_id] = $currentCart;

    } else {
      $_SESSION['cart'][$tt_id] = array(
            'ticket_type_id' => $tt_id,
            'ticket_type' => $ticket_type,
            'event_id' => $event_id,
            'price' => $price,
            'available_quantity' => $available_quantity,
            'quantity' => $quantity,
            'name' => $name
        );
    }

    echo"<script>window.location.href='event_detail.php?id=$event_id';</script>";

}


?>


<!-- page-title -->
<section class="section bg-secondary">
    <div class="container">
        <div class="card">
            <div class="card-body p-2">
                <img src="assets\images\events\<?php echo $detail['image'] ?>" class="img-fluid w-100">
            </div>
        </div>
    </div>
</section>
<!-- /page-title -->

<!------ Include the above in your HEAD tag ---------->

<p class="space"></p>

<!-- blog single -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                            role="tab" aria-controls="nav-home" aria-selected="true">Tickets</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Description</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                            role="tab" aria-controls="nav-contact" aria-selected="false">Event Details</a>
                        <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab"
                            aria-controls="nav-about" aria-selected="false">Author</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Event Name</th>
                                    <th>Ticket Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($fetch_detail as $detail) {

                                    ?>
                                    <tr>
                                        <form action="event_detail.php?id=<?php echo $event_id ?>" method="post">
                                            <td>
                                                <?php echo date('d/m/Y', strtotime($detail['start_date'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $detail['name']; ?>
                                                <input type="hidden" name="ticket_type_id" value="<?php echo $detail['ticket_type_id']; ?>">
                                                <input type="hidden" name="ticket_type" value="<?php echo $detail['ticket_type_name']; ?>">
                                                <input type="hidden" name="event_id" value="<?php echo $detail['event_id']; ?>">
                                                <input type="hidden" name="event_name" value="<?php echo $detail['name']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $detail['price']; ?>">
                                                <input type="hidden" name="available_quantity" value="<?php echo $detail['available_quantity']; ?>"
                                                    id="available_quantity">


                                            </td>
                                            <td>
                                                <?php echo $detail['ticket_type_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $detail['available_quantity']; ?>
                                              
                                            </td>
                                            <td>
                                                <?php echo $detail['price']; ?>
                                            </td>



                                            <td class="quantity-container">
                                                <button type="button"
                                                    onclick="decreaseQuantity(<?php echo $detail['ticket_type_id']; ?>, <?php echo $detail['available_quantity']; ?>)"
                                                    class="quantity-button">-</button>

                                                <input type="number" name="quantity"
                                                    id="quantity-<?php echo $detail['ticket_type_id']; ?>"
                                                    class="quantity-input" value="1" min="1">
                                                <button type="button"
                                                    onclick="increaseQuantity(<?php echo $detail['ticket_type_id']; ?>, <?php echo $detail['available_quantity']; ?>)"
                                                    class="quantity-button">+</button>
                                            </td>

                                            <td>
                                                <input type="submit" name="addcart" class="btn btn-primary" value="Add to cart">
                                            </td>


                                        </form>
                                    </tr>
                                    <span id="error-message-<?php echo $detail['ticket_type_id']; ?>"
                                        style="color: red; display: none;">Not enough available quantity</span>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>





                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="col-sm-4 mb-5">
                            <article class="text-center">
                                <h4 class="title-border">
                                    <?php echo $detail['name'] ?><a class="text-dark" href="blog.php"></a>
                                </h4>
                                <p>
                                    <?php echo $detail['description']; ?>
                                </p>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">

                    </div>
                </div>
              
            </div>
            <div class="col-lg-4">
                <div class="widget search-box">
                    <i class="ti-search"></i>
                    <input type="search" id="search-post" class="form-control border-0 pl-5" name="search-post"
                        placeholder="Search">
                </div>
                <div class="widget">
                    <h6 class="mb-4">LATEST POST</h6>
                    <div class="media mb-4">
                        <div class="post-thumb-sm mr-3">
                            <img class="img-fluid" src="images/masonary-post/post-1.jpg" alt="post-thumb">
                        </div>
                        <div class="media-body">
                            <ul class="list-inline d-flex justify-content-between mb-2">
                                <li class="list-inline-item">Post By Jhon</li>
                                <li class="list-inline-item">June 2, 2018</li>
                            </ul>
                            <h6><a class="text-dark" href="blog-single.html">Lorem ipsum dolor sit amet, consectetur</a>
                            </h6>
                        </div>
                    </div>
                    <div class="media mb-4">
                        <div class="post-thumb-sm mr-3">
                            <img class="img-fluid" src="images/masonary-post/post-6.jpg" alt="post-thumb">
                        </div>
                        <div class="media-body">
                            <ul class="list-inline d-flex justify-content-between mb-2">
                                <li class="list-inline-item">Post By Jhon</li>
                                <li class="list-inline-item">June 2, 2018</li>
                            </ul>
                            <h6><a class="text-dark" href="blog-single.html">Lorem ipsum dolor sit amet, consectetur</a>
                            </h6>
                        </div>
                    </div>
                    <div class="media mb-4">
                        <div class="post-thumb-sm mr-3">
                            <img class="img-fluid" src="images/masonary-post/post-3.jpg" alt="post-thumb">
                        </div>
                        <div class="media-body">
                            <ul class="list-inline d-flex justify-content-between mb-2">
                                <li class="list-inline-item">Post By Jhon</li>
                                <li class="list-inline-item">June 2, 2018</li>
                            </ul>
                            <h6><a class="text-dark" href="blog-single.html">Lorem ipsum dolor sit amet, consectetur</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="widget">
                    <h6 class="mb-4">CATEGORIES</h6>
                    <ul class="list-inline tag-list">
                        <li class="list-inline-item m-1"><a href="blog-single.html">ui ux</a></li>
                        <li class="list-inline-item m-1"><a href="blog-single.html">developmetns</a></li>
                        <li class="list-inline-item m-1"><a href="blog-single.html">travel</a></li>
                        <li class="list-inline-item m-1"><a href="blog-single.html">article</a></li>
                        <li class="list-inline-item m-1"><a href="blog-single.html">travel</a></li>
                        <li class="list-inline-item m-1"><a href="blog-single.html">ui ux</a></li>
                        <li class="list-inline-item m-1"><a href="blog-single.html">article</a></li>
                        <li class="list-inline-item m-1"><a href="blog-single.html">developmetns</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /blog single -->
<?php include("footer.php"); ?>