<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>Psyche</title>
  <!-- 공통 선언 css -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/main.css' ?>">
  <!-- 공통 선언 js -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
  <!-- 따로 선언부 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/message.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/board.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/message.js' ?>"></script>
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
</head>

<body>
  <header>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php"; ?>

  </header>
  <section>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/main.php"; ?>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/footer.php"; ?>
  </footer>
</body>

</html>