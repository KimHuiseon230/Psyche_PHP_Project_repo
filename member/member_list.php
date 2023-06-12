<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
$sql = "select *from members order by name";
$stmt = $conn->prepare($sql);
$result = $stmt->execute();
// var_dump($result);
if (!$result) {
  die("<script>
        alert('아이디와 패스워드를 입력해주세요.');
        history.go(-1);
        </script>");
}

if (!$result) {
  die("데이터 삽입 오류: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>회원리스트</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/header.css' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/slide.css?er=1' ?>">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/common.css' ?>">
  <!-- 공통 선언 js -->
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/slide.js' ?>"></script>
  <!-- 따로 선언부 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/member.css' ?>">
  <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/member/js/member.js' ?>"></script>
  <!-- 부트스트랩 CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- 부트스트랩 JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
</head>

<body>
  <header>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/header.php";    ?>
  </header>
  <section>
    <div class="container w-70">
      <h3 class="container text-center mt-3">회원 리스트</h3>
      <!-- 테이블 시작 -->
      <table class="table table-hover mt-3 ">
        <thead>
          <tr>
            <th scope="col">num</th>
            <th scope="col">id</th>
            <th scope="col">pass</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">register_day</th>
            <th scope="col">level</th>
            <th scope="col">point</th>
            <th scope="col">삭제</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          $rowArray = $stmt->fetchAll();
          foreach ($rowArray  as $row) {

            echo " 
          <tr>
            <th scope='row'>{$row['num']}</th>
            <td>{$row['id']}</td>
            <td>{$row['pass']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['regist_day']}</td>
            <td>{$row['level']}</td>
            <td>{$row['point']}</td>
            <td><button type ='button'
            onclick='location.href=\"http://{$_SERVER['HTTP_HOST']}/project_php/member/member_delete.php?num={$row['num']}\"'>삭제</button></td>
          </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/footer.php"; ?>
  </footer>
</body>

</html>