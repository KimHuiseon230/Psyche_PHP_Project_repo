<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";

$num = (isset($_GET["num"]) and is_numeric($_GET["num"])) ? $_GET["num"] : '';
$page = (isset($_GET["page"]) and is_numeric($_GET["page"])) ? $_GET["page"] : '';


$sql = "select * from board where num = :num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':num', $num);
$$result = $stmt->execute();

$copied_name = $row["file_copied"];

if ($copied_name) {
	$file_path = "./data/" . $copied_name;
	unlink($file_path);
}

$sql = "delete from board where num = :num";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':num', $num);
$$result = $stmt->execute();

echo "
	     <script>
	         location.href = 'board_list.php?page=$page';
	     </script>
	   ";
