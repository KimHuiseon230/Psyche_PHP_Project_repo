<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Psyche</title>
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/slide.css?er=1' ?>">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/common.css' ?>">
	<!-- 공통 선언 js -->
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>" defer></script>
	<!-- 따로 선언 -->
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/board.css' ?>">
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/member.js' ?>"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/board.js' ?>"></script>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php"; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/slide.php"; ?>
	</header>
	<section>
		<div id="board_box">
			<h3 class="title">
				제품 > 내용
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

			$sql = "select * from board where num=:num";


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


			$sql2 = "update board set hit=:new_hit where num=:num";
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
			       		<a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
					}
					?>
					<?= $content ?>
				</li>
			</ul>
			<!--댓글 내용시작  -->
			<div id="ripple">
				<div id="ripple1">덧글</div>
				<div id="ripple2">
					<?php
					$sql = "select * from `board_ripple` where parent=:num ";
					$stmt3 = $conn->prepare($sql);
					$stmt3->setFetchMode(PDO::FETCH_ASSOC);
					$stmt3->bindParam(':num', $num);
					$stmt3->execute();
					$rowArray = $stmt3->fetchALl();

					foreach ($rowArray as $row) {
						$ripple_num = $row['num'];
						$ripple_id = $row['id'];
						$ripple_nick = $row['nick'];
						$ripple_date = $row['regist_day'];
						$ripple_content = $row['content'];
						$ripple_content = str_replace("\n", "<br>", $ripple_content);
						$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);

					?>
						<div id="ripple_title">
							<ul>
								<li><?= $ripple_id . "&nbsp;&nbsp;" . $ripple_date ?></li>
								<li id="mdi_del">
									<?php
									if ($_SESSION['userid'] == "admin" || $_SESSION['userid'] == $ripple_id) {
										echo '
                                               <form style="display:inline" action="board_insert.php" method="post">
													    <input type="hidden" name="page" value="' . $page . '">
													    <input type="hidden" name="hit" value="' . $hit . '">
													    <input type="hidden" name="mode" value="delete_ripple">
													    <input type="hidden" name="num" value="' . $ripple_num . '">
													    <input type="hidden" name="parent" value="' . $num . '">
													    <span>' . $ripple_content . '</span>
													    <input type="submit" value="삭제">
													    </form>';
									}
									?>
								</li>
							</ul>
						</div>
						<!--									<div id="ripple_content">-->
						<!--                                        --><? //= $ripple_content 
																														?>
						<!--									</div>-->
					<?php
					} //end of while
					?>

					<form name="ripple_form" action="board_insert.php" method="post">
						<input type="hidden" name="mode" value="insert_ripple">
						<input type="hidden" name="parent" value="<?= $num ?>">
						<input type="hidden" name="hit" value="<?= $hit ?>">
						<input type="hidden" name="page" value="<?= $page ?>">
						<div id="ripple_insert">
							<div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80"></textarea></div>
							<div id="ripple_button"><input type="image" src="./img/memo_ripple_button.png">
							</div>
						</div><!--end of ripple_insert -->
					</form>
				</div><!--end of ripple2  -->
			</div><!--end of ripple  -->
			<div id="write_button">
				<ul class="buttons">
					<li><button button type="button" class="btn btn-primary" onclick=" location.href='board_list.php?page=<?= $page ?>'">목록</button></li>
					<li>
						<?php
						// 로그인한 사용자인 경우에만 수정 버튼 표시
						if ((isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == '1')) {
						?>
							<form action=" board_form.php" method="post">
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
							<form action="board_insert.php" method="post">
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
					<li><button type="button" class="btn btn-outline-secondary" onclick="location.href='board_form.php'">글쓰기</button></li>
					</li>
				</ul>
			</div>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
	</footer>
</body>

</html>