<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";
//1. 현재페이지 요청을 받는다.
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
//2. 전체게시물 조회 쿼리 : select count(*) as cnt from customer; (34개)
$sql = "select count(*) as cnt from customer";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
$total = $row['cnt'];
//3. 화면에 보여줄 개수
$limit = 5;
//4. 해당된 페이지 데이터리스트 보여주기
$start = ($page - 1) * $limit;
//4. 데이터베이스 테이블로부터 전체 내용을 가져온다.(만약 1page : 0, 5 :: 2page :5, 5 ::3page: 10, 5 )가져온다.
$sql = "select num, name, tel, address from customer order by num desc limit {$start}, {$limit}";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ko">

<head>
   <title>부트스트랩을 이용한 페이징</title>
   <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/header.css' ?>">
   <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/Psyche_PHP_Project/css/slide.css?v=<?= date('Ymdhis') ?>">
   <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/common.css' ?>">
   <!-- 공통  선언 js -->
   <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/slide.js' ?>"></script>
   <!-- CSS only -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <!-- JavaScript Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <!-- imsi js -->
   <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/imsi.js ' ?>" defer></script>
</head>

<body>
   <header>
      <?php
      include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/header.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/page_lib.php";
      ?>
   </header>
   <div class="container ">
      <section>
         <h2>임시 화면 </h2>
         <table class="table table-hover my-5 w-60 mx-auto">
            <thead>
               <tr>
                  <th scope="col">번호</th>
                  <th scope="col">이름</th>
                  <th scope="col">전화번호</th>
                  <th scope="col">주소</th>
               </tr>
            </thead>
            <tbody class="table-group-divider">
               <?php
               foreach ($rows as $row) {
                  echo "<tr>
          <th scope='row'>{$row['num']}</th>
          <td>{$row['name']}</td>
          <td>{$row['tel']}</td>
          <td>{$row['address']}</td>
        </tr>";
               }
               ?>
            </tbody>
         </table>
         <div class="container d-flex justify-content-center aling-items-start gap-3 mb-3">
            <?php
            $page_limit = 5;
            echo  pagination($total, $limit, $page_limit, $page);
            ?>
            <button type="button" class="btn btn-outline-secondary" id="btn_excel">엑셀로 저장</button>
         </div>
   </div>
   </section>
   <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/footer.php"; ?>
   </footer>
</body>

</html>