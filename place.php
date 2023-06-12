<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>오시는 길</title>
</head>

<body>
  <h3>버스.지하철.자가용</h3>
  <a href="">버스노선 안내</a>
  <a href="">지하철 노선 안내</a>
  <a href="">자가용으로 오시는 길 안내</a>
  <div id="map" style="width:500px;height:400px;"></div>
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=8fa70dd602b4efbf1441031716a75e63"></script>
  <script>
    var container = document.getElementById('map');
    var options = {
      center: new kakao.maps.LatLng(33.450701, 126.570667),
      level: 3
    };

    var map = new kakao.maps.Map(container, options);
  </script>

</body>

</html>