<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Psyche</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/slide.css?er=1' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/event.css' ?>">
	<!-- 공통 선언 js -->
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>" defer></script>
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
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php"; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php"; ?>
	</header>
	<section>
		<div id="event_box">
			<div id="event_box">
				<h3 class="title">
					이미지 게시판 > 내용보기
				</h3>
				<?php
				include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
				$num = $_GET["num"];
				$page = isset($page) ? $page : 1;		// $page = $_GET["page"];
				$sql = "select * from event where num=:num";
				$stmt = $conn->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->bindParam(':num', $num);
				$stmt->execute();
				$row = $stmt->fetch();


				$id = $row["id"];
				$name = $row["name"];
				$regist_day = $row["regist_day"];
				$subject = $row["subject"];
				$content = $row["content"];
				$file_name = $row["file_name"];
				$file_type = $row["file_type"];
				$file_copied = $row["file_copied"];
				$hit = $row["hit"];

				$content = str_replace(" ", "&nbsp;", $content);
				$content = str_replace("\n", "<br>", $content);
				if ($userid !== $id) {
					$new_hit = $hit + 1;
					$sql2 = "update event set hit=$new_hit where num=:num";
					$stmt2 = $conn->prepare($sql2);
					$stmt->execute();
				}
				$file_name_0 = $row['file_name'];
				$file_copied_0 = $row['file_copied'];
				$file_type_0 = $row['file_type'];
				//이미지 정보를 가져오기 위한 함수 width, height, type
				if (!empty($file_name_0)) {
					$image_info = getimagesize("./data/" . $file_copied_0);
					$image_width = $image_info[0];
					$image_height = $image_info[1];
					$image_type = $image_info[2];
					$image_width = 300;
					$image_height = 300;
					if ($image_width > 300) $image_width = 300;
				}
				?>
				<ul id="view_content">
					<li>
						<span class="col1"><b>제목 :</b> <?= $subject ?></span>
						<span class="col2"><?= $name ?> | <?= $regist_day ?></span>
					</li>
					<li>
						<?php

						if (strpos($file_type_0, "image") !== false) {
							echo "<img src='./data/$file_copied_0' width='$image_width'><br>";
						} else if ($file_name) {
							$real_name = $file_copied;
							$file_path = "./data/" . $real_name;
							$file_size = filesize($file_path);  //파일사이즈를 구해주는 함수

							echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='event_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
						}


						?>
						<?= $content ?>
					</li>
				</ul>
				<ul class="buttons">
					<li><button onclick="location.href='event_list.php?page=<?= $page ?>'">목록</button></li>
					<?php
					if ($userid == "admin") {
						echo "<li><button onclick= \"location.href='event_modify_form.php?num=$num &page= $page'\">수정</button></li>";
					} else {
						echo "<li><button hidden onclick= \"location.href='event_modify_form.php?num=$num &page= $page'\">수정</button></li>";
					}
					?>
					<?php
					if ($userid == "admin") {
						echo " <li><button onclick=\"location.href='event_delete.php?num= $num &page= $page '\">삭제</button></li>";
					} else {
						echo " <li><button hidden onclick=\"location.href='event_delete.php?num= $num &page= $page '\">삭제</button></li>";
					}
					?>
					<li><button onclick="location.href='event_form.php'">글쓰기</button></li>
				</ul>
			</div> <!-- event_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
	</footer>
</body>

</html>