<?php include("header.php"); 

if(isset( $_GET["id"])) {
  $id = $_GET["id"];


  $parent = mysqli_query($con,"SELECT * FROM events WHERE `event_id` = $id");

  $parent = mysqli_fetch_assoc($parent);
}

?>


<!-- page-title -->
<section class="section bg-secondary">
    <div class="container">
        <div class="card">
        <div class="card-body p-2">
            <img src="assets/images/author.jpg" class="img-fluid w-100" >
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
                        Tickets
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="col-sm-4 mb-5">
                            <article class="text-center">
                                <h4 class="title-border">Name<a class="text-dark" href="blog.php"><?php echo $parent['name']; ?></a></h4>
                                <p><?php echo $parent['description']; ?></p>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim
                        occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit
                        dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse
                        consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod
                        tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non
                        adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat
                        ex.
                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                        Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim
                        occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit
                        dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse
                        consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod
                        tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non
                        adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat
                        ex.
                    </div>
                </div>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex
                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat
                        nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque
                        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                        beatae vitae
                        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                        fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem
                        ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora
                        incidunt ut
                        labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex
                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat
                        nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque
                        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                        beatae vitae
                        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                        fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem
                        ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora
                        incidunt ut
                        labore et dolore magnam aliquam quaerat voluptatem.</p>

                    <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                        incididunt ut
                        labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum
                    </blockquote>

                    <img src="images/post-img.jpg" alt="image" class="img-fluid">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex
                        ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat
                        nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque
                        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                        beatae vitae
                        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                        fugit, sed quia
                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem
                        ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora
                        incidunt ut
                        labore et dolore magnam aliquam quaerat voluptatem.</p>
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