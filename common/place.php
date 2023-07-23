<?php
// 공통적으로 처리하는 부분

$title = "오시는 길";
$menu_code = "sarch";

//헤더부분 시작
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_header.php";
?>
<!-- 메인부분 시작 -->
<!-- 지도 및 오시는 길 설명 -->
<section class="container my-4" style="max-width:800px;">
  <div class="row">
    <h2 class="mx-auto">오시는 길</h2>
    <div id="map" style="width:100%; height:400px;">
      <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=8fa70dd602b4efbf1441031716a75e63"></script>
    </div>
    <script>
      const container = document.getElementById('map');
      const options = {
        center: new kakao.maps.LatLng(33.450701, 126.570667),
        level: 3
      };
      const map = new kakao.maps.Map(container, options);
    </script>


    <!-- 오시는 길 설명 -->
    <div class="">
      <h4>주소</h4>
      <p>
        서울 강남구 단월면 윗고북길 1-227<br>
        프시케<br>
        전화: 02-1234-5678
      </p>
      <h4>대중교통</h4>
      <p>
        지하철 이용시: 서울역(8호선) 4번 출구 이용<br>
        버스 이용시: 78, 62 강변북로 하차 후 도보 이용
      </p>
      <h4>주차 정보</h4>
      <p>건물 내 주차 가능(1시간 무료, 이후 추가 요금 발생)</p>
    </div>
  </div>
</section>
</section>

<!-- 메인부분 종료 -->
<!-- 푸터부분 시작 -->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/inc/inc_footer.php"
?>