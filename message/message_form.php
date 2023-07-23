<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/create_table.php";
    create_table($conn, "message");
    ?>
  </header>
  <section>
    <?php
    if (!$userid) {
      die("<script>
                alert('로그인 후 이용해주세요!');
                self.location.href = 'http://{$_SERVER['HTTP_HOST']}/Psyche_PHP_Project/login/login_form.php';
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
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
  </footer>
</body>

</html>