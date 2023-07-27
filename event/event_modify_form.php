<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
$id = (isset($_POST["id"]) && $_GET["id"] != '') ? $_GET["id"] : '';
$userid    = (isset($_SESSION['userid']) && $_SESSION['userid'] != "") ? $_SESSION['userid'] : "";
$userlevel = (isset($_SESSION['userlevel']) && $_SESSION['userlevel'] != "") ? $_SESSION['userlevel'] : "";
$username  = (isset($_SESSION['username']) && $_SESSION['username'] != "") ? $_SESSION['username'] : "";

?>
<!DOCTYPE html>
<html>

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
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/event.js' ?>"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php"; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php"; ?>
	</header>
	<section>
		<div id="event_box">
			<h3 id="event_title">
				게시판 > 글 쓰기
			</h3>
			<?php
			include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";


			$num = (isset($_GET["num"]) && $_GET["num"] != '') ? $_GET["num"] : '';
			$page = (isset($_GET["page"]) && $_GET["page"] != '') ? $_GET["page"] : '';

			if ($num == '' && $page == '') {
				die("
	          <script>
            alert('해당되는 정보가 없습니다.');
            history.go(-1)
            </script>           
            ");
			}

			$sql = "select * from event where num=:num";
			$stmt = $conn->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':num', $num);
			$stmt->execute();
			$row = $stmt->fetch();

			$name       = $row["name"];
			$subject    = $row["subject"];
			$content    = $row["content"];
			$file_name  = $row["file_name"];
			?>
			<form name="event_form" method="post" action="event_modify.php?num=<?= $num ?>&page=<?= $page ?>" enctype="multipart/form-data">
				<ul id="event_form">
					<li>
						<span class="col1">이름 : </span>
						<span class="col2"><?= $name ?></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input name="subject" type="text" value="<?= $subject ?>"></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content"><?= $content ?></textarea>
						</span>
					</li>
					<li>
						<span class="col1"> 첨부 파일 : </span>
						<span class="col2"><?= $file_name ?></span>
					</li>
				</ul>
				<ul class="buttons">
					<li><button type="button" id="complete">수정하기</button></li>
					<li><button type="button" onclick="location.href='event_list.php'">목록</button></li>
				</ul>
			</form>
		</div> <!-- event_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
	</footer>
</body>

</html>