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
        <p class="content">“ Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure adipisci dolores in, saepe nobis maiores?”</p>
        <p class="title-sub">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio culpa</p>
      </div>
      <!-- 첫번째 이미지 -->
      <div class="image-with-caption">
        <img src="../img/smaple_img.png" alt="">
        <div>
          <figcaption>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio culpa officiis quia debitis suscipit earum reiciendis at omnis. Est, porro.</figcaption>
          <p>Lorem ipsum dolor sit amet.</p>
        </div>
      </div>
      <!-- 두번째 이미지 -->
      <div class="image-with-caption">
        <img src="../img/smaple_img.png" alt="">
        <div>
          <figcaption>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio culpa officiis quia debitis suscipit earum reiciendis at omnis. Est, porro.</figcaption>
          <p>Lorem ipsum dolor sit amet.</p>
        </div>
      </div>
      <!-- 세번째 이미지 -->
      <div class="image-with-caption">
        <img src="../img/smaple_img.png" alt="">
        <div>
          <figcaption>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio culpa officiis quia debitis suscipit earum reiciendis at omnis. Est, porro.</figcaption>
          <p>Lorem ipsum dolor sit amet.</p>
        </div>
      </div>
    </div>
    <!-- 푸터 -->
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
    </footer>
</body>

</html>