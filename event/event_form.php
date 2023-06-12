<!DOCTYPE html>
<html>

< <head>
	<meta charset="utf-8">
	<title>게시판 메인 화면 </title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/project_php/css/slide.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/common.css' ?>">
	<!-- 공통 선언 js -->
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
	<!-- 따로 선언 -->
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/event.css' ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/member.js' ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/event.js' ?>"></script>
	</head>

	<body>
		<header>
			<?php
			include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php";
			include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/slide.php";
			include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
			include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/create_table.php";
			create_table($conn, "event");
			?>
		</header>

		<div id="event_box">
			<h3 id="event_title">
				이벤트 > 글 쓰기
			</h3>
			<form name="event_form" method="post" action="event_insert.php" enctype="multipart/form-data">
				<ul id="event_form">
					<li>
						<span class="col1">이름 : </span>
						<span class="col2"><?= $_SESSION["username"] ?></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input name="subject" type="text"></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content"></textarea>
						</span>
					</li>
					<li>
						<span class="col1"> 첨부 파일</span>
						<span class="col2"><input type="file" name="upfile"></span>
					</li>
				</ul>
				<ul class="buttons">
					<li><button type="button" id="complete">완료</button></li>
					<li><button onclick="location.href='event_list.php'">목록</button></li>
				</ul>
			</form>
		</div> <!-- board_box -->
		</section>
		<footer>
			<?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
		</footer>
	</body>

</html>