<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Psyche</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/project_php/css/slide.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/common.css' ?>">
    <!-- 공통 선언 js -->
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
    <!-- 따로 선언 -->
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/board.css' ?>">
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/board.js' ?>"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/board_execl.js' ?>"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/slide.php";
        include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/create_table.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/page_lib.php";
        create_table($conn, "board");
        create_table($conn, "board_ripple");
        ?>
    </header>
    <section>
        <div id="board_box">
            <h3>
                게시판 > 목록보기
            </h3>
            <ul id="board_list">
                <!-- <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">글쓴이</span>
                    <span class="col4">첨부</span>
                    <span class="col5">등록일</span>
                    <span class="col6">조회</span>
                </li> -->
                <?php
                $userid = (isset($_SESSION["userid"]) && $_SESSION["userid"] != '') ? $_SESSION["userid"] : '';
                $userlevel = (isset($_SESSION['userlevel']) && $_SESSION['userlevel'] != "") ? $_SESSION['userlevel'] : "";
                $page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;

                include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
                $sql = "select count(*) as cnt from board order by num desc";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->execute();
                $row = $stmt->fetch();
                $total_record = $row['cnt'];
                $scale = 9;             // 전체 페이지 수($total_page) 계산


                // 전체 페이지 수($total_page) 계산 
                if ($total_record % $scale == 0)
                    $total_page = floor($total_record / $scale);
                else
                    $total_page = floor($total_record / $scale) + 1;

                // 표시할 페이지($page)에 따라 $start 계산  
                $start = ($page - 1) * $scale;

                $number = $total_record - $start;
                $sql2 = "select * from board order by num desc limit {$start}, {$scale}";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt2->execute();
                $rowArray = $stmt2->fetchAll();

                foreach ($rowArray as $row) {
                    // mysqli_data_seek($result, $i);
                    // 가져올 레코드로 위치(포인터) 이동

                    // 하나의 레코드 가져오기
                    $num = $row["num"];
                    $id = $row["id"];
                    $name = $row["name"];
                    $subject = $row["subject"];
                    $regist_day = $row["regist_day"];
                    $hit = $row["hit"];
                    $file_name_0 = $row['file_name'];
                    $file_copied_0 = $row['file_copied'];
                    $file_type_0 = $row['file_type'];
                    $image_width = 200;
                    $image_height = 200;
                ?>
                    <li>
                        <span>
                            <a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>">
                                <?php
                                if (strpos($file_type_0, "image") !== false) echo "<img src='./data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                                else echo "<img src='../img/img1.png' width='$image_width' height='$image_height '><br>" ?>
                                <?= $subject ?></a><br>
                            <?= $id ?><br>
                            <?= $regist_day ?>
                        </span>
                        <!-- <span class="col1"><?= $number ?></span>
                        <span class="col2"><a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= $subject ?></a></span>
                        <span class="col3"><?= $name ?></span>
                        <span class="col4"><?= $file_image ?></span>
                        <span class="col5"><?= $regist_day ?></span>
                        <span class="col6"><?= $hit ?></span> -->
                    </li>
                <?php
                    $number--;
                }
                ?>
            </ul>

            <ul class="buttons">
                <li><button type="button" class="btn btn-outline-primary" onclick="location.href='board_list.php'">목록</button></li>
                <li>
                    <?php
                    if ((isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == '1')) {
                    ?>
                        <button type="button" class="btn btn-outline-primary" onclick="location.href='board_form.php'">글쓰기</button>
                    <?php

                    }
                    ?>
                    <button type="button" class="btn btn-outline-info" id="btn_excel">엑셀로 저장</button>

                </li>
            </ul>
        </div>
        <div class="container d-flex justify-content-center aling-items-start gap-3 mb-3">
            <?php
            $limit = 9;
            $page_limit = 9;
            echo  pagination($total_record, $limit, $page_limit, $page);
            ?>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
    </footer>
</body>

</html>