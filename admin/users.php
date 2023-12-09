<?php session_start(); 
if (!isset($_SESSION['Admin'])) {
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">users</a></li>
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
                            <h1 class="card-title">Organizer</h1>
                            <button style="margin-bottom:12px !important;" class="btn btn-primary" data-toggle="modal"
                                data-target=".bd-example-modal-lg">Create new</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <!-- Table Headers -->
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                    <?php
        
        $fetch_user = mysqli_query($con,"SELECT * FROM `users` where is_deleted = 0" );

        foreach($fetch_user as $user){  
            
          ?>
                                    <tr>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td>

                                            <button class="btn btn-primary text-white" onclick="openEditModal('<?php echo $user['id'];?>',
                                            '<?php echo $user['username'];?>',
                                            '<?php echo $user['email'];?>',
                                            '<?php echo $user['password'];?>',
                                            '<?php echo $user['address'];?>',
                                            '<?php echo $user['city'];?>',
                                            '<?php echo $user['state'];?>',
                                            '<?php echo $user['zip_code'];?>',
                                            '<?php echo $user['location'];?>',
                                            '<?php echo $user['phone'];?>'
                                            );">Edit</button>

                                            <button class="btn btn-primary text-white" 
                                            onclick="openViewModal('<?php echo $user['id'];?>',
                                            '<?php echo $user['username'];?>',
                                            '<?php echo $user['email'];?>',
                                            '<?php echo $user['password'];?>',
                                            '<?php echo $user['address'];?>',
                                            '<?php echo $user['city'];?>',
                                            '<?php echo $user['state'];?>',
                                            '<?php echo $user['zip_code'];?>',
                                            '<?php echo $user['location'];?>',
                                            '<?php echo $user['phone'];?>'
                                            );"
                                            >View </button>

                                            <button class="btn btn-danger"
                                                onclick="openDeleteModal('<?php echo $user['id']; ?>');">Delete</button>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <!-- Add more table rows dynamically -->
                                </tbody>
                                <!-- Table Footer -->
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="EditOrganizerModal" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editForm" action="includes/db.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Organizer Detail</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="organizer_name">Organizer Name:</label>
                                    <input type="text" class="form-control" id="name"
                                        name="organizerName">
                                        <input type="hidden" class="form-control" id="edit_organizer_id"
                                        name="id">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="text" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <!-- Add more input fields in similar row/column structure -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City:</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">State:</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="zip">ZIP Code:</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Location:</label>
                                    <input type="text" class="form-control" id="location" name="location">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="editOrganizer" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
               
            </div>
        </form>
    </div>
</div>



<div class="modal fade" id="deleteOrganizerModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog ">
        <form id="deleteForm" action="includes/db.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Organizer</h5>
                    <button type="submit" name="delete" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete this organizer?</p>
                        <input type="hidden" id="delete_organizer_id" name="id" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteOrganizer" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>




<div class="modal fade" id="ViewOrganizerModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editForm" action="includes/db.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Organizer Detail</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organizer_name">Organizer Name:</label>
                                <input type="text" class="form-control" id="view_organizerName" readonly name="organizerName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="view_email" readonly name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="text" class="form-control" readonly id="view_password" name="password">
                            </div>
                        </div>
                        <!-- Add more input fields in similar row/column structure -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" readonly id="view_address" name="address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" readonly id="view_city" name="city">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state">State:</label>
                                <input type="text" class="form-control" readonly id="view_state" name="state">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zip">ZIP Code:</label>
                                <input type="text" class="form-control" readonly id="view_zip_code" name="zip_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Location:</label>
                                <input type="text" class="form-control" readonly id="view_location" name="location">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" readonly id="view_phone" name="phone">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>





<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="addform" action="includes/db.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create organizer</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="col-form-label">Username:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username"
                                            required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="email" name="email"
                                            required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="password" name="password"
                                            required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="avatar" class="col-form-label">Avatar:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon4">
                                                <i class="fa fa-image" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="file" class="form-control" id="avatar" name="image"
                                            required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="create_organizer" class="btn btn-primary">Add</button>
                </div>
        </form>
    </div>
</div>
</div>

</div>
<!-- Content body end -->

<script>
// JavaScript function to open the modal and populate organizer's ID
function openEditModal(id, username, email, password, address, city, state, zip_code, location, phone) {

    document.getElementById("edit_organizer_id").value = id;
    document.getElementById("name").value = username;
    document.getElementById("email").value = email;
    document.getElementById("password").value = password;
    document.getElementById("address").value = address;
    document.getElementById("city").value = city;
    document.getElementById("state").value = state;
    document.getElementById("zip_code").value = zip_code;
    document.getElementById("location").value = location;
    document.getElementById("phone").value = phone;

    $("#EditOrganizerModal").modal("show");
}

function openDeleteModal(id) {
    document.getElementById("delete_organizer_id").value = id;
    $("#deleteOrganizerModal").modal("show");
}
function openViewModal(id,name,email,password,address,city,state,zip_code,location,phone) {
    
   document.getElementById("view_organizerName").value = name;
   document.getElementById("view_email").value = email;
   document.getElementById("view_password").value = password;
   document.getElementById("view_address").value = address;
   document.getElementById("view_city").value = city;
   document.getElementById("view_state").value = state;
   document.getElementById("view_zip_code").value = zip_code;
   document.getElementById("view_location").value = location;
   document.getElementById("view_phone").value = phone;
   $("#ViewOrganizerModal").modal("show");
}
</script>

<?php include("includes/footer.php"); ?>
