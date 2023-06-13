<html>

<head>
  <meta charset="utf-8">
  <title>쪽지함</title>
  <!-- 공통 선언 css -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/project_php/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/common.css' ?>">
  <!-- 공통 선언 js -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
  <!-- 따로 선언부 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/message.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/board.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/message.js' ?>"></script>
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
  <style>
    .image-with-caption {
      display: flex;
      align-items: center;
      gap: 10px;
      max-width: 500px;
      margin: 10px auto;
      justify-content: center;
      height: 80vh;
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
      width: 400px;
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
      text-align: center;
      font-weight: 700;
      font-size: 32px;
      line-height: 42px;
      word-break: keep-all;
    }

    .title-sub {
      text-align: center;
    }
  </style>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/create_table.php";
    create_table($conn, "message");
    ?>
  </header>
  <section>
    <div class="container">
      <div class="row justify-content-center align-items-center mt-3">
        <p class="content">“프시케는 동물 실험 과 인공적인 화학 성분을 최대한으로 줄여 자연친화적인 제품을 직접 손으로 만듭니다.”</p>
        <p class="title-sub">지구와 모두를 도울수 있는 것들을 함께 이루며 성장 하는 것을 통해 기업 윤리와 신념을 갖고 있습니다.</p>
      </div>
      <!-- 첫번째 이미지 -->
      <div class="image-with-caption">
        <img src="../img/smaple_img.png" alt="">
        <div>
          <figcaption class="content">프시케는 어떤 이유에도 제품을 만드는 과정에서 동물실험을 하지 않으며 해당 과정을 거친 원재료 또한 사용하지 않습니다.</figcaption>
          <p class="title-sub m-4">지구와 모두를 도울수 있는 것들을 함께 이루며 성장 하는 것을 통해 기업 윤리와 신념을 갖고 있습니다 .</p>
        </div>
      </div>
      <!-- 두번째 이미지 -->
      <div class="image-with-caption">
        <img src="../img/smaple_img.png" alt="">
        <div>
          <figcaption class="content">프시케는 좀더 특별한 추억과 마음을 전달할수 있는 특별한 제품을 선보입니다.</figcaption>
          <p class="title-sub m-4">사용자의 커스텀에 맞춰 바꿀수있는 제품들로 소중한 마음을 전해보세요.</p>
        </div>
      </div>
      <!-- 세번째 이미지 -->
      <div class="image-with-caption">
        <img src="../img/smaple_img.png" alt="">
        <div>
          <div>
            <figcaption class="content">신선함 그리고 유지성은 저희 프시케 철학의 핵심입니다.</figcaption>
            <p class="title-sub m-4">신선한 과일, 채소, 에센셜 오일, 최소한의 보존제와
              안전한 인공 성분을 사용하여 제품을 선보입니다.
              러쉬의 모든 제품은 베지테리언(Vegetarian)이며,
              그 중 약 90%는 식물성 원료로만 만든 비건(Vegan)입니다.</p>
          </div>
        </div>
      </div>
      <!-- 네번째 이미지 -->
      <div class="image-with-caption">
        <img src="../img/smaple_img.png" alt="">
        <div>
          <div>
            <figcaption class="content">이 모든 것은
              ‘고객은 항상 옳다’는 믿음과
              프시케의 핵심 가치인
              직원들의 진심이 모여 얻은
              결실입니다 </figcaption>
            <p class="title-sub m-4">앞으로도 프시케는 아름답고 좋은 제품을 만들겠다는 진정성을 갖은 핵심가치를 두고 여러분들과 함께 성장하고 기억할수 있는 기업이 되도록 노력하겠습니다.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- 푸터 -->
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
    </footer>

</body>

</html>