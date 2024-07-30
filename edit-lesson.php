<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/lecturer_only.php";
const PAGE_TITLE = "Edit Lesson - E-Learning System";
include_once "included/head.php";

if (isset($_GET["lesson_id"])) {
    $lesson_id = $_GET["lesson_id"];

    // $query_lecturer is gotten from validate.php
    $get_lecturer = mysqli_fetch_assoc($query_lecturer);
    $lecturer_id = $get_lecturer["id"];
    $faculty_id = $get_lecturer["faculty_id"];
    $department_id = $get_lecturer["department_id"];

    $select_course = "SELECT * FROM courses WHERE lecturer_id='" . $get_lecturer["id"] . "'";
    $query_course = mysqli_query($con, $select_course);
    if (mysqli_num_rows($query_course) == 0) {
        $_SESSION["alert"] = "You've not been assigned to a course";
        header("location: home");
        exit;
    }
    $get_course = mysqli_fetch_assoc($query_course);
    $course_id = $get_course["id"];

    $select_lesson = "SELECT * FROM lessons WHERE id='$lesson_id' && lecturer_id='" . $get_lecturer["id"] . "' && faculty_id='$faculty_id' && department_id='$department_id' && course_id='" . $course_id . "' ORDER BY id DESC";
    $query_lesson = mysqli_query($con, $select_lesson);
    if (mysqli_num_rows($query_lesson) == 0) {
        $_SESSION["alert"] = "Cannot find lesson";
        header("location: lesson");
        exit;
    }
    $get_lesson = mysqli_fetch_assoc($query_lesson);
} else {
    $_SESSION["alert"] = "Cannot find lesson id";
    header("location: lesson");
    exit;
}
require_once "func/edit-lesson.php";
?>
<div class="wrapper ">
    <?php
    include_once "included/sidebar.php";
    ?>
    <div class="main-panel">
        <?php
        include_once "included/navbar.php";
        ?>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-user">
                        <div class="card-header">
                            <h5 class="card-title">Edit Lesson</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Topic</label>
                                            <input type="text" class="form-control" name="topic" placeholder="Topic" value="<?= $get_lesson["topic"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control" value="<?= date("l d, M Y", strtotime($get_lesson["datetime"])) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between">
                                                <label>Attachment: <small>all attachments (single or multiple) must be zipped</small></label>
                                                <?php
                                                if ($get_lesson["attachment"] != "") :
                                                ?>
                                                    <p><a href="<?= $get_lesson["attachment"] ?>" download>Download Attachment</a></p>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                            <input type="file" name="attachment" style="position: relative; opacity: 100;" class="form-control" accept=".zip">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control textarea h100" id='content' name="content" placeholder="Write a description of the activity to enable the readers better understand" style="max-height: 300px !important; height: 300px !important;" required><?= $get_lesson["content"] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="ml-auto mr-auto">
                                        <button type="submit" class="btn btn-primary btn-round">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include_once "included/footer.php";
        ?>
    </div>
</div>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
<?php
include_once "included/scripts.php";
?>