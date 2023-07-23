<!DOCTYPE html>
<html lang="ko">

<head>
   <meta charset="utf-8">
   <title>부트스트랩을 이용한 페이징처리방법</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- 슬라이드 스크립트 -->
   <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/slide.js' ?>" defer></script>
   <!-- imsi 자바스크립트 -->
   <script src="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/js/imsi.js' ?>" defer></script>
   <!-- bootstrap script -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
   </script>
   <!-- 부트스트랩 CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <!-- 공통, 슬라이드, 헤더 스타일 -->
   <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/common.css' ?>">
   <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/slide.css?er=1' ?>">
   <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/php_source/khs/css/header.css' ?>">

</head>

<body>
   <header>
      <?php
      include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/inc/inc_header.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/slide.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/common/page_lib.php";
      ?>
   </header>
   <div class="container ">
      <h2>회원 관리</h2>
      <p>사이트 정보 입력</p>
      <form name="joinform" method="post" autocomplete="off">
         <table>

            <tr>
               <td>
                  <label class="private" for="pass"><b>패스워드</b></label>
               </td>
               <td>
                  <input type="password" name="pwd" id="pwd" required="required">
               </td>
            </tr>

            <tr>
               <td>
                  <label class="private" for="pwdcheck"><b>비밀번호 확인</b></label>
               </td>
               <td>
                  <input type="password" name="pwdcheck" id="pwdcheck" required="required">
               </td>
            </tr>
            <p>개인정보 입력</p>

            </tr>

            <tr>
               <td>
                  <label for="pwdcheck"><b>이름</b></label>
               </td>
               <td>
                  <input type="password" name="pwdcheck" id="pwdcheck" required="required">
               </td>
            </tr>
            <td>
               <label for="pwdcheck"><b>닉네임</b>
               </label>
            </td>
            <td>
               <input type="password" name="pwdcheck" id="pwdcheck" required="required">
            </td>
            </tr>
            </tr>
            <td>
               <label for="pwdcheck"><b>emil</b></label>
            </td>
            <td>
               <input type="password" name="pwdcheck" id="pwdcheck" required="required">
            </td>
            </tr>

            </tr>
            <td>
               <label for="pwdcheck"><b>emil</b></label>
            </td>
            <td>
               <input type="password" name="pwdcheck" id="pwdcheck" required="required">
            </td>
            </tr>

            <tr>
               <td>
                  <label for="pwdcheck"><b>전화번호</b></label>
               </td>
               <td>
                  <input type="password" name="pwdcheck" id="pwdcheck" required="required">
               </td>
            </tr>
            <tr>
               <td>
                  <label for="pwdcheck"><b>휴대폰 번호</b></label>
               </td>
               <td>
                  <input type="password" name="pwdcheck" id="pwdcheck" required="required">
               </td>
            </tr>
            <tr>
               <td>
                  <label for="pwdcheck"><b>생년월일</b></label>
               </td>
               <td>
                  <input type="date" name="pwdcheck" id="pwdcheck" required="required">
               </td>
            </tr>
            <tr>
               <td>
                  <label for="pwdcheck"><b>주소</b></label>
               </td>
               <td>
                  <input type="text" name="pwdcheck" id="pwdcheck" required="required">기본주소 <br>
                  <input type="text" name="pwdcheck" id="pwdcheck" required="required">상세주소<br>
                  <input type="text" name="pwdcheck" id="pwdcheck" required="required">참고목록<br>
               </td>
            </tr>
            <tr>
               <td>
                  <label for="pwdcheck"><b>기타 개인설정</b></label>
               </td>
            </tr>
            <tr>
               <td>
                  <label for="pwdcheck"><b>카카오톡 메세지</b></label>
                  <input type="checkbox" name="kakotalk" id="kakotalk">카카오톡 메세지를 받겠습니다>수신메세지를 체크하시면 세일 소식을 가장 먼저 받아보실수 있습니다
               </td>
            </tr>
            <tr>
               <td>
                  <label for="pwdcheck"><b>매일링서비스</b></label>
                  <input type="checkbox" name="kakotalk" id="kakotalk">정보 메일을 받겠습니다.
               </td>
            </tr>
            <tr>
               <td>
                  <label for="pwdcheck"><b>SMS 수신여부 </b></label>
                  <input type="checkbox" name="kakotalk" id="kakotalk"> 휴대폰 문자메세지를 받겠습니다.
                  <p> 정보공개를 바꾸시면 앞으로 0일 이내에는 변경이 안됩니다.</p>
                  <input type="checkbox" name="kakotalk" id="kakotalk"> 다른분들이 나의 정보를 볼 수 있도록 합니다.

               </td>
            </tr>

         </table>



      </form>

   </div>
   <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/php_source/khs/inc/inc_footer.php"; ?>
   </footer>
</body>

</html>