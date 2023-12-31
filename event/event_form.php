<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>게시판 메인 화면 </title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
	<!-- 공통 선언 js -->
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
	<!-- 따로 선언 -->
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/event.css' ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/member.js' ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/event.js' ?>"></script>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>


<body>
	<header>
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
		include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/create_table.php";
		create_table($conn, "event");
		?>

	</header>
	<?php
	if (!$userid) {
		die("<script>alert('로그인 후 이용해주세요!');
						history.go(-1);
					</script>");
	}
	?>
	<section>

		<?php
		include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";

		$mode = (isset($_POST["mode"]) && $_POST["mode"] != '') ? $_POST["mode"] : "insert";
		$subject = "";
		$content = "";
		$file_name = "";

		if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
			$num = $_POST["num"];
			$page = $_POST["page"];

			$sql = "select * from event where num = :num";
			$stmt = $conn->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':num', $num);
			$stmt->execute();
			$row = $stmt->fetch();



			$name = $row["name"];
			$subject = $row["subject"];
			$content = $row["content"];
			$file_name = $row["file_name"];
			if (empty($file_name)) $file_name = "없음";
		}
		?>
		<div id="event_box">
			<h3 id="event_title">
				<?php if ($mode === "modify") : ?>
					이벤트> 수정
				<?php else : ?>
					이벤트 > 글 작성
				<?php endif; ?>
			</h3>
			<form name="event_form" method="post" action="event_insert.php" enctype="multipart/form-data">
				<?php if ($mode === "modify") : ?>
					<input type="hidden" name="num" value=<?= $num ?>>
					<input type="hidden" name="page" value=<?= $page ?>>
				<?php endif; ?>

				<input type="hidden" name="mode" value=<?= $mode ?>>
				<ul id="event_form">
					<li>
						<span class="col1">이름 : </span>
						<span class="col2"><?= $_SESSION["username"] ?></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input name="subject" type="text" value=<?= $subject ?>></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content"><?= $content ?></textarea>
						</span>
					</li>
					<li>
						<span class="col1"> 첨부 파일 : </span>
						<span class="col2"><input type="file" name="upfile">
							<?php if ($mode === "modify") : ?>
								<input type="checkbox" value="yes" name="file_delete">&nbsp;파일 삭제하기
								<br>현재 파일 : <?= $file_name ?>
							<?php endif; ?>
						</span>
					</li>
				</ul>
				<div class="buttons">
					<li>
						<button type="button" class="btn btn-success" id="complete">완료</button>
					</li>
					<li>
						<button type="button" class="btn btn-primary" onclick="location.href='event_list.php'">목록</button>
					</li>
				</div>
			</form>
		</div> <!-- event_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
	</footer>
</body>

</html>