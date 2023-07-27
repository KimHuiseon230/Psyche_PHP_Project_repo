<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>수신/송신 쪽지 보내기</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
	<!-- 공통 선언 js -->
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
	<!-- 따로 선언부 -->
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/message.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/board.css' ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/message.js' ?>"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php"; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php"; ?>
	</header>
	<section>
		<div id="message_box">
			<h3 class="title">
				<?php
				//먼저 선언을 해야하는 파일들
				include_once  $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
				$mode = (isset($_GET['mode']) && $_GET['mode'] != '') ? (int)$_GET['mode'] : '';
				$num = (isset($_GET['num']) && $_GET['num'] != '') ? (int)$_GET['num'] : '';

				$sql = "select * from message where num=:num";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':num', $num);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->execute();
				$row = $stmt->fetch();

				// 보낸 사용자의 정보
				date_default_timezone_set('Asia/Seoul');
				$regist_day = date("Y-m-d (H:i)");
				$rv_id = isset($row["rv_id"]) ? $row["rv_id"] : '';
				$send_id = isset($row["send_id"]) ? $row["send_id"] : '';
				$subject = isset($row["subject"]) ? $row["subject"] : '';
				$content = isset($row["content"]) ? $row["content"] : '';
				$content = str_replace(" ", "&nbsp;", $content);
				$content = str_replace("\n", "<br>", $content);;

				if ($mode == "send")
					$sql2 = "select name from members where id='$rv_id'";
				else
					$sql2 =  "select name from members where id='$send_id'";

				$stmt2 = $conn->prepare($sql2);
				$stmt2->setFetchMode(PDO::FETCH_ASSOC);
				$stmt2->execute();
				$record = $stmt2->fetch();
				$msg_name = isset($record["name"]) ? $record["name"] : '';

				if ($mode == "send")
					echo "송신 쪽지함 > 내용보기";
				else
					echo "수신 쪽지함 > 내용보기";
				?>
			</h3>
			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :</b> <?= $subject ?></span>
					<span class="col2"><?= $msg_name ?> | <?= $regist_day ?></span>
				</li>
				<li>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<li><button type="button" class="btn btn-secondary" onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button type="button" class="btn btn-secondary" onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
				<li><button type="button" class="btn btn-secondary" onclick="location.href='message_response_form.php?num=<?= $num ?>'">답변 쪽지</button></li>
				<li><button type="button" class="btn btn-secondary" onclick="location.href='message_delete.php?num=<?= $num ?>&mode=<?= $mode ?>'">삭제</button></li>
			</ul>
		</div> <!-- message_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
	</footer>
</body>

</html>