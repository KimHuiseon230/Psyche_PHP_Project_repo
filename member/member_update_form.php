<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>회원수정</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
  <!-- 공통 선언 js -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
  <!-- 따로 선언부 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/member.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] ?> /Psyche_PHP_Project/js/member.js?v=<?= date('Ymdhis') ?>"></script>
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/member_update.js' ?>"></script>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/header.php"; ?>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";
    $num = (isset($_SESSION['num']) && $_SESSION['num'] != "" && is_numeric($_SESSION['num'])) ? $_SESSION['num'] : "";
    if ($num == "") {
      die("<script>
        alert('로그인을 해주세요');
        </script>");
    }
    $sql = "select * from members where num =:num";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':num', $num);
    $result = $stmt->execute();
    if (!$result) {
      die("<script>
            alert('데이터 검색 오류);
            history.go(-1);
          </script>");
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $emailArray = explode("@", $row['email']);
    ?>
  </header>
  <section>
    <!-- 이미지 아래 최신 게시글 표시 영역 -->
    <div id="main_content">
      <!-- 1. 최신 게시글 목록 -->
      <article id="latest">
      </article>
      <!-- 이미지 아래 최신 게시글 표시 영역 -->
      <div id="main_content">
        <!-- 1. 최신 게시글 목록 -->
        <article id="latest">
          <ul></ul>
        </article>
        <section>
          <div id="main_img_bar">
          </div>
          <div id="main_content">
            <div id="join_box">
              <form name="member_form" method="post" action="./member_update.php">
                <input type="hidden" name="num" value=<?= $row['num'] ?>>
                <h2>회원 수정</h2>
                <div class="form id">
                  <div class="col1">아이디</div>
                  <div class="col2">
                    <input type="text" class="form-control" name="id" value=<?= $row['id'] ?> readonly>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">비밀번호</div>
                  <div class="col2">
                    <input type="password" class="form-control" name="pass" placeholder="새로운 비밀번호 입력가능">
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">비밀번호 확인</div>
                  <div class="col2">
                    <input type="password" class="form-control" name="pass_confirm" placeholder="새로운 비밀번호 입력가능">
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form">
                  <div class="col1">이름</div>
                  <div class="col2">
                    <input type="text" class="form-control" name="name" value=<?= $row['name'] ?>>
                  </div>
                </div>
                <div class="clear"></div>
                <div class="form email">
                  <div class="col1">이메일</div>
                  <div class="col2">
                    <input type="text" class="form-control" name="email1" value=<?= $emailArray[0] ?> style="display:inline-block;width:auto;">@
                    <select name="email2" id="email2" class="form-control" style="display:inline-block;width:auto;">
                      <option value="">-선택하세요-</option>
                      <option value="naver.com">naver.com</option>
                      <option value="google.com">google.com</option>
                      <option value="daum.net">daum.net</option>
                    </select>
                  </div>
                </div>
                <div class="buttons">
                  <input type="button" class="btn btn-primary btn-sm" value="수정완료" id="send">
                  <input type="button" class="btn btn-secondary btn-sm" value="취소" id="cancel">
                </div>
                <br>
                <hr>
              </form>
            </div> <!-- join_box -->
          </div> <!-- main_content -->
        </section>
      </div>
    </div>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/footer.php"; ?>
  </footer>
  <script>
    const email2 = document.querySelector("#email2")
    email2.value = '<?= $emailArray[1] ?>'
  </script>

</body>

</html>