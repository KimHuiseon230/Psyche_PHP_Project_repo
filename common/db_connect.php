<?php

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "memberDB";

try {
  //code...
  $conn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
  // preare statement 를 지원하지 않는 경우 DB 기능을 사용하도록 설정
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
  // 쿼리의 버퍼링을 활성화
  $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
  // 에러모드 확인
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // echo "PDO DB연결 성공";
} catch (PDOException $e) {
  //throw $th;
  echo $e->getMessage();
}

// $dbname = "sample";
date_default_timezone_set('Asia/Seoul');
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// if (!$conn) {
//   die("연결오류 " . mysqli_connect_error());
// }
// // die -> ehco + exit 