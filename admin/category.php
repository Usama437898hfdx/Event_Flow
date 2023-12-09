<?php
session_start();
if (!isset($_SESSION['Admin'])) {
  header('location:login.php');
  exit;
}
include("header.php"); ?>



<!-- page-title -->
<section class="section bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h4>Fashion</h4>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<!-- category post -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row masonry-container pt-5">
          <div class="col-sm-6 mb-5">
            <article class="text-center">
              <img class="img-fluid mb-4" src="images/masonary-post/post-1.jpg" alt="post-thumb">
              <p class="text-uppercase mb-2">TRAVEL</p>
              <h4 class="title-border"><a class="text-dark" href="blog-single.html">Charming Evening Field</a></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat.</p>
              <a href="blog-single.html" class="btn btn-transparent">read more</a>
            </article>
          </div>
          <div class="col-sm-6 mb-5">
            <article class="text-center">
              <img class="img-fluid mb-4" src="images/masonary-post/post-2.jpg" alt="post-thumb">
              <p class="text-uppercase mb-2">TRAVEL</p>
              <h4 class="title-border"><a class="text-dark" href="blog-single.html">Charming Evening Field</a></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat.</p>
              <a href="blog-single.html" class="btn btn-transparent">read more</a>
            </article>
          </div>
          <div class="col-sm-6 mb-5">
            <article class="text-center">
              <img class="img-fluid mb-4" src="images/masonary-post/post-3.jpg" alt="post-thumb">
              <p class="text-uppercase mb-2">TRAVEL</p>
              <h4 class="title-border"><a class="text-dark" href="blog-single.html">Charming Evening Field</a></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat.</p>
              <a href="blog-single.html" class="btn btn-transparent">read more</a>
            </article>
          </div>
          <div class="col-sm-6 mb-5">
            <article class="text-center">
              <img class="img-fluid mb-4" src="images/masonary-post/post-4.jpg" alt="post-thumb">
              <p class="text-uppercase mb-2">TRAVEL</p>
              <h4 class="title-border"><a class="text-dark" href="blog-single.html">Charming Evening Field</a></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat.</p>
              <a href="blog-single.html" class="btn btn-transparent">read more</a>
            </article>
          </div>
          <div class="col-sm-6 mb-5">
            <article class="text-center">
              <img class="img-fluid mb-4" src="images/masonary-post/post-8.jpg" alt="post-thumb">
              <p class="text-uppercase mb-2">TRAVEL</p>
              <h4 class="title-border"><a class="text-dark" href="blog-single.html">Charming Evening Field</a></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat.</p>
              <a href="blog-single.html" class="btn btn-transparent">read more</a>
            </article>
          </div>
          <div class="col-sm-6 mb-5">
            <article class="text-center">
              <img class="img-fluid mb-4" src="images/masonary-post/post-10.jpg" alt="post-thumb">
              <p class="text-uppercase mb-2">TRAVEL</p>
              <h4 class="title-border"><a class="text-dark" href="blog-single.html">Charming Evening Field</a></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat.</p>
              <a href="blog-single.html" class="btn btn-transparent">read more</a>
            </article>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <nav>
              <ul class="pagination justify-content-center align-items-center">
                <li class="page-item">
                  <span class="page-link">&laquo; Previous</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">01</a></li>
                <li class="page-item active">
                  <span class="page-link">02</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
                <li class="page-item"><a class="page-link" href="#">04</a></li>
                <li class="page-item"><a class="page-link" href="#">05</a></li>
                <li class="page-item"><a class="page-link" href="#">06</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next &raquo;</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <!-- /blog post -->
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
              <h6><a class="text-dark" href="blog-single.html">Lorem ipsum dolor sit amet, consectetur</a></h6>
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
              <h6><a class="text-dark" href="blog-single.html">Lorem ipsum dolor sit amet, consectetur</a></h6>
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
              <h6><a class="text-dark" href="blog-single.html">Lorem ipsum dolor sit amet, consectetur</a></h6>
            </div>
          </div>
        </div>
        <div class="widget">
          <h6 class="mb-4">TAG</h6>
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
<!-- /category post -->
<?php

include("footer.php"); ?>