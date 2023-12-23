<?php
session_start();
include("header.php");

if (isset($_GET['remove'])) {
  $id = $_GET['remove'];
  unset($_SESSION['cart'][$id]);
  echo "<script>window.location.href='cart.php';</script>";
  exit();
}
// print_r($_SESSION['cart']);

?>

<p class="space"></p>
<style>
  .payment-info {
    background: blue;
    padding: 10px;
    border-radius: 6px;
    color: #fff;
    font-weight: bold;
  }

  .product-details {
    padding: 10px;
  }

  body {
    background: #eee;
  }

  .cart {
    background: #fff;
  }

  .p-about {
    font-size: 12px;
  }

  .table-shadow {
    -webkit-box-shadow: 5px 5px 15px -2px rgba(0, 0, 0, 0.42);
    box-shadow: 5px 5px 15px -2px rgba(0, 0, 0, 0.42);
  }

  .type {
    font-weight: 400;
    font-size: 10px;
  }

  label.radio {
    cursor: pointer;
  }

  label.radio input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none;
  }

  label.radio span {
    padding: 1px 12px;
    border: 2px solid #ada9a9;
    display: inline-block;
    color: #8f37aa;
    border-radius: 3px;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 300;
  }

  label.radio input:checked+span {
    border-color: #fff;
    background-color: blue;
    color: #fff;
  }

  .credit-inputs {
    background: rgb(102, 102, 221);
    color: #fff !important;
    border-color: rgb(102, 102, 221);
  }

  .credit-inputs::placeholder {
    color: #fff;
    font-size: 13px;
  }

  .credit-card-label {
    font-size: 9px;
    font-weight: 300;
  }

  .form-control.credit-inputs:focus {
    background: rgb(102, 102, 221);
    border: rgb(102, 102, 221);
  }

  .line {
    border-bottom: 1px solid rgb(102, 102, 221);
  }

  .information span {
    font-size: 12px;
    font-weight: 500;
  }

  .information {
    margin-bottom: 5px;
  }

  .items {
    -webkit-box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.25);
    box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.08);
  }

  .spec {
    font-size: 11px;
  }
</style>

<section>
  <div class="container mt-5 p-3 rounded cart">
    <div class="row no-gutters">
    <div class="col-md-8">
  <div class="product-details mr-2">
    <div class="d-flex flex-row align-items-center">
      <i class="fa fa-long-arrow-left"></i>
      <span class="ml-2">
        <!-- <a href="index.php" class="text-dark text-decoration-none"> Continue Shopping</a> -->
      </span>
    </div>
    <hr>
    <h6 class="mb-0">Your Cart</h6>

    <?php if (isset($_SESSION['cart'])) { ?>
      <div class="d-flex justify-content-between">
        <span class="text-center">
          <?php echo 'You have ' . count($_SESSION['cart']) . ' items in your cart'; ?>
        </span>
      </div>

      <?php    
      $total = 0;
      foreach ($_SESSION['cart'] as $cart_data) { 
        
        ?>
        <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
          <div class="d-flex flex-row">
            <div class="ml-2">
              <span class="font-weight-bold d-block">
                <?php echo $cart_data['name'] ?>
              </span>
              <span class="spec">
                <?php echo $cart_data['ticket_type'] ?>
              </span>
            </div>
          </div>
          <span class="d-block ml-5 font-weight-bold">$
            <?php echo $cart_data['price'] ?>
          </span>
          <div class="d-flex flex-row align-items-center">
            <button class="border-0 btn" onclick="updateQuantity(<?php echo $cart_data['ticket_type_id']; ?>, 'decrease')">-</button>
            <input type="number" readonly name="quantity" class="quantity-input form-control mx-2 text-center" value="<?php echo $cart_data['quantity']; ?>" min="1">
            <button class="border-0 btn" onclick="updateQuantity(<?php echo $cart_data['ticket_type_id']; ?>, 'increase')">+</button>
            <span class="d-block ml-5 font-weight-bold">$
              <?php $t = $cart_data['quantity'] * $cart_data['price']; 
              echo $t;
              $total = $total+$t;
              ?>
            </span>
            <a class="text-danger ml-3" href="?remove=<?php echo $cart_data['ticket_type_id']; ?>">
              <i class="fa-solid fa-trash"></i>
            </a>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <div class="d-flex justify-content-between">
        <span class="text-center">Your cart is empty</span>
      </div>
    <?php } 
  
    ?>
  </div>
</div>


<div class="col-md-4">
    <div class="payment-info">
        <div class="d-flex justify-content-between align-items-center">
            <span>Wallet</span>
            <img class="rounded" src="https://i.imgur.com/WU501C8.jpg" width="30">
        </div>
        <span class="type d-block mt-3 mb-1">Card type</span>
        <hr class="line">
        <label>Check-Out Amount</label>
            <input type="number" id="CheckOutAmount" value="<?php echo $total;?>" class="form-control" placeholder="Total" readonly>

            <button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button"
                onclick="submitCheckOut()">
                <span>Check Out <i class="fa fa-long-arrow-right ml-1"></i></span>
            </button>
    </div>
    </div>
  </div>
</section>

<script>
   function submitCheckOut() {
    var CheckOutAmount = document.getElementById('CheckOutAmount').value;

    // Perform validation if needed

    // Use AJAX to send the top-up amount to the server-side script
    $.ajax({
        type: 'POST',
        url: 'checkout_process.php',
        data: {
            amount: CheckOutAmount
        },
        success: function(response) {
            // Handle the response from the server (e.g., update UI)
          // console.log(response);
            // Redirect to wallet.php
            window.location.href = 'cart.php';
        },
        error: function(error) {
            console.error(error);
        }
    });
}

    </script>




<style>
  * {
    margin: 0;
    padding: 0
  }

  html {
    height: 100%
  }

  p {
    color: grey
  }

  #heading {
    text-transform: uppercase;
    color: #673AB7;
    font-weight: normal
  }

  #msform {
    text-align: center;
    position: relative;
    margin-top: 20px
  }

  #msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
  }

  .form-card {
    text-align: left
  }

  #msform fieldset:not(:first-of-type) {
    display: none
  }

  #msform input,
  #msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    background-color: #ECEFF1;
    font-size: 16px;
    letter-spacing: 1px
  }

  #msform input:focus,
  #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #673AB7;
    outline-width: 0
  }

  #msform .action-button {
    width: 100px;
    background: #673AB7;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
  }

  #msform .action-button:hover,
  #msform .action-button:focus {
    background-color: #311B92
  }

  #msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
  }

  #msform .action-button-previous:hover,
  #msform .action-button-previous:focus {
    background-color: #000000
  }

  .card {
    z-index: 0;
    border: none;
    position: relative
  }

  .fs-title {
    font-size: 25px;
    color: #673AB7;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
  }

  .purple-text {
    color: #673AB7;
    font-weight: normal
  }

  .steps {
    font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
  }

  .fieldlabels {
    color: gray;
    text-align: left
  }

  #progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
  }

  #progressbar .active {
    color: #673AB7
  }

  #progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
  }

  #progressbar #account:before {
    font-family: FontAwesome;
    content: "\f13e"
  }

  #progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
  }

  #progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f030"
  }

  #progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
  }

  #progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
  }

  #progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
  }

  #progressbar li.active:before,
  #progressbar li.active:after {
    background: #673AB7
  }

  .progress {
    height: 20px
  }

  .progress-bar {
    background-color: #673AB7
  }

  .fit-image {
    width: 100%;
    object-fit: cover
  }
</style>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row ">
            <div class="col-12 text-center p-0 mt-3 mb-2">
              <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">Fill Registration  Form</h2>
                <p>Fill all form field to go to next step</p>
                <form id="msform">
                  <ul id="progressbar">
                    <li class="active" id="account"><strong>1</strong></li>
                    <li id="confirm"><strong>Finish</strong></li>
                  </ul>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div> <br>
                  <fieldset>
                    <div class="form-card">
                      <div class="row">
                        <div class="col-6">
                          <label class="fieldlabels">Password: *</label>
                          <input type="password" name="pwd" placeholder="Password" />
                        </div>
                        <div class="col-6">
                          <label class="fieldlabels">Confirm Password: *</label>
                          <input type="password" name="cpwd" placeholder="Confirm Password" />
                        </div>
                      </div>

                    </div>
                    <input type="button" name="next" class="next action-button" value="Next" />
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function /* The above code is likely defining a function or method called "updateQuantity" in the PHP
  programming language. */
  updateQuantity(ticketTypeId, action) {
    $.ajax({
      url: 'update_cart.php',
      type: 'POST',
      data: {
        ticketTypeId: ticketTypeId,
        action: action
      },
      success: function (response) {
        if (response === 'success') {
          // Fetch new session data and update the cart section
          $.ajax({
            url: 'fetch_cart.php', // Create fetch_cart.php to fetch updated cart data
            type: 'GET',
            success: function (newCartHTML) {
              // Replace the existing cart content with the new one
              $('.product-details').html(newCartHTML);
              let t = $('#tamt').val();
              $('#CheckOutAmount').val(t)

            },
            error: function (error) {
              console.error('Error fetching cart data:', error);
            }
          });
        } else {
          console.error('Error updating quantity:', response);
        }
      },
      error: function (error) {
        console.error('Error updating quantity:', error);
      }
    });
  }
</script>

<script>
  $(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {

      current_fs = $(this).parent();
      next_fs = $(this).parent().next();

      //Add Class Active
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

      //show the next fieldset
      next_fs.show();
      //hide the current fieldset with style
      current_fs.animate({
        opacity: 0
      }, {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          next_fs.css({
            'opacity': opacity
          });
        },
        duration: 500
      });
      setProgressBar(++current);
    });

    $(".previous").click(function () {

      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();

      //Remove class active
      $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

      //show the previous fieldset
      previous_fs.show();

      //hide the current fieldset with style
      current_fs.animate({
        opacity: 0
      }, {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          previous_fs.css({
            'opacity': opacity
          });
        },
        duration: 500
      });
      setProgressBar(--current);
    });

    function setProgressBar(curStep) {
      var percent = parseFloat(100 / steps) * curStep;
      percent = percent.toFixed();
      $(".progress-bar")
        .css("width", percent + "%")
    }

    $(".submit").click(function () {
      return false;
    })

  });
</script>
<p class="space"></p>
<?php include("footer.php"); ?>