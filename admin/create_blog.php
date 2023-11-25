    <?php
session_start();
include("includes/config.php");
include("includes/header.php");

?>



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/Rich-Text-Editor-jQuery-RichText/examples/css/site.css">
    <link rel="stylesheet" href="assets/plugins/Rich-Text-Editor-jQuery-RichText/src/richtext.min.css">



    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Sub Events</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Blog</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="page-wrapper box-content">
                        <h1 class="card-title">Create New Blog</h1>
                        <form action="includes/db.php" method="POST">
                            <input type="hidden" value="<?php echo $_GET['eid']; ?>" name="event_id" />
                            <textarea class="content" id="text" name="text"></textarea>
                            <input type="hidden" class="form-control" id="blog_id" name="blog_id" required>

                    </div>
                    <div class="text-right">
                        <button type="submit" name="create_blog" class="btn btn-primary">Create New</button>

                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>








    <?php include("includes/footer.php"); 

?>