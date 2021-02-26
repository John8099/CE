<?php
session_start();
include "../functions/conn.php";
if (!$_SESSION['user_id']) {
    header("location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Page</title>
    <link rel="icon" href="../img/ui.png" type="image/icon type">

    <!-- BOOTSTRAP LINK -->
    <?php include '../components/bootstrap.php'; ?>
    <link rel="stylesheet" href="../dep/font-awesome/css/font-awesome.min.css">

    <!-- notification -->
    <link rel="stylesheet" href="../dep/minJsCss/css/notify.css">
    <link rel="stylesheet" href="../dep/minJsCss/css/prettify.css">
    <script src="../dep/minJsCss/js/notify.js"></script>
    <script src="../dep/minJsCss/js/prettify.js"></script>
    <!-- Alert -->

    <style>
        #formContent {
            -webkit-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            background: #fff;
            padding: 30px !important;
            width: 70% !important;
            position: relative;
            padding: 0px;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
        }

        .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            padding: 20px;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .questions {
            width: 100%;
            padding: 10px !important;
            border-bottom: 1px solid #eaeaea;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .questions div {
            margin-left: 30px;
        }
    </style>
</head>

<body>
    <?php include "../components/student-nav.php"; ?>

    <?php
    $array = array("english", "math", "science");
    $randomCat = [];
    while (count($randomCat) < 3) {
        $rand = $array[array_rand($array)];
        if (!in_array($rand, $randomCat)) {
            array_push($randomCat, $rand);
        }
    }

    // $arrayChoices = array("c1", "c2", "c3", "c4");
    // $randomChoices = [];
    // while (count($randomChoices) < 4) {
    //     $rand = $arrayChoices[array_rand($arrayChoices)];
    //     if (!in_array($rand, $randomChoices)) {
    //         array_push($randomChoices, $rand);
    //     }
    // }
    // var_dump($randomChoices);
    $randomCategories = json_encode(implode("|", $randomCat));
    echo "<script>sessionStorage.setItem('category', $randomCategories)</script>";
    ?>
    <div class="container-fluid">
        <div class="wrapper">
            <div id="formContent">
                <form style="padding: 10px" id="formQuestions">
                    <h3 style="padding: 10px; text-align: center;" id="labelCat"></h3>
                    <hr>
                    <div id="formBody0">
                        <fieldset class="form-group">
                            <div class="row">
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM exams WHERE category = '$randomCat[0]' ORDER BY RAND() LIMIT 10");
                                $counter0 = 1;
                                while ($row = mysqli_fetch_object($query)) :
                                ?>
                                    <div class="questions">
                                        <div class="shuffle">
                                            <label style="font-size: 20px;margin-bottom: 15px;"><?php echo $counter0 . ".) " . $row->question ?></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter0 ?>" value="<?php echo $row->c1 ?>" >
                                                <label class="form-check-label">
                                                    <?php echo $row->c1 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter0 ?>" value="<?php echo $row->c2 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c2 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter0 ?>" value="<?php echo $row->c3 ?>" >
                                                <label class="form-check-label">
                                                    <?php echo $row->c3 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter0 ?>" value="<?php echo $row->c4 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c4 ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $counter0++;
                                endwhile;
                                ?>
                            </div>
                        </fieldset>
                    </div>
                    <div id="formBody1">
                        <fieldset class="form-group">
                            <div class="row">
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM exams WHERE category = '$randomCat[1]' ORDER BY RAND() LIMIT 10");
                                $counter1 = 1;
                                while ($row = mysqli_fetch_object($query)) :
                                ?>
                                    <div class="questions">
                                        <div class="shuffle">
                                            <label style="font-size: 20px;margin-bottom: 15px;"><?php echo $counter1 . ".) " .  $row->question ?></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter1 ?>" value="<?php echo $row->c1 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c1 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter1 ?>" value="<?php echo $row->c2 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c2 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter1 ?>" value="<?php echo $row->c3 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c3 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter1 ?>" value="<?php echo $row->c4 ?>" >
                                                <label class="form-check-label">
                                                    <?php echo $row->c4 ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $counter1++;
                                endwhile;
                                ?>
                            </div>
                        </fieldset>
                    </div>
                    <div id="formBody2">
                        <fieldset class="form-group">
                            <div class="row">
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM exams WHERE category = '$randomCat[2]' ORDER BY RAND() LIMIT 10");
                                $counter2 = 1;
                                while ($row = mysqli_fetch_object($query)) :
                                ?>
                                    <div class="questions">
                                        <div class="shuffle">
                                            <label style="font-size: 20px;margin-bottom: 15px;"><?php echo $counter2 . ".) " .  $row->question ?></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter2 ?>" value="<?php echo $row->c1 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c1 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter2 ?>" value="<?php echo $row->c2 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c2 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter2 ?>" value="<?php echo $row->c3 ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row->c3 ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shuffle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="id=<?php echo $row->id ?>&&number=<?php echo $counter2 ?>" value="<?php echo $row->c4 ?>" >
                                                <label class="form-check-label">
                                                    <?php echo $row->c4 ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $counter2++;
                                endwhile;
                                ?>
                            </div>
                        </fieldset>
                    </div>
                </form>
                <div class="form-group">
                    <button type="button" id="back" class="btn btn-primary">Go Back</button>
                    <button type="button" id="previous" class="btn btn-primary">Previous</button>
                    <button type="button" id="next" class="btn btn-primary" style="float: right !important;">Next</button>
                    <button type="button" id="submit" class="btn btn-primary" style="float: right !important;">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let categories = sessionStorage.getItem("category").split('|')
        window.onload = () => {
            $("#labelCat").html(`${categories[0].toUpperCase()} Questions`);
            console.log(categories);
            $("#formBody0").show();
            $("#formBody1").hide();
            $("#formBody2").hide();
            $("#previous").hide();
            $("#submit").hide();
        }

        $("#next").on("click", () => {
            let labelTitle = $("#labelCat").html().split(" Questions")[0];
            let radios = $(`#formBody${categories.indexOf(labelTitle.toLowerCase())} input:radio:checked`).length;

            if (radios == 10) {
                if (categories.indexOf(labelTitle.toLowerCase()) == 0) {
                    $(`#formBody${categories.indexOf(labelTitle.toLowerCase())}`).hide();
                    $(`#formBody${categories.indexOf(labelTitle.toLowerCase()) + 1}`).show();
                    $("#labelCat").html(`${categories[1].toUpperCase()} Questions`);
                    $("#previous").show();
                    $("#back").hide();
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                } else if (categories.indexOf(labelTitle.toLowerCase()) == 1) {
                    $(`#formBody${categories.indexOf(labelTitle.toLowerCase())}`).hide();
                    $(`#formBody${categories.indexOf(labelTitle.toLowerCase()) + 1}`).show();
                    $("#labelCat").html(`${categories[2].toUpperCase()} Questions`);
                    $("#previous").show();
                    $("#back").hide();
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                }

                if (categories.indexOf(labelTitle.toLowerCase()) == categories.length - 2) {
                    $("#next").hide();
                    $("#submit").show();
                }
            } else {
                $.notify(`Please answer all the items in the ${labelTitle} Questions before you proceed.`, {
                    type: "danger",
                    close: true,
                    delay: 5000,
                });
            }
            console.log(radios)
        })

        $("#previous").on("click", () => {
            let labelTitle = $("#labelCat").html().split(" Questions")[0];

            if (categories.indexOf(labelTitle.toLowerCase()) == 2) {
                $(`#formBody${categories.indexOf(labelTitle.toLowerCase())}`).hide();
                $(`#formBody${categories.indexOf(labelTitle.toLowerCase()) - 1}`).show();
                $("#labelCat").html(`${categories[1].toUpperCase()} Questions`);
                $("#previous").show();
                $("#back").hide();
                $("#submit").hide();
                $("#next").show();
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
            } else if (categories.indexOf(labelTitle.toLowerCase()) == 1) {
                $(`#formBody${categories.indexOf(labelTitle.toLowerCase())}`).hide();
                $(`#formBody${categories.indexOf(labelTitle.toLowerCase()) - 1}`).show();
                $("#labelCat").html(`${categories[0].toUpperCase()} Questions`);
                $("#previous").show();
                $("#back").hide();
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
                $("#submit").hide();
                $("#next").show();
            }

            if (categories.indexOf(labelTitle.toLowerCase()) == 1) {
                $("#previous").hide()
                $("#back").show()
            }
        })

        $("#back").on("click", () => {
            window.location.href = "student-dashboard.php"
        });

        $("#submit").on("click", () => {
            Swal.fire({
                title: 'Please Wait !',
                text: "We are currently checking you answer.",
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            })
            let labelTitle = $("#labelCat").html().split(" Questions")[0];
            let radios = $(`#formBody${categories.indexOf(labelTitle.toLowerCase())} input:radio:checked`);
            console.log(radios)
            if (radios.length == 10) {
                let formData = {}
                let formRadios = $(`#formQuestions input:radio:checked`)
                for (let i = 0; i < formRadios.length; i++) {
                    formData[formRadios[i].name] = formRadios[i].value
                }
                $.ajax({
                    url: "../functions/checkAnswer.php",
                    type: "POST",
                    cache: false,
                    data: {
                        formDatas: JSON.stringify(formData)
                    },
                    success: (data) => {
                        let res = JSON.parse(data)
                        swal.close()
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                html: `Your total score is  <strong>${res.total}/${formRadios.length}</strong>.<br>Please check your results.`,
                                allowOutsideClick: false,
                                showConfirmButton: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#formQuestions').each(function() {
                                        this.reset();
                                    });
                                    window.location.href = "result.php"
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                html: `Error checking your results.<br>Please submit again.`,
                                allowOutsideClick: false,
                                showConfirmButton: true,
                            })
                        }
                    }
                })

            } else {
                $.notify(`Please answer all the items in the ${labelTitle} Questions before you proceed.`, {
                    type: "danger",
                    close: true,
                    delay: 5000,
                });
            }
        })
    </script>
</body>

</html>