<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
<?php
//로그인을 하면 session에 정보를 저장하고 각 페이지들에서 모두 사용하고자 함.
//로그인에 띠라 화면구성이 다르기에 세션에 저장되어 있는 회원정보 중 id, name, level 값 읽어오기
//회원등급 : 1~9등급 [1등급:관리자, 9등급:신규회원]
//세션을 저장하든 읽어오든 사용하고자 하면 이 함수로 시작
session_start();
$num       = (isset($_SESSION['num']) && $_SESSION['num'] != "") ? $_SESSION['num'] : "";
$userid    = (isset($_SESSION['userid']) && $_SESSION['userid'] != "") ? $_SESSION['userid'] : "";
$username  = (isset($_SESSION['username']) && $_SESSION['username'] != "") ? $_SESSION['username'] : "";
$userlevel = (isset($_SESSION['userlevel']) && $_SESSION['userlevel'] != "") ? $_SESSION['userlevel'] : "";
$userpoint = (isset($_SESSION['userpoint']) && $_SESSION['userpoint'] != "") ? $_SESSION['userpoint'] : "";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title><?= (isset($title) && $title != '') ? $title : 'TEST' ?></title>
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
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/toggle.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/product_board/board.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/product_board/js/board.js' ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/message.js' ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/toggle.js' ?>"></script>
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    <?php
    if (isset($js_array)) {
      foreach ($js_array as $value) {
        print "<script src='http://" . $_SERVER['HTTP_HOST'] . "/Psyche_PHP_Project/$value?v=" . date('Ymdhis') . "' defer></script>" . PHP_EOL;
      }
    }
    if (isset($css_array)) {
      foreach ($css_array as $value) {
        print "<link rel=\"stylesheet\" href=\"http://{$_SERVER['HTTP_HOST']}/Psyche_PHP_Project/{$value}?v=" . date('Ymdhis') . "\">";
      }
    }
    ?>
  </script>
</head>
<!-- 헤더 영역의 로고와 회원가입/로그인 표시 영역 -->
<div class="">
  <!-- 로고 영역 -->
  <div class="row justify-content-center">
    <div class="col-auto">
      <a class="navbar-brand" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/index.php" id="title">
        <img src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/img/main_log_black.png' ?>" alt="로고 이미지" id="icon">
      </a>
    </div>
  </div>
  <div id="top">
    <!-- 1. 로고영역 -->
    <div class="logo">
      <nav role="navigation ">
        <div id="menuToggle">
          <input type="checkbox" name="checkbox" id="checkbox" />
          <span></span>
          <span></span>
          <span></span>
          <ul id="menu" style="display:none">
            <li>
              <b>MENU</b>
            </li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/index.php' ?>">HOME</a></li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/common/Introduction_of_Psyche.php' ?>">프시케소개</a></li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/product_board/board_list.php' ?>">제품</a></li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/event/event_list.php' ?>">이벤트</a></li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/common/place.php' ?>">오시는길</a></li>
            <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/message/message_form.php' ?>">고객의 소리</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- 2. 회원가입/로그인 버튼 표시 영역 -->
    <ul id="top_menu">
      <!-- 로그인 안되었을 때 -->
      <?php if (!$userid) {  ?>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/member/member_form.php' ?>">회원가입</a></li>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/login/login_form.php' ?>">로그인</a></li>
      <?php } else { ?>
        <?= $username . "님" ?>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/login/logout.php' ?>">로그아웃</a></li>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/member/member_update_form.php' ?>">회원수정</a></li>
      <?php } ?>

      <!-- 관리자모드로 로그인되었을 때 추가로.. -->
      <?php if ($userlevel == 1) { ?>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/admin/admin.php' ?>">관리자모드</a></li>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/member/member_list.php' ?>">회원리스트</a></li>
      <?php } ?>
    </ul>
  </div>