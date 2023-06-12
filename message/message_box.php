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
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/create_table.php";
    create_table($conn, "message");
    ?>
  </header>
  <section>
    <div id="message_box">
      <h3>
        <?php
        $page = (isset($_GET['page']) && $_GET["page"] != '') ? $_GET['page'] : 1;
        $mode = (isset($_GET['mode']) && $_GET["mode"] != '') ? $_GET['mode'] : '';

        if ($mode == "send")
          echo "송신 쪽지함 > 목록보기";
        else
          echo "수신 쪽지함 > 목록보기";
        ?>
      </h3>
      <div>
        <table id="message" class="table table-hover">
          <thead>
            <tr>
              <th class="col1">번호</th>
              <th class="col2">제목</th>
              <th class="col3"><?php
                                if ($mode == "send")
                                  print "받은이";
                                else
                                  print "보낸이";
                                ?></th>
              <th class="col4">등록일</th>
            </tr>
          </thead>
          <?php
          include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
          if ($mode == "send")
            $sql = "select count(*) as cnt from message where send_id=:userid order by num desc";
          else
            $sql = "select count(*) as cnt from message where rv_id=:userid order by num desc";

          $stmt = $conn->prepare($sql);
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          $stmt->bindParam(':userid', $userid);
          $stmt->execute();
          $row = $stmt->fetch();
          // 전체 글 수
          $total_record = $row['cnt'];
          $scale = 10;

          // 전체 페이지 수($total_page) 계산 
          if ($total_record % $scale == 0)
            $total_page = floor($total_record / $scale);
          else
            $total_page = floor($total_record / $scale) + 1;

          // 표시할 페이지($page)에 따라 $start 계산  
          $start = ($page - 1) * $scale;
          $number = $total_record - $start;

          if ($mode == "send")
            $sql = "select * from message where send_id=:userid order by num desc limit {$start}, {$scale}";
          else
            $sql = "select * from message where rv_id=:userid order by num desc limit {$start}, {$scale}";

          $stmt = $conn->prepare($sql);
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          $stmt->bindParam(':userid', $userid);
          $stmt->execute();
          $rows = $stmt->fetchAll();

          // for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
          foreach ($rows as $row) {
            // 하나의 레코드 가져오기
            $num    = $row["num"];
            $subject     = $row["subject"];
            $regist_day  = $row["regist_day"];

            if ($mode == "send")
              $msg_id = $row["rv_id"];
            else
              $msg_id = $row["send_id"];

            $sql2 = "select name from members where id='$msg_id'";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            $stmt2->execute();
            $record = $stmt2->fetch();
            $msg_name = $record["name"];
          ?>
            <tbody class="table-group-divider">
              <tr>
                <th class="col1"><?= $number ?></th>
                <td class="col2"><a href="message_view.php?mode=<?= $mode ?>&num=<?= $num ?>"><?= $subject ?></a></td>
                <td class="col3"><?= $msg_name ?>(<?= $msg_id ?>)</td>
                <td class="col4"><?= $regist_day ?></td>
              </tr>
            </tbody>
          <?php
            $number--;
          }
          ?>
        </table>
        <ul id="page_num">
          <?php
          if ($total_page >= 2 && $page >= 2) {
            $new_page = $page - 1;
            print "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
          } else
            print "<li>&nbsp;</li>";

          // 게시판 목록 하단에 페이지 링크 번호 출력
          for ($i = 1; $i <= $total_page; $i++) {
            if ($page == $i)     // 현재 페이지 번호 링크 안함
            {
              print "<li><b> $i </b></li>";
            } else {
              print "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
            }
          }
          if ($total_page >= 2 && $page != $total_page) {
            $new_page = $page + 1;
            print "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
          } else
            print "<li>&nbsp;</li>";
          ?>
        </ul> <!-- page -->
        <ul class="buttons">
          <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
          <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
          <li><button onclick="location.href='message_form.php'">쪽지 보내기</button></li>
        </ul>
      </div> <!-- message_box -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
  </footer>
</body>

</html>