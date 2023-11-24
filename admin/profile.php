<!DOCTYPE html>
<html>

<head>

    <?php session_start();
    include("includes/config.php");
    include("includes/header.php"); ?>
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
    body {
        background-color: #f4f4f4;
        font-family: 'Arial', sans-serif;
    }

    .card {
        margin-top: 50px;
        padding: 30px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .card-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"] {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px;
    }

    .modal-footer {
        justify-content: flex-end;
    }
    </style>

</head>

<body>

    <div class="content-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h1 class="form-group text-left">PROFILE</h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="user-img c-pointer position-relative" id="profileImageContainer"
                                            style="text-align: center;">
                                            <span class="activity active"></span>
                                            <img src="assets/images/avatar/<?php echo $userData['avatar']?>"
                                                style="display: inline-block; vertical-align: middle; border-radius: 50%;"
                                                height="100" width="100" alt="" id="profileImage"
                                                onclick="enlargeImage()">
                                        </div>
                                    </div>
                                </div>
                                <form id="profile" action="includes/db.php" method="POST" enctype="multipart/form-data">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo  $userData['username']; ?>" id="name" name="name">
                                        <input type="hidden" class="form-control"
                                            value="<?php echo  $userData['id']; ?>" id="id" name="id">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo  $userData['password']; ?>" id="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="phone" class="form-control"
                                            value="<?php echo  $userData['phone']; ?>" id="phone" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="zip_code">ZIP_Code:</label>
                                        <input type="number" class="form-control"
                                            value="<?php echo  $userData['zip_code']; ?>" id="zip_code" name="zip_code">
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Date_Of_Birth:</label>
                                        <input type="date" class="form-control"
                                            value="<?php echo  $userData['date_of_birth']; ?>" id="dob" name="dob">
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State:</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo  $userData['state']; ?>" id="state" name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo  $userData['email']; ?>" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo  $userData['address']; ?>" id="address" name="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City:</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo  $userData['city']; ?>" id="city" name="city">
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location:</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo  $userData['location']; ?>" id="location" name="location">
                                    </div>
                                    <div> <label for="new_avatar">New Avatar:</label>
                                        <input class="form-control" type="file" id="new_avatar" name="new_avatar">
                                    </div>
                                    <div><!-- <label for="avatar">Old Avatar:</label> -->
                                        <input type="hidden" id="avatar" name="old_avatar"
                                            value="<?php echo $userData['avatar']; ?>">
                                        <!-- <img src="images/avatar/<?php echo $userData['avatar']; ?>" id="edit_old_avatar"
                                            alt="Old Avatar" width="100"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary" name="editProfile">Save
                                        Changes</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function enlargeImage() {
            var image = document.getElementById('profileImage');
            var container = document.getElementById('profileImageContainer');
            if (image.style.width === '100px') {
                // Make it bigger
                image.style.width = '200px';
                image.style.height = '200px';
            } else {
                // Reset to the original size
                image.style.width = '100px';
                image.style.height = '100px';
            }
        }
        </script>

        <!-- Footer and Scripts -->
        <?php include("includes/footer.php"); ?>
</body>

</html>