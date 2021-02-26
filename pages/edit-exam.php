<?php
session_start();
include "../functions/conn.php";
if (!$_SESSION['admin_id']) {
    header("location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="icon" href="../img/ui.png" type="image/icon type">

    <!-- BOOTSTRAP LINK -->
    <?php include '../components/bootstrap.php'; ?>
    <link rel="stylesheet" href="../dep/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <!-- notification -->
    <link rel="stylesheet" href="../dep/minJsCss/css/notify.css">
    <link rel="stylesheet" href="../dep/minJsCss/css/prettify.css">
    <script src="../dep/minJsCss/js/notify.js"></script>
    <script src="../dep/minJsCss/js/prettify.js"></script>
    <style>
        #passwordHelpInline label {
            text-decoration: underline;
        }
    </style>
</head>

<body id="body">
    <?php #include "../components/admin_nav.php" 
    ?>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../components/admin_sideNav.php'; ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../components/admin_nav.php'; ?>
            <h5 style="margin: 10px;">Edit <?php echo $_GET['cat'] ?> Exam</h5>
            <div class="container">
                <?php
                $category = strtolower($_GET['cat']);
                $query = mysqli_query($conn, "SELECT * FROM exams WHERE category = '$category' and id = '$_GET[id]'");
                $res = mysqli_fetch_object($query);
                ?>
                <form id="formCreateExam" class="jumbotron" action="../functions/edit-exam.php" method="POST">
                    <input type="text" id="inputAns" value="<?php echo $res->answer ?>" readonly hidden>
                    <input type="text" name="id" value="<?php echo $_GET['id'] ?>" readonly hidden>
                    <div class="form-group row">
                        <label for="inputCategory" class="col-sm-2 col-form-label">Exam Category</label>
                        <div class="col-sm-10">
                            <select name="category" class="form-control custom-select" id="inputCategory" placeholder="Exam Category" required>
                                <option value="<?php echo $res->category ?>"><?php echo strtoupper($res->category[0]) . substr("$res->category", 1) ?></option>
                                <?php
                                $arrs = array(
                                    "english" => "English",
                                    "math" => "Math",
                                    "science" => "Science"
                                );
                                foreach ($arrs as $key => $value) :
                                    if ($key != $res->category) :
                                ?>
                                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputFname" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-10">
                            <textarea name="question" class="form-control" id="inputQuestion" rows="2" required><?php echo htmlspecialchars($res->question) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputMname" class="col-sm-2 col-form-label">Choices 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputC1" value="<?php echo $res->c1 ?>" name="c1" required>

                            <input type="checkbox" name="answer1" class="check" id="answerC1" aria-describedby="passwordHelpInline">
                            <small id="passwordHelpInline" class="text-muted">
                                Please check this if "Choices 1" is the <label class="text-success font-weight-bold">Answer</label>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLname" class="col-sm-2 col-form-label">Choices 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputC2" value="<?php echo $res->c2 ?>" name="c2" required>

                            <input type="checkbox" name="answer2" class="check" id="answerC2" aria-describedby="passwordHelpInline">
                            <small id="passwordHelpInline" class="text-muted">
                                Please check this if "Choices 2" is the <label class="text-success font-weight-bold">Answer</label>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Choices 3</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputC3" value="<?php echo $res->c3 ?>" name="c3" required>

                            <input type="checkbox" name="answer3" class="check" id="answerC3" aria-describedby="passwordHelpInline">
                            <small id="passwordHelpInline" class="text-muted">
                                Please check this if "Choices 3" is the <label class="text-success font-weight-bold">Answer</label>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Choices 4</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputC4" value="<?php echo $res->c4 ?>" name="c4" required>

                            <input type="checkbox" name="answer4" class="check" id="answerC4" aria-describedby="passwordHelpInline">
                            <small id="passwordHelpInline" class="text-muted">
                                Please check this if "Choices 4" is the <label class="text-success font-weight-bold">Answer</label>
                            </small>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col">
                            <button type="button" id="btnCreateExam" class="btn btn-success" style="float: right;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <script>
        $(document).ready(() => {

            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            let inputC1 = $("#inputC1");
            let inputC2 = $("#inputC2");
            let inputC3 = $("#inputC3");
            let inputC4 = $("#inputC4");

            let answerC1 = $("#answerC1");
            let answerC2 = $("#answerC2");
            let answerC3 = $("#answerC3");
            let answerC4 = $("#answerC4");

            let answer = $("#inputAns");
            let fieldsAns = [answerC1, answerC2, answerC3, answerC4];
            let fieldsInput = [inputC1, inputC2, inputC3, inputC4];
            let counter = 0
            fieldsAns.forEach((x) => {
                if (x[0].value == "on")
                    x[0].value = fieldsInput[counter][0].value
                if (x[0].value == answer.val())
                    x[0].checked = true
                counter++
            })

            inputC1.on("blur", () => {
                answerC1.attr("value", inputC1.val())
                console.log(answerC1.val())
            })

            inputC2.on("blur", () => {
                answerC2.attr("value", inputC2.val())
                console.log(answerC2.val())
            })

            inputC3.on("blur", () => {
                answerC3.attr("value", inputC3.val())
                console.log(answerC3.val())
            })

            inputC4.on("blur", () => {
                answerC4.attr("value", inputC4.val())
                console.log(answerC4.val())
            })

            answerC1.on("click", () => {
                answerC1.attr("value", inputC1.val())
                console.log(answerC1.val())
            })

            answerC2.on("click", () => {
                answerC2.attr("value", inputC2.val())
                console.log(answerC2.val())
            })

            answerC3.on("click", () => {
                answerC3.attr("value", inputC3.val())
                console.log(answerC3.val())
            })

            answerC4.on("click", () => {
                answerC4.attr("value", inputC4.val())
                console.log(answerC4.val())
            })

            $('input.check').on('change', function() {
                $('input.check').not(this).prop('checked', false);
            });

            $("#btnCreateExam").on("click", () => {
                $("#formCreateExam").each(function() {
                    let fields = ["category", "question", "c1", "c2", "c3", "c4"];
                    let errorFields = [];

                    fields.forEach((value) => {
                        let fieldVal = $(this).find(`:input[name="${value}"]`);
                        if (fieldVal.val() == "") {
                            if (fieldVal[0].name == "category") {
                                errorFields.push("Exam Category")
                            } else {
                                errorFields.push(fieldVal[0].placeholder)
                            }
                        }
                    })
                    if (!$("input[type='checkbox']").is(':checked')) {
                        errorFields.push("Answer")
                    }
                    if (errorFields.length > 0 && errorFields.length != 1) {
                        $.notify(`Fields "${errorFields.join(', ')}" are empty`, {
                            type: "danger",
                            close: true,
                            delay: 6000,
                        });
                    } else if (errorFields.length == 1 && !errorFields.includes("Answer")) {
                        $.notify(`Field "${errorFields}" is empty.`, {
                            type: "danger",
                            close: true,
                            delay: 3000,
                        });
                    } else if (errorFields.length == 1 && errorFields.includes("Answer")) {
                        $.notify(`Please select an Answer.`, {
                            type: "danger",
                            close: true,
                            delay: 3000,
                        });
                    } else {
                        $.ajax({
                            url: "../functions/checkQuestion.php",
                            type: 'POST',
                            cache: false,
                            data: {
                                ques: $("#inputQuestion").val(),
                                action: "edit",
                                id: $("input[name='id']").val()
                            },
                            success: (data) => {
                                let res = JSON.parse(data)

                                if (res.success && res.msg == "true") {
                                    $.notify(`Question "${$("#inputQuestion").val()}" already exist.`, {
                                        type: "danger",
                                        close: true,
                                        delay: 5000,
                                    });
                                } else {
                                    $("#formCreateExam").submit();
                                }
                            }
                        })
                    }
                });
            })
        })
    </script>

</body>

</html>