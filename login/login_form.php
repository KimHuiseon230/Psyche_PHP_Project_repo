<?php
// 공통적으로 처리하는 부분
$js_array = ['/js/login.js'];
$css_array = ['/css/login.css'];
$title = "로그인";
$menu_code = "login";

//헤더부분 시작
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
?>
<!-- 메인부분 시작 -->
<section >
  <header>
    <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/login.js' ?>"></script>
    <!-- <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/login.css?v=<?= date('Ymdhis') ?>"> -->
  </header>

  <body>
    <div class="page-container">
      <div class="login-form-container shadow">
        <div class="login-form-right-side">
          <div class="top-logo-wrap">
          </div>
          <h1>How does a login system work?</h1>
          <p>In computer security, logging in is the process by which an individual gains access to a computer system by identifying and authenticating themselves.</p>
        </div>
        <div class="login-form-left-side">
          <div class="login-top-wrap">
            <span>Don't have an account?</span>
            <button class="create-account-btn shadow-light">Create Profile</button>
          </div>
          <div class="login-input-container" id="login_form">
            <form name="login_form" method="post" action="login.php">
              <div class="login-input-wrap input-id">
                <i class="far fa-envelope"></i>
                <input type="text" name="id" placeholder="id" class="container text-center mt-3">
              </div>
              <div class="login-input-wrap input-password">
                <i class="fas fa-key"></i>
                <input type="password" name="pass" id=" pass" placeholder="Password" class="container text-center mt-3">
              </div>
          </div>
          <div class="login-btn-wrap" id="login_btn">
            <input class="login-btn" id="logins" type="button" value="Log In">
            <a href="#">Forgot password?</a>
          </div>
          </form><!-- login_form -->
        </div><!-- login-input-container -->
      </div>
    </div>
</section>
<!-- 메인부분 종료 -->
<!-- 푸터부분 시작 -->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"
?>