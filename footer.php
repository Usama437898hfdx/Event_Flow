<section>
  <div class="container-fluid px-0">
    <div class="row no-gutters instagram-slider" id="instafeed" data-userId="4044026246"
      data-accessToken="4044026246.1677ed0.8896752506ed4402a0519d23b8f50a17"></div>
  </div>
</section>
<!-- /instagram -->

<footer class="bg-secondary">
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <a href="index.php"><img src="assets/images/ab.jpeg" alt="persa" class="img-fluid"></a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <h6>Address</h6>
          <ul class="list-unstyled">
            <li class="font-secondary text-dark">Pakistan</li>
            <li class="font-secondary text-dark">A-308 Block 7 KAECHS</li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <h6>Contact Info</h6>
          <ul class="list-unstyled">
            <li class="font-secondary text-dark">Tel: +92 3362616926 </li>
            <li class="font-secondary text-dark">Mail: eventflow@gmail.com</li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <h6>Follow</h6>
          <ul class="list-inline d-inline-block">
            <li class="list-inline-item"><a href="https://www.facebook.com/" class="text-dark"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item"><a href="https://twitter.com/" class="text-dark"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item"><a href="https://linkedin.com/" class="text-dark"><i class="ti-linkedin"></i></a></li>
            <li class="list-inline-item"><a href="https://github.com/" class="text-dark"><i class="ti-github"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center pb-3">
    <p class="mb-0">Copyright ©
      <script>var CurrentYear = new Date().getFullYear()
        document.write(CurrentYear)</script> a theme by <a href="index.php">EVENT FLOW</a>
    </p>
  </div>
</footer>
<script>
  function decreaseQuantity(event_id, availableQuantity) {
    var quantityInput = document.getElementById("quantity-" + event_id);
    var errorMessage = document.getElementById("error-message-" + event_id);

    if (quantityInput.value > 1) {
      quantityInput.value = parseInt(quantityInput.value) - 1;
      if (parseInt(quantityInput.value) <= availableQuantity) {
        errorMessage.style.display = 'none'; // Hide error message if available
      }
    }
  }

  function increaseQuantity(event_id, availableQuantity) {
    var quantityInput = document.getElementById("quantity-" + event_id);
    var errorMessage = document.getElementById("error-message-" + event_id);

    if (parseInt(quantityInput.value) < availableQuantity) {
      quantityInput.value = parseInt(quantityInput.value) + 1;
      errorMessage.style.display = 'none'; // Hide error message if shown
    } else {
      errorMessage.style.display = 'block'; // Show error message
    }
  }
</script>


<!-- jQuery -->
<script src="<?php echo $basepath; ?>assets/plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo $basepath; ?>assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="<?php echo $basepath; ?>assets/plugins/slick/slick.min.js"></script>
<!-- masonry -->
<script src="<?php echo $basepath; ?>assets/plugins/masonry/masonry.js"></script>
<!-- instafeed -->
<script src="<?php echo $basepath; ?>assets/plugins/instafeed/instafeed.min.js"></script>
<!-- smooth scroll -->
<script src="<?php echo $basepath; ?>assets/plugins/smooth-scroll/smooth-scroll.js"></script>
<!-- headroom -->
<script src="<?php echo $basepath; ?>assets/plugins/headroom/headroom.js"></script>
<!-- reading time -->
<script src="<?php echo $basepath; ?>assets/plugins/reading-time/readingTime.min.js"></script>

<!-- Main Script -->
<script src="<?php echo $basepath; ?>assets/js/script.js"></script>
<script>
        function adjustPadding() {
            const body = document.body;
            const main = document.querySelector('main');
            const windowWidth = window.innerWidth;

            // Adjust padding based on window width
            if (windowWidth >= 600) {
                main.style.padding = '40px';
            } else {
                main.style.padding = '20px';
            }
        }

        // Initial adjustment on page load
        adjustPadding();

        // Adjust padding when the window is resized
        window.addEventListener('resize', adjustPadding);
    </script>

</body>

</html>