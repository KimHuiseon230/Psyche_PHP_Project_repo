<head>
	<meta charset="utf-8">
	<title>MINGMIN HOME PAGE</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/slide.css?er=1' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/common.css' ?>">
	<!-- 공통 선언 js -->
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
	<!-- 따로 선언 -->
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/event.css' ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/event.js' ?>"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php"; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/slide.php"; ?>
	</header>
	<section>
		<div id="event_box">
			<h3 class="title">
				이벤트 > 내용보기
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

			include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";


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
			?>
			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :</b> <?= $subject ?></span>
					<span class="col2"><?= $name ?> | <?= $regist_day ?></span>
				</li>
				<li>
					<?php
					if ($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/" . $real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='event_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
					}
					?>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='event_list.php?page=<?= $page ?>'">목록</button></li>
				<li><button onclick="location.href='event_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button></li>
				<li><button onclick="location.href='event_delete.php?num=<?= $num ?>&page=<?= $page ?>'">삭제</button></li>
				<li><button onclick="location.href='event_form.php'">글쓰기</button></li>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
	</footer>
</body>

</html>