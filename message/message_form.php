<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>쪽지 </title>
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
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/slide.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/create_table.php";
    create_table($conn, "message");
    ?>
  </header>
  <section>
    <?php
    if (!$userid) {
      die("<script>
                alert('로그인 후 이용해주세요!');
                self.location.href = 'http://{$_SERVER['HTTP_HOST']}/project_php/login/login_form.php';
                </script>
            ");
    }
    ?>
    <div id="message_box">
      <h3 id="write_title">
        쪽지 보내기
      </h3>
      <ul class="top_buttons">
        <li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
        <li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
      </ul>
      <form name="message_form" method="post" action="./message_insert.php" autocomplete="off">
        <input type="hidden" name="send_id" value="<?= $userid ?>">
        <div id="write_msg">
          <ul>
            <li>
              <span class="col1">보내는 사람 : </span>
              <span class="col2"><?= $userid ?></span>
            </li>
            <li>
              <span class="col1">수신 아이디 : </span>
              <span class="col2"><input name="rv_id" type="text"></span>
            </li>
            <li>
              <span class="col1">제목 : </span>
              <span class="col2"><input name="subject" type="text"></span>
            </li>
            <li id="text_area">
              <span class="col1">내용 : </span>
              <span class="col2">
                <textarea name="content"></textarea>
              </span>
            </li>
          </ul>
          <button type="button" class="btn btn-secondary btn-sm" id="message_send">보내기</button>
        </div>
      </form>
    </div> <!-- message_box -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
  </footer>
</body>

</html>