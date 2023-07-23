<!DOCTYPE html>
<html lang="ko">

<head>
  <title>회원 가입 화면</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
  <!-- 공통 선언 js -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
  <!-- 따로 선언부 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/member.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/member.js?v=1' ?>"></script>
  <!-- 구글폰트 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200&display=swap" rel="stylesheet">
  <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js?autoload=false"></script>
  <!-- 우편번호 검색엔진(다음) -->
  <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/create_table.php";
    create_table($conn, "members");
    ?>
  </header>
  <div class="container w-50  border p-5 my-3 rounded-5">
    <div id=" main_content">
      <div id="join_box">
        <form name="member_form" id="member_form" method="post" action="./member_insert.php">
          <h4 class="mb-3">회원가입</h4>
          <h5>회원 정보 입력</h5>
          <table class="table">
            <colgroup>
              <col width=15%>
              <col width=85%>
            </colgroup>
            <tr>
              <input type="hidden" name="id_chk" value="0">

              <div class="form id">
                <div class="col1">아이디</div>
                <div class="col2">
                  <input type="text" name="id" class="form-control">
                </div>
                <div class="col3">
                  <!-- <form name="member_form" method="GET" action="./member_check_id.php"> -->
                  <button type="button" onclick="check_id()" class="btn btn-secondary btn-sm">중복확인</button>
                  <!-- </form> -->
                </div>
              </div>
            </tr>
            <div class="form">
              <div class="col1">비밀번호</div>
              <div class="col2">
                <input type="password" name="pass" class="form-control">
              </div>
            </div>
            <div class="clear"></div>
            <div class="form">
              <div class="col1">비밀번호 확인</div>
              <div class="col2">
                <input type="password" name="pass_confirm" class="form-control" placeholder="비밀번호 확인을 위해 다시한번 입력 해 주세요">
              </div>
            </div>
            <div class="clear"></div>
            <div class="form">
              <div class="col1">이름</div>
              <div class="col2">
                <input type="text" name="name" class="form-control" placeholder="이름을 입력해 주세요">
              </div>
            </div>
            <div class="clear"></div>
            <div class="form email">
              <input type="hidden" name="email_chk" value="0">
              <div class="col1">이메일</div>
              <div class="col2">
                <input type="text" name="email1">@
                <select name="email2">
                  <option value="">-선택하세요-</option>
                  <option value="naver.com">naver.com</option>
                  <option value="google.com">google.com</option>
                  <option value="daum.net">daum.net</option>
                </select>
                <button type="button" onclick="check_email()" class="btn btn-secondary btn-sm">중복확인</button>
              </div>
            </div>
            <div class="clear"></div>
            <div class="form">
              <div class="col1">우편번호</div>
              <div class="col2">
                <input type="text" name="zipcode" id="f_zipcode" class="form-control">
              </div>
              <div class="col3">
                <button type="button" id="btn_zipcode" class="btn btn-secondary btn-sm">우편번호찾기</button>
              </div>
            </div>
            <table class="table">
              <colgroup>
                <col width=15%>
                <col width=85%>
              </colgroup>
              <div class="clear"></div>
              <div class="form">
                <div class="col1">주소</div>
                <div class="col2">
                  <input type="text" name="addr1" id="f_addr1" class="form-control">
                </div>
              </div>
              <div class="clear"></div>
              <div class="form">
                <div class="col1">상세주소</div>
                <div class="col2">
                  <input type="text" name="addr2" id="f_addr2" class="form-control" placeholder="상세주소를 입력">
                </div>
              </div>
            </table>

          </table>
          <table class="table">
            <colgroup>
              <col width=15%>
              <col width=85%>
            </colgroup>
            <div class="d-flex justify-content-center gap-2">
              <button type="button" class="btn btn-primary btn-sm" id="send">전송</button>
              <button type="button" class="btn btn-secondary btn-sm" id="cancel">취소</button>
            </div>
          </table>
        </form>
      </div> <!-- join_box -->
    </div> <!-- main_content -->
  </div>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"; ?>
  </footer>
</body>

</html>