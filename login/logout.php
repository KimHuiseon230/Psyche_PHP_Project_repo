<?php
session_start();
unset($_SESSION["num"]);
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["userlevel"]);
unset($_SESSION["userpoint"]);
echo ("
    <script>
      alert('성공적으로 로그아웃 되었습니다.');
      self.location.href = 'http://{$_SERVER['HTTP_HOST']}/project_php/index.php'
    </script>
");
