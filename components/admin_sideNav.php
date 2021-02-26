<div class="border-right text-white" id="sidebar-wrapper">
    <div class="sidebar-heading">
        <img src="../img/ui.png" width="30" height="30"> Career Examination
    </div>
    <div class="list-group">
        <?php
        $links = array(
            "admin-dashboard.php" => "Dashboard",
            "add-admin.php" => "Add Admin",
            "admin.php" => "Admin List",
            "student.php" => "Student List",
            "create-exam.php" => "Create Exam",
            "suggested-courses.php" => "Suggested Courses",
            "add-suggested-courses.php" => "Add Suggested Courses"
        );
        $icons = array(
            "dashboard",
            "users",
            "th-list",
            "list",
            "book",
            "list",
            "plus"
        );
        $count = 0;
        $split = explode("/", $_SERVER["REQUEST_URI"]);
        $serverUri = $split[count($split) - 1];
        foreach ($links as $link => $title) :
            if ($serverUri == $link) :
        ?>
                <a href="<?php echo $link ?>" class="list-group-item list-group-item-action active">
                    <i class="fa fa-<?php echo $icons[$count] ?>"></i>
                    <?php echo $title ?>
                </a>
            <?php
            else :
            ?>
                <a href="<?php echo $link ?>" class="list-group-item list-group-item-action">
                    <i class="fa fa-<?php echo $icons[$count] ?>"></i>
                    <?php echo $title ?>
                </a>
        <?php
            endif;
            $count++;
        endforeach;
        ?>
    </div>
    <div class="sidebar-heading">
        <i class="fa fa-folder-open"></i> Examination List
    </div>
    <div class="list-group">
        <?php
        $links2 = array(
            "english.php" => "English",
            "math.php" => "Math",
            "science.php" => "Science",
        );
        $icons2 = array(
            "pencil",
            "calculator",
            "superscript",
        );
        $count2 = 0;
        foreach ($links2 as $link => $title) :
            if ($serverUri == $link) :
        ?>
                <a href="<?php echo $link ?>" class="list-group-item list-group-item-action active">
                    <i class="fa fa-<?php echo $icons2[$count2] ?>"></i>
                    <?php echo $title ?>
                </a>
            <?php
            else :
            ?>
                <a href="<?php echo $link ?>" class="list-group-item list-group-item-action">
                    <i class="fa fa-<?php echo $icons2[$count2] ?>"></i>
                    <?php echo $title ?>
                </a>
        <?php
            endif;
            $count2++;
        endforeach;
        ?>
    </div>
</div>