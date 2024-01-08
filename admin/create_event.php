<?php session_start();
if ( !isset($_SESSION['Organizer']) ) {
    header('location:login.php');
    exit;
}
include("includes/config.php");
include("includes/header.php"); ?>

<!-- Content body start -->
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Sub Events</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Sub Event</a></li>
            </ol>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Create New Sub Event</h1>
                        <form action="includes/db.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="event_type" value="sub">
                            <input type="hidden" name="category_id" value="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketName">Main Event:</label>
                                        <select name="parent_id" class="form-control" id="mainEventSelect">
                                            <option value="">Select Main Event Name</option>
                                            <?php $fetch_parent = mysqli_query($con, "SELECT * FROM `events`  WHERE `parent_id` IS  NULL AND `organizer_id` = $id AND is_deleted=0 ");
                                            foreach ($fetch_parent as $parent) { ?>
                                            <option value="<?php echo $parent['event_id']; ?>" title="<?php echo $parent['category_id']; ?>"
                                                data-start-date="<?php echo $parent['start_date']; ?>"
                                                data-end-date="<?php echo $parent['end_date']; ?>">

                                                <?php echo $parent['name']; ?>

                                            </option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ticketName">Event Name:</label>
                                        <input type="text" class="form-control" id="eventname"
                                            placeholder="Your Event Name" name="name" required>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">start_date:</label>
                                        <input class="form-control" type="date" id="start_date" name="start_date"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_time">start_time:</label>
                                        <input class="form-control" type="time" id="start_time" name="start_time"
                                            required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">end_date:</label>
                                        <input class="form-control" type="date" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_time">end_time:</label>
                                        <input class="form-control" type="time" id="end_time" name="end_time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">location:</label>
                                        <input class="form-control" type="text" id="location" name="location" required>
                                    </div>
                                </div>

                                <?php $sql = mysqli_query($con,"(SELECT category_id FROM events)");
                                $req = mysqli_fetch_assoc($sql);
                                $category_id= $req['category_id'];

                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="capacity">capacity:</label>
                                        <input class="form-control" type="number" id="capacity" name="capacity"
                                            required>
                                    </div>
                                </div>
                                
                            </div>











                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">image:</label>
                                        <input class="form-control" type="file" id="image" name="image" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Status:</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Choose">Choose</option>
                                            <option value="Upcoming">Upcoming</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="eventDescription">Description:</label>
                                        <textarea class="form-control" cols="" rows="6" id="eventDescription"
                                            name="description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="create_new" class="btn btn-primary">Create new</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('mainEventSelect').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var startDate = selectedOption.getAttribute('data-start-date');
    var endDate = selectedOption.getAttribute('data-end-date');
    var categoryId = selectedOption.getAttribute('title');


    if(categoryId == 7){
        document.getElementById('capacity').setAttribute('value', 96);
        document.getElementById('capacity').setAttribute('readonly', "readonly");
    }
    else{
        document.getElementById('capacity').setAttribute('value','');
        document.getElementById('capacity').removeAttribute('readonly');
    }

    document.getElementById('start_date').setAttribute('min', startDate);
    document.getElementById('end_date').setAttribute('min', startDate);
    document.getElementById('start_date').setAttribute('max', endDate);
    document.getElementById('end_date').setAttribute('max', endDate);
    // document.getElementById('category_id').value = categoryId;
});
</script>

<?php include("includes/footer.php"); ?>