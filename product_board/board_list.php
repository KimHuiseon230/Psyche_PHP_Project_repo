<!DOCTYPE html>
<html>

<?php
// 공통적으로 처리하는 부분
$js_array = ['/product_board/js/board.js', '/product_board/js/board_form.php',  '/product_board/js/board_excel.js'];
$title = "게시판";
$menu_code = "board";
?>

<head>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/product_board/css/board.css?v=<?= date('Ymdhis') ?>">
</head>

<body>
    <header>
        <?php
        $userid    = (isset($_SESSION['userid']) && $_SESSION['userid'] != "") ? $_SESSION['userid'] : "";
        $username  = (isset($_SESSION['username']) && $_SESSION['username'] != "") ? $_SESSION['username'] : "";
        include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
        include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/create_table.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/page_lib.php";
        create_table($conn, "product_board");
        create_table($conn, "product_board_ripple");
        ?>
    </header>
    <section>
        <div id="board_box">
            <h3>
                제품 > 목록보기
            </h3>
            <ul id="board_list">
                <?php
                if (isset($_GET["page"]))
                    $page = $_GET["page"];
                else
                    $page = 1;

                $page = (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;
                $sql = "select count(*) as cnt from product_board order by num desc";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->execute();
                $row = $stmt->fetch();
                $total_record = $row['cnt'];
                $scale = 10;

                // 표시할 페이지($page)에 따라 $start 계산  
                $start = ($page - 1) * $scale;

                $number = $total_record - $start;
                $sql2 = "select * from  product_board order by num desc limit {$start}, {$scale}";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt2->execute();
                $rowArray = $stmt2->fetchAll();

                foreach ($rowArray as $row) {
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
                    $image_width = 250;
                    $image_height = 250;
                ?>
                    <li>
                        <span>
                            <a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>">
                                <?php if (strpos($file_type_0, "image") !== false) echo "<img src='./data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                                else echo "<img src='./img/user.jpg' width='$image_width' height='$image_height'><br>" ?>
                                <?= $subject ?></a><br>
                            <?= $id ?><br>
                            <?= $regist_day ?>
                        </span>
                    </li>
                <?php
                    $number--;
                }
                ?>
            </ul>



            <div class="container d-flex justify-content-center align-items-start mb-3 gap-3">
                <?php
                $set_page_limit = 5;
                echo pagination($total_record, $scale, $set_page_limit, $page);
                ?>
                <button type="button" class="btn btn-outline-dark " id="btn_excel">엑셀로 저장</button>
            </div>

            <ul class="buttons">
                <li>
                    <button onclick="location.href='board_list.php'">목록</button>
                </li>
                <li>
                    <?php
                    if ($userid) {
                    ?>
                        <button onclick="location.href='board_form.php'">글쓰기</button>
                    <?php
                    } else {
                    ?>
                        <a href="javascript:alert('로그인 후 이용해 주세요!')">
                            <button>글쓰기</button>
                        </a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div> <!-- board_box -->
    </section>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
    </footer>
</body>

</html>