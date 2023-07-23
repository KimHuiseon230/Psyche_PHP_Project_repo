<head>
    <meta charset="utf-8">
    <title>Psyche</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
    <!-- 공통 선언 js -->
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
    <!-- 따로 선언 -->
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/event.css' ?>">
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/event.js' ?>"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/event_execl.js' ?>"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php";
        include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/create_table.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/page_lib.php";
        create_table($conn, "event");
        ?>
    </header>
    <section>
        <div id="event_box">
            <h3>
                이벤트 > 목록보기
            </h3>
            <ul id="event_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">글쓴이</span>
                    <span class="col4">첨부</span>
                    <span class="col5">등록일</span>
                    <span class="col6">조회</span>
                </li>
                <?php

                $page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;

                include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
                $sql = "select count(*) as cnt from event order by num desc";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->execute();
                $row = $stmt->fetch();
                $total_record = $row['cnt'];
                $scale = 10;             // 전체 페이지 수($total_page) 계산
                $limit = 5;
                // 전체 페이지 수($total_page) 계산 
                if ($total_record % $scale == 0)
                    $total_page = floor($total_record / $scale);
                else
                    $total_page = floor($total_record / $scale) + 1;

                // 표시할 페이지($page)에 따라 $start 계산  
                $start = ($page - 1) * $scale;

                $number = $total_record - $start;
                $sql2 = "select * from event order by num desc limit {$start}, {$scale}";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt2->execute();
                $rowArray = $stmt2->fetchAll();

                foreach ($rowArray as $row) {
                    // mysqli_data_seek($result, $i);
                    // 가져올 레코드로 위치(포인터) 이동

                    // 하나의 레코드 가져오기
                    $num         = $row["num"];
                    $id          = $row["id"];
                    $name        = $row["name"];
                    $subject     = $row["subject"];
                    $regist_day  = $row["regist_day"];
                    $hit         = $row["hit"];
                    if ($row["file_name"])
                        $file_image = "<img src='./img/file.gif'>";
                    else
                        $file_image = " ";
                ?><li>
                        <span class="col1"><?= $number ?></span>
                        <span class="col2"><a href="event_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= $subject ?></a></span>
                        <span class="col3"><?= $name ?></span>
                        <span class="col4"><?= $file_image ?></span>
                        <span class="col5"><?= $regist_day ?></span>
                        <span class="col6"><?= $hit ?></span>
                    </li>
                <?php
                    $number--;
                }

                ?>
            </ul>

            <ul class="buttons">
                <li><button type="button" class="btn btn-outline-primary" onclick="location.href='event_list.php'">목록</button></li>
                <li>
                    <?php
                    if ($userid) {
                    ?>
                        <button type="button" class="btn btn-outline-primary" onclick="location.href='event_form.php'">글쓰기</button>
                    <?php
                    } else {
                    ?>
                        <a href="javascript:alert('로그인 후 이용해 주세요!')"><button class="btn btn-outline-primary">글쓰기</button></a>
                    <?php
                    }

                    ?>
                    <button type="button" class="btn btn-outline-info" id="btn_excel">엑셀로 저장</button>

                </li>
            </ul>
        </div>
        <div class="container d-flex justify-content-center aling-items-start gap-3 mb-3">
            <?php
            $page_limit = 5;
            echo  pagination($total_record, $limit, $page_limit, $page);
            ?>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
    </footer>
</body>

</html>