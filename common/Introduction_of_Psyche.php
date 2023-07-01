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
	<style>
		.image-with-caption {
			display: flex;
			align-items: center;
			gap: 10px;
			max-width: 500px;
			margin: 100px auto;
			justify-content: center;

		}

		.image-with-caption img {
			flex: 0 0 auto;
			max-width: 600px;
			height: auto;
			margin-right: 10px;
		}

		.image-with-caption figcaption {
			font-weight: bold;
			margin-bottom: 5px;
			width: 450px;
		}

		.image-with-caption p {
			margin: 0;
		}

		.row {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}

		.content {
			width: 600px;
			font-weight: 700;
			font-size: 32px;
			line-height: 42px;
		}
	</style>
</head>


<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/header.php";
		include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";
		include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/create_table.php";
		create_table($conn, "message");
		?>
	</header>
	<div class="container ">
		<div class="row justify-content-center align-items-center mt-3">
			<p class="content">“당신이 좋아하고, 그리워하고, 찾아 헤메던 그 향기를 프시케에서 찾아드립니다.”</p>
			<p class="title-sub text-center">당신만이 알고 있던 그 향기, 그 떄의 기억을 찾아 떠나보세요. 떠올 마음에 드는 장소, 추억에 남는 상황 등 여러 가지 이유로 당신만의 향수를 만들어보세요.</p>
		</div>

		<!-- 첫번째 이미지 -->
		<div class="image-with-caption ">
			<img src="../img/test2.png" alt="">
			<div class="m-4">
				<figcaption class="content">프시케는 어떤 이유에도 제품을 만드는 과정에서 동물실험을 하지 않으며 해당 과정을 거친 원재료 또한 사용하지 않습니다.</figcaption>
				<p class="title-sub ">지구와 모두를 도울수 있는 것들을 함께 이루며 성장 하는 것을 통해 기업 윤리와 신념을 갖고 있습니다 .</p>
			</div>
		</div>
		<!-- 두번째 이미지 -->
		<div class="image-with-caption">
			<img src="../img/test1.jpg" alt="">
			<div class="m-4">
				<figcaption class="content">프시케는 당신이 찾던 그 향기를 찾아드립니다.</figcaption>
				<p class="title-sub "> 당신만이 알고 있던 그 향기, 그 떄의 기억을 찾아 떠나보세요. 떠올 마음에 드는 장소, 추억에 남는 상황 등 여러 가지 이유로 당신만의 향수를 만들어보세요.</p>
			</div>
		</div>
		<!-- 세번째 이미지 -->
		<div class="image-with-caption">
			<img src="../img/test3.png" alt="">
			<div class="m-4">
				<figcaption class="content">신선함 그리고 유지성은 저희 프시케 철학의 핵심입니다.</figcaption>
				<p class="title-sub ">신선한 과일, 채소, 에센셜 오일, 최소한의 보존제와
					안전한 인공 성분을 사용하여 제품을 선보입니다.
					프세케의 모든 제품은 베지테리언(Vegetarian)이며,
					그 중 약 90%는 식물성 원료로만 만든 비건(Vegan)입니다.</p>
			</div>

		</div>
		<!-- 네번째 이미지 -->
		<div class="image-with-caption">
			<img src="../img/test4.jpg" alt="">
			<div class="m-4">
				<figcaption class="content">이 모든 것은
					‘고객은 항상 옳다’는 믿음과
					프시케의 핵심 가치인
					직원들의 진심이 모여 얻은
					결실입니다 </figcaption>
				<p class="title-sub ">앞으로도 프시케는 아름답고 좋은 제품을 만들겠다는 진정성을 갖은 핵심가치를 두고 여러분들과 함께 성장하고 기억할수 있는 기업이 되도록 노력하겠습니다.</p>
			</div>

		</div>
	</div>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/footer.php"; ?>
	</footer>
</body>

</html>