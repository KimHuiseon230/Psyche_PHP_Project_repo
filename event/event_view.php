<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Psyche</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/slide.css?er=1' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
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
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/header.php"; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php"; ?>
	</header>
	<section>
		<div id="event_box">
			<h3 class="title">
				게시판 > 내용보기
			</h3>
			<?php
			$num = (isset($_GET["num"]) && $_GET["num"] != '') ? $_GET["num"] : '';
			$page = (isset($_GET["page"]) && $_GET["page"] != '') ? $_GET["page"] : 1;

			if ($num == "") {
				die("
	        <script>
          alert('저장되는 정보가 없습니다.,');
          history.go(-1)
          </script>           
          ");
			}

			include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";

			$sql = "select * from event where num=:num";


			$stmt = $conn->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':num', $num);
			$stmt->execute();
			$row = $stmt->fetch();

			$id      = $row["id"];
			$name      = $row["name"];
			$regist_day = $row["regist_day"];
			$subject    = $row["subject"];
			$content    = $row["content"];
			$file_name    = $row["file_name"];
			$file_type    = $row["file_type"];
			$file_copied  = $row["file_copied"];
			$hit          = $row["hit"];

			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			$new_hit = $hit + 1;


			$sql2 = "update event set hit=:new_hit where num=:num";
			$stmt2 = $conn->prepare($sql2);
			$stmt2->setFetchMode(PDO::FETCH_ASSOC);
			$stmt2->bindParam(':new_hit', $new_hit);
			$stmt2->bindParam(':num', $num);
			$stmt2->execute();
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
			<div id="write_button">
				<ul class="buttons">
					<li><button button type="button" class="btn btn-primary" onclick=" location.href='event_list.php?page=<?= $page ?>'">목록</button></li>
					<li>
						<?php
						// 로그인한 사용자인 경우에만 수정 버튼 표시
						if ((isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == '1')) {
						?>
							<form action=" event_form.php" method="post">
								<button class="btn btn-outline-success">수정</button>
								<input type="hidden" name="num" value=<?= $num ?>>
								<input type="hidden" name="page" value=<?= $page ?>>
								<input type="hidden" name="mode" value="modify">
							</form>
						<?php
						}
						?>
					</li>
					<li>
						<?php
						// 로그인한 사용자인 경우에만 수정 버튼 표시
						if ((isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == '1')) {
						?>
							<form action="event_insert.php" method="post">
								<button class="btn btn-outline-danger">삭제</button>
								<input type="hidden" name="num" value=<?= $num ?>>
								<input type="hidden" name="page" value=<?= $page ?>>
								<input type="hidden" name="mode" value="delete">
							</form>
						<?php
						}
						?>
					</li>
					<li>
					<li><button type="button" class="btn btn-outline-secondary" onclick="location.href='event_form.php'">글쓰기</button></li>
					</li>
				</ul>
			</div>
		</div> <!-- event_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/footer.php"; ?>
	</footer>
</body>

</html>