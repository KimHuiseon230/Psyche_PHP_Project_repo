<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
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
<!-- 헤더 영역의 네비게이션 메뉴 영역 -->
<nav role="navigation">
  <div id="menuToggle">
    <input type="checkbox" />

    <span></span>
    <span></span>
    <span></span>
    <ul id="menu">
      <!-- 로그인 안되었을 때 -->
      <?php if (!$userid) {  ?>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/member/member_form.php' ?>">회원가입</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/login/login_form.php' ?>">로그인</a></li>
      <?php }
      if ($userid) { ?>
        <?= $userid . "(" . $username . ")님 " . "Lv:" . $userlevel . " Po:" . $userpoint  ?>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/member/member_update_form.php' ?>">회원정보수정</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/login/logout.php' ?>">로그아웃</a></li>
        <li>- </li>
      <?php } ?>

      <!-- 관리자모드로 로그인되었을 때 추가로.. -->

      <?php if ($userlevel == 1) { ?>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/admin/admin.php' ?>">관리자모드</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/secure_member.php' ?>">회원보안처리</a></li>
        <!-- <li> | </li>
      <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/imis.php' ?>">임시</a></li> -->
        <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/member/member_list.php' ?>">회원리스트</a></li>
      <?php } ?>
      <li>- </li>
      <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/common/Introduction_of_Psyche.php' ?>">프시케소개</a></li>
      <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/board/board_list.php' ?>">제품</a></li>
      <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/event/event_list.php' ?>">이벤트</a></li>
      <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/place.php' ?>">매장</a></li>
    </ul>
  </div>
</nav>
<div id="menu_bar" style="text-align: center;">
  <div class="container">
    <!-- <div><input type="button" value="알람 받기"></div> -->
    <div>
      <a class="navbar-brand" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/index.php' ?>">
        <img id="imglog" style="width: 200px; height: auto; ;" src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php//img//main_log.png" ' ?>" alt="">
      </a>
    </div>
    <!-- <div><input type="text"></div> -->
  </div>
</div>
<!-- <li><a href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/message/message_form.php' ?>">쪽지</a></li> -->