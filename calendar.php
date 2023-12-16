<?php

include("header.php"); 
 ?>

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <!-- Breadcrumbs or other content -->
        </div>
    </div>

    <div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2"> <!-- Adjust the size as needed -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Calendar</h4>
                        <?php
    $text = "Completed Events";
    $text1 = "Ongoing Events";
    $text2 = "Upcoming Events";

    echo "<p><span style='color: red;'>$text</span> <span style='color: green;'>$text1</span>    <span style='color: blue;'>$text2</span></p>";
?>



                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box m-b-50">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Your FullCalendar initialization
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
                
            },
            events: [
                <?php
                $currentDate = date("Y-m-d");
                $ongoingEvents = mysqli_query($con, "SELECT * FROM events WHERE  start_date  = '$currentDate'");
                while ($row = mysqli_fetch_assoc($ongoingEvents)) {
                    echo "{";
                    echo "title: '" . $row['name'] . "',";
                    echo "start: '" . $row['start_date'] . "T" . $row['start_time'] . "',";
                    echo "end: '" . $row['end_date'] . "T" . $row['end_time'] . "',";
                    echo "color: 'green',"; // Customize the color as needed
                    echo "url: 'view_event.php?event_id=" . $row['event_id'] . "',"; // Include the event ID in the URL
                    echo "},";
                }

                $upcomingEvents = mysqli_query($con, "SELECT * FROM events WHERE start_date > '$currentDate'");
                while ($row = mysqli_fetch_assoc($upcomingEvents)) {
                    echo "{";
                    echo "title: '" . $row['name'] . "',";
                    echo "start: '" . $row['start_date'] . "T" . $row['start_time'] . "',";
                    echo "end: '" . $row['end_date'] . "T" . $row['end_time'] . "',";
                    echo "color: 'blue',"; // Customize the color as needed
                    echo "url: 'view_event.php?event_id=" . $row['event_id'] . "',"; // Include the event ID in the URL
                    echo "},";
                }

                $completedEvents = mysqli_query($con, "SELECT * FROM events WHERE  end_date < '$currentDate'");
                while ($row = mysqli_fetch_assoc($completedEvents)) {
                    echo "{";
                    echo "title: '" . $row['name'] . "',";
                    echo "start: '" . $row['start_date'] . "T" . $row['start_time'] . "',";
                    echo "end: '" . $row['end_date'] . "T" . $row['end_time'] . "',";
                    echo "color: 'red',"; // Customize the color as needed
                    echo "url: 'view_event.php?event_id=" . $row['event_id'] . "',"; // Include the event ID in the URL
                    echo "},";
                }
                ?>


            ],
            eventRender: function (event, element) {
                element.attr('href', 'javascript:void(0);'); // Disable the default click action
            }
        });
    });
</script>


</body>
</html>
