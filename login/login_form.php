<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>로그인 화면</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/common.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/message/css/message.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/board.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/login.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/message.js' ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/login.js' ?>"></script>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/project_php/css/member.css?v=<?= date('Ymdhis') ?>">
  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php"; ?>
  </header>
  <section>

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
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
  </footer>
</body>

</html>