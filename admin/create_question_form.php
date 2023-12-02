<?php session_start();
include("includes/config.php");
include("includes/header.php"); ?>

<!-- Content body start -->
<div class="content-body">
    <!-- Breadcrumbs -->
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void m (0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Addons</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Addons</a></li>
            </ol>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1 class="card-title">Create Question Form</h1>
                            <div>
                                <button type="button" name="create_addon" onclick="addQuestion()"
                                    class="btn btn-primary">Create new</button>
                                <button type="button" name="clear_all" onclick="clearAllQuestions()"
                                    class="btn btn-danger ml-2">Clear All</button>
                            </div>
                        </div>


                        <form action="includes/db.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_id">Event:</label>
                                        <select name="event_id" class="form-control">
                                            <?php
                                            $fetch_event = mysqli_query($con, "SELECT * FROM `events` WHERE `parent_id` IS NOT NULL AND `is_deleted` = 0 AND `is_active` = 1 AND `organizer_id` = '" . $_SESSION['Organizer']['id'] . "'");
                                            foreach ($fetch_event as $event) {
                                                ?>
                                                <option value="<?php echo $event['event_id']; ?>">
                                                    <?php echo $event['name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question1">Question 1 :</label>
                                        <input class="form-control" placeholder="Enter Full Name" readonly  value="Enter your Full Name" type="text"
                                            name="Question[]">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="questionsContainer">
                            </div>
                            <button type="submit" name="add_questions" class="btn btn-success">Submit Form</button>
                        </form>
                        <script>
                            var number = 2;
                            function addQuestion() {
                                var questionsContainer = document.getElementById("questionsContainer");
                                var input = `<div class="col-md-6">
                                <div class="form-group">
                                    <label for="question">Question ${number}</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="Question[]" placeholder="Enter Question ${number}">
                                        <button type="button" class="btn btn-danger ml-2" onclick="removeQuestion(this)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>`;
                                questionsContainer.innerHTML += input;
                                number++;
                            }
                            function removeQuestion(button) {
                                var questionDiv = button.parentNode.parentNode.parentNode;
                                var questionsContainer = document.getElementById("questionsContainer");
                                questionsContainer.removeChild(questionDiv);
                            }
                            function clearAllQuestions() {
                                var questionsContainer = document.getElementById("questionsContainer");
                                questionsContainer.innerHTML = ''; 
                                number = 2;
                            }
                        </script>


                    </div>
                </div>
            </div>
        </div>

<?php include("includes/footer.php"); ?>