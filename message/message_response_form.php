<html>

<head>
  <meta charset="utf-8">
  <title>답변 쪽지 보내기</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
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
  <script>
    function check_input() {
      if (!document.message_form.subject.value) {
        alert("제목을 입력하세요!");
        document.message_form.subject.focus();
        return;
      }
      if (!document.message_form.content.value) {
        alert("내용을 입력하세요!");
        document.message_form.content.focus();
        return;
      }
      document.message_form.submit();
    }
  </script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/header.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php"; ?>
  </header>

  < <section>
    <div id="message_box">
      <h3 id="write_title">
        답변 쪽지 보내기
      </h3>
      <?php
      $num = (isset($_GET['num']) && $_GET['num'] != '') ? $_GET['num'] : '';
      if ($num == "") {
        die("<script>
          alert('경고');
          history.go(-1);
          </script>
        ");
      }
      include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";
      $sql = "select * from message where num=:num";
      $stmt = $conn->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->bindParam(':num', $num);
      $stmt->execute();
      $row = $stmt->fetch();

      $send_id = $row["send_id"];
      $rv_id = $row["rv_id"];
      $subject = $row["subject"];
      $content = $row["content"];

      $subject = "RE: " . $subject;

      $content = "> " . $content;
      $content = str_replace("\n", "\n>", $content);
      $content = "\n\n\n-----------------------------------------------\n" . $content;

      $sql2 = "select name from members where id='$send_id'";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->setFetchMode(PDO::FETCH_ASSOC);
      $stmt2->execute();
      $record = $stmt2->fetch();
      $send_name = $record["name"];
      ?>
      <form name="message_form" action="message_insert.php?send_id=<?= $userid ?>" method="post">
        <input type="hidden" name="rv_id" value="<?= $send_id ?>">
        <input type="hidden" name="send_id" value="<?= $rv_id ?>">
        <div id="write_msg">
          <ul>
            <li>
              <span class="col1">보내는 사람 : </span>
              <span class="col2"><?= $userid ?></span>
            </li>
            <li>
              <span class="col1">수신 아이디 : </span>
              <span class="col2"><?= $send_name ?>(<?= $send_id ?>)</span>
            </li>
            <li>
              <span class="col1">제목 : </span>
              <span class="col2"><input name="subject" type="text" value="<?= $subject ?>"></span>
            </li>
            <li id="text_area">
              <span class="col1">글 내용 : </span>
              <span class="col2">
                <textarea name="content"><?= $content ?></textarea>
              </span>
            </li>
          </ul>
          <button type="button" id="message_send">보내기</button>
        </div>
      </form>
    </div> <!-- message_box -->
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/footer.php"; ?>
    </footer>
</body>

</html>