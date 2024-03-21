<?php


session_start();
include("config.php");


//For sign up page
if (isset($_POST["signup"])) {
    // Fetch data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $targetDirectory = "../assets/images/avatar/";
    $avatar = $_FILES["avatar"]["name"];

    $targetFile = $targetDirectory . basename($_FILES["avatar"]["name"]);

    $avatarFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($avatarFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["avatar"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "Invalid file type. Please upload only JPG, JPEG, PNG, or GIF files.";
    }

    $sql = mysqli_query($con, "INSERT INTO `users` (`username`, `email`, `password`, `role`, `avatar`) VALUES ('$username', '$email', '$password', '$role', '$avatar')");
    if ($sql) {
        header("location:../login.php");
        exit;
    }
}



//login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($con, $query);

    if ($result) {

        if (mysqli_num_rows($result) == 1) {
            foreach ($result as $user)
                ;
            echo $role = $user['role'];
            $_SESSION['uid'] = $user['id'];
            $_SESSION[$role] = $user;
            $_SESSION['amount'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['name'];
            
            
            header("location: ../../index.php");
            exit();
        } else {
            echo "Invalid credentials. Please check your email and password.";
        }
    } else {
        echo "Error in query execution: " . mysqli_error($con);
    }
}



//Create organizer
if (isset($_POST['create_organizer'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $targetDirectory = "../images/avatar/";
    $image = $_FILES["image"]["name"];
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid file type. Please upload only JPG, JPEG, PNG, or GIF files.";
    }

    $insert = mysqli_query($con, "INSERT INTO `users`(`username`, `email`, `password`,`avatar`,`role`) VALUES ('$name','$email','$password','$image','Organizer')");
    if ($insert) {
        header("location:../users.php");
        exit();
    } else {
        echo "User not inserted";
    }
}

//delete organizer
if (isset($_POST["deleteOrganizer"])) {
    $id = $_POST["id"];
    $delete_user = mysqli_query($con, "UPDATE `users` SET `is_deleted`= 1 WHERE `id` = '$id'");
    if ($delete_user) {
        header("location: ../users.php");
        exit;
    }
}

//edit organizer
if (isset($_POST["editOrganizer"])) {
    $id = $_POST["id"];
    $username = $_POST["organizerName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip_code = $_POST["zip_code"];
    $location = $_POST["location"];
    $phone = $_POST["phone"];

    // Assuming $con is your database connection
    $edit_user = mysqli_query($con, "UPDATE `users` SET `username`='$username', `email`='$email', `password`='$password', `address`='$address', `city`='$city', `state`='$state', `zip_code`='$zip_code', `location`='$location', `phone`='$phone' WHERE `id`= '$id' ");

    if ($edit_user) {
        header("location: ../users.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Display error, if any
    }
}


//edit userprofile
if (isset($_POST["editProfile"])) {
    $id = $_POST["id"];
    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip_code = $_POST["zip_code"];
    $location = $_POST["location"];
    $phone = $_POST["phone"];
    $old_avatar = $_POST["old_avatar"];

    if (!empty($_FILES['new_avatar']['name'])) {
        $avatar = $_FILES['new_avatar']['name'];
        $image = '../assets/images/avatar/' . basename($_FILES['new_avatar']['name']);
        move_uploaded_file($_FILES['new_avatar']['tmp_name'], $image);
    } else {
        // Use the old image name if no new image is provided
        $avatar = $old_avatar;
    }
    // Assuming $con is your database connection
    $edit_user = mysqli_query($con, "UPDATE `users` SET `username`='$username', `email`='$email', `password`='$password', `address`='$address', `city`='$city', `state`='$state', `zip_code`='$zip_code', `location`='$location', `phone`='$phone' , `avatar`='$avatar' WHERE `id`='$id' ");

    if ($edit_user) {
        header("location: ../profile.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Display error, if any
    }
}



//Create new Event
if (isset($_POST['create_new'])) {
    $parent_id= $_POST['parent_id'];
    $org_id = $_SESSION['uid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $category_id= $_POST['category_id'];

    $targetDirectory = "../../assets/images/events/";
    $image = $_FILES["image"]["name"];

    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "Invalid file type. Please upload only JPG, JPEG, PNG, or GIF files.";
    }


    if ($_POST['event_type'] == "main") {

        $insert = mysqli_query($con, "INSERT INTO `events`(`event_id`, `category_id`,`name`,`start_date`,`end_date`,`image`,`description`,`organizer_id`) VALUES ('$id','$category_id','$name','$start_date','$end_date','$image','$description','$org_id')"); 
        if ($insert) {
            header("location:../main_events.php");
            exit();
        } else {
            echo "User not inserted";
        }
    } else {
        $q = mysqli_query($con,"(select category_id from events where event_id = $parent_id)");
        $req = mysqli_fetch_assoc($q);
        $cat = $req['category_id'];
        $insert = mysqli_query($con, "INSERT INTO `events`(`parent_id`,`category_id`,`event_id`, `name`, `description`, `Status`, `start_date`, `end_date`, `start_time`, `end_time`, `location`, `capacity`, `image`,`organizer_id`) VALUES ('$parent_id',$cat,'$id','$name','$description','$status','$start_date','$end_date','$start_time','$end_time','$location','$capacity','$image','$org_id')");
        if ($insert) {
            header("location:../events.php");
            exit();
        } else {
            echo "User not inserted";
        }

    }
}

//Delete Sub event
if (isset($_POST["deleteEvent"])) {
    $id = $_POST["id"];

    $delete_event = mysqli_query($con, "UPDATE `events` SET `is_deleted`= 1  WHERE `event_id` = '$id'");
    if ($delete_event) {

        header("location: ../events.php");
        exit;


    }
}

//Edit Sub event
if (isset($_POST["editEvent"])) {
    $id = $_POST['event_id'];
    $name = $_POST['eventname'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $seats = $_POST['seats'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $oldImage = $_POST['old_image'];
    $newImage = $_FILES['new_image']['name'];

    if (!empty($newImage)) {

        $targetDirectory = "../../assets/images/events/"; // Change the directory as per your configuration
        $targetFile = $targetDirectory . basename($_FILES["new_image"]["name"]);
        $image = $_FILES['new_image']['name'];

        if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $targetFile)) {
        }
    } else {
        $image = $oldImage;
    }
    $edit_event = mysqli_query($con, "UPDATE `events` SET `event_id`='$id',`name`='$name',`description`='$description',`start_date`='$start_date',`end_date`='$end_date',`start_time`='$start_time',`end_time`='$end_time',`seats`='$seats',`location`='$location',`capacity`='$capacity',`image` = '$image' WHERE `event_id`= '$id' ");

    // Assuming $con is your database connection
    // $edit_event = mysqli_query($con, "UPDATE `events` SET `id`='$id',`name`='$name',`description`='$description',`start_date`='$start_date',`end_date`='$end_date',`start_time`='$start_time',`end_time`='$end_time',`seats`='$seats',`location`='$location',`capacity`='$capacity',`image`='$image'WHERE `id`= '$id' ");

    if ($edit_event) {
        header("location: ../events.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Display error, if any
    }
}


//Delete Main event
if (isset($_POST["deleteMainEvent"])) {
    $id = $_POST["id"];

    $delete_event = mysqli_query($con, "UPDATE `events` SET `is_deleted`= 1  WHERE `event_id` = '$id'");
    if ($delete_event) {
        $delete_event = mysqli_query($con, "UPDATE `events` SET `is_deleted`= 1  WHERE `parent_id` = '$id'");

        header("location: ../main_events.php");
        exit;


    }
}

//Edit Main event
if (isset($_POST["editMainEvent"])) {
    $id = $_POST['event_id'];
    $name = $_POST['eventname'];
    $description = $_POST['description'];   
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $oldImage = $_POST['old_image'];
    $newImage = $_FILES['new_image']['name'];

    if (!empty($newImage)) {

        $targetDirectory = "../assets/images/events/";
        $targetFile = $targetDirectory . basename($_FILES["new_image"]["name"]);
        $image = $_FILES['new_image']['name'];

        if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $targetFile)) {
        }
    } else {
        $image = $oldImage;
    }
    $edit_main_event = mysqli_query($con, "UPDATE `events` SET `event_id`='$id',`name`='$name',`image` = '$image' , `start_date` = '$start_date' , `end_date` = '$end_date' , `description` = '$description' WHERE `event_id`= '$id' ");

    if ($edit_main_event) {
        header("location: ../main_events.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Display error, if any
    }
}



// Create Blogs 
if (isset($_POST["create_blog"])) {
    $blog_id = $_POST['blog_id'];
    $id = $_POST['event_id'];
    $text = $_POST['text'];
    
  $insert = mysqli_query($con, "INSERT INTO `blog`(`blog_id`, `event_id`, `text`) VALUES ('$blog_id', '$id','$text')");
      if ($insert) {
      header("location:../Blogs.php");
      exit();
      } else {
     echo "Blog not inserted";
     }
}
//Delete Blogs
if (isset($_POST["deleteBlog"])) {

     $Blog_id = $_POST["blog_id"];
 
 $delete_blog = mysqli_query($con, "UPDATE `blog` SET `is_deleted`= 1  WHERE `blog_id` = '$Blog_id'");
  if ($delete_blog) {
 
 header("location: ../blogs.php");
 exit;
 
 } 
}
 
 

// Create Ticket
if (isset($_POST['create_ticket'])) {
    $event_id = $_POST['event_id'];
    $ticket_type_id = $_POST['ticket_type_id'];
    $discount = $_POST['discount'];

    // Fetch event capacity
    $fetch_event = mysqli_query($con, "SELECT `capacity` FROM `events` WHERE `event_id` = '$event_id'");
    $events = mysqli_fetch_assoc($fetch_event);
    $capacity = $events['capacity'];

    // Get the number of tickets already created
    $fetch_created_tickets = mysqli_query($con, "SELECT COUNT(*) as total_tickets FROM ticket WHERE `event_id` = '$event_id'");
    $created_tickets = mysqli_fetch_assoc($fetch_created_tickets);
    $remaining_capacity = $capacity - $created_tickets['total_tickets'];

    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($quantity > 0 && $quantity <= $remaining_capacity) {
        for ($i = 0; $i < $quantity; $i++) {
            // Insert ticket
            $insert_ticket_query = "INSERT INTO ticket (event_id, ticket_type_id, discount,Qrcode) 
                                    VALUES ('$event_id', '$ticket_type_id', '$discount',UUID())";
            $result_ticket = mysqli_query($con, $insert_ticket_query);

            if ($result_ticket) {
                $ticket_id = mysqli_insert_id($con);

                // Insert selected addons for each ticket
                if (isset($_POST['addons']) && is_array($_POST['addons'])) {
                    foreach ($_POST['addons'] as $addon_id) {
                        $insert_addon_query = "INSERT INTO ticket_addons (ticket_id, addon_id) VALUES ('$ticket_id', '$addon_id')";
                        mysqli_query($con, $insert_addon_query);
                    }
                }
            }
        }

        header("Location: ../ticket.php");
        exit();
    } else {
        echo "Error: Invalid quantity or capacity exceeded!";
        exit();
    }
}
//delete ticket
if (isset($_POST["deleteticket"])) {

    $tt_id = $_POST["tt_id"];

    $delete_ticket = mysqli_query($con, "UPDATE `ticket` SET `is_deleted`= 1 WHERE `ticket_type_id` = '$tt_id'");
    if ($delete_ticket) {
        header("location: ../ticket.php?tt_id=$tt_id");
        exit();
    }
}
//edit ticket
if (isset($_POST["editticket"])) {
    $ticket_Id = $_POST["ticket_id"];
    $ticket_type_id = $_POST["ticket_type_id"];
    $ticket_name = $_POST["ticket_type_name"];
    $price = $_POST["price"];
    $discount = $_POST["discount"];
    $addon_id = $_POST["addon_id"];
    $capacity = $_POST["capacity"];

    // Assuming $con is your database connection
    $edit_ticket = mysqli_query($con, "UPDATE `ticket` SET  `ticket_type_id`='$ticket_type_id', `name`='$ticket_name', `price`='$price', `discount`='$discount', `addon_id`='$addon_id', `capacity`='$capacity' WHERE `ticket_id`= '$ticket_Id' ");

    if ($edit_ticket) {
        header("location: ../ticket.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Display error, if any
    }
}



//Create ticket type
if (isset($_POST['create_ticket_type'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $event_id = $_POST["event_id"];
    $temp = $_POST["temp_id"];

    $insert = mysqli_query($con, "INSERT INTO `ticket_type`(`name`, `price`,`event_id`,`temp_id`) VALUES ('$name','$price','$event_id','$temp')");
    if ($insert) {
        header("location:../ticket_types.php");
        exit();
    } else {
        echo "User not inserted";
    }
}

//delete ticket type
if (isset($_POST["deleteTicket_type"])) {

    $ticket_type_id = $_POST["ticket_type_id"];
    $ticket_type = mysqli_query($con, "UPDATE `ticket_type` SET `is_deleted`= 1 WHERE `ticket_type_id` = '$ticket_type_id'");
    if ($ticket_type) {
        header("location: ../ticket_types.php");
        exit();
    }
}
//edit ticket type
if (isset($_POST["edit_ticket_type"])) {
    $ticket_type_id = $_POST["ticket_type_id"];
    $event_id = $_POST["event_id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    // Assuming $con is your database connection
    $ticket_type = mysqli_query($con, "UPDATE `ticket_type` SET `name`='$name', `price`='$price' ,`event_id` = '$event_id' WHERE `ticket_type_id`= '$ticket_type_id' ");

    if ($ticket_type) {
        header("location: ../ticket_types.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Display error, if any
    }
}



//create addon
if (isset($_POST['create_addon'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
  $Organizer = $_SESSION['Organizer']['id'];
    $insert = mysqli_query($con, "INSERT INTO `addon`(`organizer_id`,`name`, `price`) VALUES ('$Organizer','$name','$price')");
    if ($insert) {
        header("location:../Addons.php");
        exit();
    } else {
        echo "User not inserted";
    }
}
// delete addon
if (isset($_POST["deleteAddon"])) {

    $addon_id = $_POST["addon_id"];
    $DeleteAddon = mysqli_query($con, "UPDATE `addon` SET `is_deleted`= 1 WHERE `Addon_id` = '$addon_id'");
    if ($DeleteAddon) {
        header("location: ../Addons.php");
        exit();
    }
}
// edit addon
if (isset($_POST["edit_addon"])) {
    $addon_id = $_POST["addon_id"];
    $name = $_POST["name"];
    $price = $_POST["price"];

    $addon = mysqli_query($con, "UPDATE `addon` SET `name`='$name', `price`='$price'  WHERE `Addon_id`= '$addon_id' ");

    if ($addon) {
        header("location: ../Addons.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Display error, if any
    }
}




// create question form
if (isset($_POST["add_form"])) {

    $form_id = $_POST["form_id"];
    $event_id = $_POST["event_id"];
    
    $Organizer = $_SESSION['Organizer']['id'];
        $insertform =  mysqli_query($con,"INSERT INTO `registration_form` (`form_id`,`event_id`,`organizer_id`) VALUES ('$form_id','$event_id',$Organizer)");
       
    
    if ($insertform) {
        header("location:../question_form.php");
        exit();
    } else {
        echo "form not inserted";
    }
}



// Add registration question
if (isset($_POST["add_questions"])) {

    $question_id = $_POST["question_id"];
    $form_id = $_POST["form_id"];
    $questionsArray = $_POST["Question"];
    
 
    foreach ($questionsArray as $Question) {
        $Question = mysqli_real_escape_string($con, $Question);
        $insertRegistration =  mysqli_query($con,"INSERT INTO `registrationquestions` (`question_id`,`form_id`,`Question`) VALUES ('$question_id','$form_id','$Question')");
       
    }

    header("location: ../question_form.php");
    exit();
}

// delete registration question
if (isset($_POST["delete_question"])) {

    $question_id = $_POST["question_id"];
    $Deletequestion = mysqli_query($con, "UPDATE `registrationquestions` SET `is_deleted`= 1 WHERE `question_id` = '$question_id'");
    if ($Deletequestion) {
        header("location: ../view_questions.php");
        exit();
    }
}

//Add event categories
if (isset($_POST['create_category'])) {

    $category_id = $_POST["category_id"];
    $name = $_POST['category_name'];
    

    $insert = mysqli_query($con, "INSERT INTO `event_categories`(`category_id`,`name`) VALUES ('$category_id','$name')");
    if ($insert) {
        header("location:../categories.php");

        exit();
    } else {
        echo "category not inserted";
    }
}
// delete event categories
if (isset($_POST["delete_Category"])) {

    $category_id = $_POST["category_id"];
    $DeleteAddon = mysqli_query($con, "UPDATE `event_categories` SET `is_deleted`= 1 WHERE `category_id` = '$category_id'");
    if ($DeleteAddon) {
        header("location: ../categories.php");
        exit();
    }
}



?>