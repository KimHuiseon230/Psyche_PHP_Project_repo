<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";

$num = (isset($_GET["num"]) and is_numeric($_GET["num"])) ? $_GET["num"] : '';
$sql = "delete from members where num=:num";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':num', $num);
$result = $stmt->execute();

if (!$result) {
  die("<script>
    alert('데이터 삭제 오류');
    history.go(-1);
    </script>");
}
echo "
  <script>
  alert('성공적으로 삭제되었습니다');
    self.location.href = 'http://{$_SERVER['HTTP_HOST']}/Psyche_PHP_Project/member/member_list.php'
  </script>
";
// mysqli_close($conn);
