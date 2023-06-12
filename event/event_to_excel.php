<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename = event.xls");     //filename = 저장되는 파일명을 설정합니다.
header("Content-Description: PHP8 Generated Data");

//엑셀 파일로 만들고자 하는 데이터의 테이블을 만듭니다.
$EXCEL_FILE = "
<table border='1'>
    <tr>
       <td>번호</td>
       <td>제목</td>
       <td>글쓴이</td>
       <td>첨부</td>
       <td>등록일</td>
       <td>조회</td>
    </tr>
";
$sql = "select * from  event order by name";
$stmt = $conn->prepare($sql);
$result = $stmt->execute();
if (!$result) {
  die("<script>
        alert('데이터 로딩');
        </script>");
}
// DB 에 저장된 데이터를 테이블 형태로 저장합니다.
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$rowArray = $stmt->fetchAll();
foreach ($rowArray  as $row) {
  $EXCEL_FILE .= " 
  <tr>
  <td>{$row['num']}</td>
  <td>{$row['id']}</td>
  <td>{$row['name']}</td>
  <td>{$row['subject']}</td>
  <td>{$row['regist_day']}</td>
  <td>{$row['hit']}</td>
</tr>";
}
$EXCEL_FILE .= "</table>";

// 만든 테이블을 출력해줘야 만들어진 엑셀파일에 데이터가 나타납니다.
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $EXCEL_FILE;
