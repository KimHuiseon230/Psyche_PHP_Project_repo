<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";

session_start();
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";

if ($userlevel != 1) {
    echo ("
                    <script>
                    alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
                    history.go(-1)
                    </script>
        ");
    exit;
}

if (isset($_POST["item"]))
    $num_item = count($_POST["item"]);
else
    echo ("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
        ");


for ($i = 0; $i < count($_POST["item"]); $i++) {
    $num = $_POST["item"][$i];

    $sql = "select * from board where num =:num";
    $stmt = $conn->prepare($sql);;
    $stmt->bindParam(':num', $num);
    $result = $stmt->execute();
    $row = $stmt->fetch();

    $copied_name = $row["file_copied"];

    if ($copied_name) {
        $file_path = "./data/" . $copied_name;
        unlink($file_path);
    }

    $sql = "delete from board where num =:num";
    $stmt = $conn->prepare($sql);;
    $stmt->bindParam(':num', $num);
    $result = $stmt->execute();
    $row = $stmt->fetch();
}


echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
