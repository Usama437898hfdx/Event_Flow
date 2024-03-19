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
                <li class="breadcrumb-item"><a href="javascript:void m (0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Question Form</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">View Questions</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Questions</a></li>
            </ol>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h1 class="card-title">Create Questions</h1>
                   
                    <div>
                        <button type="button" name="create_addon" onclick="addQuestion()" class="btn btn-primary">Create
                            new</button>
                        <button type="button" name="clear_all" onclick="clearAllQuestions()"
                            class="btn btn-danger ml-2">Clear All</button>
                    </div>
                </div>


                <form action="includes/db.php" method="POST" enctype="multipart/form-data">

                    <div class="row" id="questionsContainer">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="question1">Question 1 :</label>
                                <input class="form-control" placeholder="Enter Question" type="text" name="Question[]">
                                <input class="form-control" type="hidden" name="form_id" id="form_id" value="<?php echo $_GET['fid'];?>" required>
                            </div>
                        </div>
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
                                        <input class="form-control" type="text" name="Question[]" placeholder="Enter Question">
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