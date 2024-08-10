<?php
require_once "required/session.php";
require_once "required/sql.php";
require_once "required/validate.php";
require_once "access/student_only.php";
const PAGE_TITLE = "View Lesson - E-Learning System";
include_once "included/head.php";


if (isset($_GET["lesson_id"])) {
    // $query_student is gotten from validate.php
    $get_student = mysqli_fetch_assoc($query_student);
    $lesson_id = $_GET["lesson_id"];
    $faculty_id = $get_student["faculty_id"];
    $department_id = $get_student["department_id"];

    $select_lesson = "SELECT * FROM lessons WHERE id='$lesson_id' && faculty_id='$faculty_id' && department_id='$department_id' ORDER BY id DESC";
    $query_lesson = mysqli_query($con, $select_lesson);
    if (mysqli_num_rows($query_lesson) == 0) {
        $_SESSION["alert"] = "Cannot find lesson";
        header("location: lessons");
        exit;
    }
    $get_lesson = mysqli_fetch_assoc($query_lesson);
} else {
    $_SESSION["alert"] = "Cannot find lesson";
    header("location: lessons");
    exit;
}
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
                    <div class="card">
                        <div class="card-header clearfix">
                            <h4 class="card-title float-left">Topic: <u><?= $get_lesson["topic"] ?></u></h4>
                            <small class="float-right"><?= date("l, M d Y", strtotime($get_lesson["datetime"])) ?></small>
                            <?php
                            if ($get_lesson["attachment"] != "") :
                            ?>
                                <p class="float-right mr-5"><u><a href="<?= $get_lesson["attachment"] ?>" download>Attachment</a></u></p>
                            <?php
                            endif;
                            ?>
                        </div>

                        <?php
                        if ($get_lesson["video"] != "") :
                        ?>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <video class="w-100" controls controlsList="nodownload">
                                            <source src="<?= $get_lesson["video"] ?>" type="video/mp4">
                                            Your browser does not support the HTML5 video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        endif;
                        ?>
                        <div class="card-body">
                            <?= $get_lesson["content"] ?>
                        </div>
                        <div class="card-footer">
                            <a href="take-quiz?lesson_id=<?= $lesson_id ?>" class="btn btn-primary float-right">Take Quiz</a>
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
<?php
include_once "included/scripts.php";
?>