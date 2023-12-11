<?php session_start();
if ( !isset($_SESSION['Admin']) ) {
    header('location:login.php');
    exit;
}
include("includes/config.php");
include("includes/header.php");
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Content body start -->
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Event Categories</a></li>
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
                            <h1 class="card-title">Event Categories</h1>

                            <button class="btn btn-primary text-white" onclick="openCreateModal('', '');">Create Category</button>


                            <!-- <a href="create_category.php" style="margin-bottom:12px !important;"

                                class="btn btn-primary">Create new</a> -->
                        </div>
                        <!-- Display Created Tickets -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Event Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  

                                    $fetch_category = mysqli_query($con, "SELECT * FROM `event_categories` WHERE is_deleted = 0 ;");

                                    foreach ($fetch_category as $category) {

                                        ?>
                                    <tr>

                                        <td>
                                            <?php echo $category['name']; ?>
                                        </td>

                                        <td>




                                            <button class="btn btn-danger"
                                                onclick="openDeleteModal('<?php echo $category['category_id']; ?>');">Delete</button>




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





<div class="modal fade" id="CreateCategoryModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editForm" action="includes/db.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="submit" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_name">Category Name:</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required >
                                <input class="form-control" type="hidden" name="category_id" id="category_id" required>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="create_category" class="btn btn-primary">Create New</button>
                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="DeleteCategoryModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog ">
        <form id="deleteForm" action="includes/db.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Event</h5>
                    <button type="submit" name="delete" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete this event?</p>
                        <input type="hidden" id="delete_category_id" name="category_id" value="">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete_Category" class="btn btn-danger">Delete</button>
                </div>

            </div>
        </form>
    </div>
</div>




<!-- Include jQuery library -->


<!-- Your existing PHP and HTML code -->

<script>
function openCreateModal(category_id, category_name) {

    document.getElementById("category_id").value = category_id;
    document.getElementById("category_name").value = category_name;

    $("#CreateCategoryModal").modal("show");
}

function openDeleteModal(category_id) {
    document.getElementById("delete_category_id").value = category_id;
    $("#DeleteCategoryModal").modal("show");
}
</script>

<?php include("includes/footer.php"); ?>