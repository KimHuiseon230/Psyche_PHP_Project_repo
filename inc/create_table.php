<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/db_connect.php";

function create_table($conn, $table_name)
{
  $ctt_flag = false;

  $sql = "show tables from psycheDB where Tables_in_psycheDB= :table_name ";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':table_name', $table_name);
  $result = $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_NUM);
  $count = $stmt->Rowcount();

  //테이블이 있는 지 없는지 확인함
  $ctt_flag = ($count >= 1) ? true : false;
  // }
  if ($ctt_flag == false) {
    switch ($table_name) {
      case 'members':
        $sql = "CREATE TABLE members (
          num int(11) NOT NULL AUTO_INCREMENT,
          id char(15) NOT NULL,
          pass varchar(255) NOT NULL,
          name char(15) NOT NULL,
          email char(80) DEFAULT NULL,
          zipcode char(5) DEFAULT '',
          addr1 varchar(255) DEFAULT '',
          addr2 varchar(255) DEFAULT '',
          regist_day char(20) DEFAULT NULL,
          level int(11) DEFAULT '0',
          point int(11) DEFAULT '0',
          PRIMARY KEY (num)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        break;
      case 'event':
        $sql =
          "CREATE TABLE `event` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `subject` char(200) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) NOT NULL,
          `hit` int(11) NOT NULL,
          `file_name` char(40) DEFAULT NULL,
          `file_type` char(40) DEFAULT NULL,
          `file_copied` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4    
        ";
        break;
      case 'message':
        "CREATE TABLE `message` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `send_id` char(20) NOT NULL,
          `rv_id` char(20) NOT NULL,
          `subject` char(200) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
        ";
        break;
      case 'product_board':
        $sql = "CREATE TABLE `product_board` (
            `num` int(11) NOT NULL AUTO_INCREMENT,
            `id` char(15) NOT NULL,
            `name` char(10) NOT NULL,
            `subject` char(200) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) NOT NULL,
            `hit` int(11) NOT NULL,
            `file_name` char(40) DEFAULT NULL,
            `file_type` char(40) DEFAULT NULL,
            `file_copied` char(40) DEFAULT NULL,
            PRIMARY KEY (`num`)
          ) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
        break;
      case 'product_board_ripple':
        $sql = "CREATE TABLE product_board_ripple (
          `num` int(11) NOT NULL AUTO_INCREMENT,
                `parent` int(11) NOT NULL,
                `id` char(15) NOT NULL,
                `name` char(10) NOT NULL,
                `nick` char(10) NOT NULL,
                `content` text NOT NULL,
                `regist_day` char(20) DEFAULT NULL,
                PRIMARY KEY (`num`)
        ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
          ";
        break;
      default:
        $sql != "";
        break;
    }
    if ($sql != "") {
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute();
      if ($result) {

        echo "<script>
  alert('해당 테이블 생성 완료');
</script>";
      } else {
        "<script>
  alert('해당 테이블 생성 오류');
</script>";
      }
    };
  }
}
