<?php
// 공통적으로 처리하는 부분
$css_array = ['css/slide.css'];
$js_array = ['/js/slide.js'];
$title = "Psyche";
$menu_code = "mian";

//헤더부분 시작
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide.php";

?>
<!-- 메인부분 시작 -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/main.php"; ?>
<!-- 메인부분 종료 -->
<!-- 푸터부분 시작 -->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"
?>