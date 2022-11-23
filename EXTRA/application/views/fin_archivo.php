<?php
if(isset($mapa))
{
?>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN5YlYKfOuVVJGxRzIEmekifZeGT_3sgE&callback=initMap"></script>
<?php
}
if(isset($mapaTypeBox))
{
?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCN5YlYKfOuVVJGxRzIEmekifZeGT_3sgE&libraries=places&sensor=false"></script>
<?php
}
?>
</body>
<html>
