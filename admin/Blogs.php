<?php session_start();

if ( !isset($_SESSION['Organizer']) ) {
    header('location:login.php');
    exit;

}
include("includes/config.php");
include("includes/header.php");

?>

<!-- Content body start -->
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Blogs</a></li>
            </ol>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title">Blogs</h1>


                        </div>
                        <!-- Display Created Tickets -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Sub Event name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                  

                                  $blogs = mysqli_query($con, "SELECT 
                                  e.name AS event_name, 
                                  e.event_id as id,
                                  b.blog_id as blog_id, 
                                  b.text
                              FROM 
                                  events e
                              INNER JOIN 
                                  blog b ON b.event_id = e.event_id
                              WHERE 
                                  e.organizer_id = $id
                                  AND b.is_deleted = 0;
                                  
                              ");

  ?>
                                    <?php
                                    foreach ($blogs as $blog) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $blog['event_name']; ?>

                                        </td>

                                        <td>


                                        <a href="../view_blog.php?id=<?php echo $blog['id']; ?>"
                                                class="btn btn-primary">View</a>
                                               

                                            <button class="btn btn-danger"
                                                onclick="openDeleteModal('<?php echo $blog['blog_id']; ?>');">Delete</button>


                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="DeleteBlogModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog ">
        <form id="deleteForm" action="includes/db.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Blog</h5>
                    <button type="submit" name="delete" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete this blog?</p>
                        <input type="hidden" id="blog_id" name="blog_id" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteBlog" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>










<script>


function openDeleteModal(blog_id) {
    document.getElementById("blog_id").value = blog_id;
    $("#DeleteBlogModal").modal("show");
}


</script>

<?php include("includes/footer.php"); ?>