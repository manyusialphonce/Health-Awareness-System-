<!DOCTYPE html>
<html>
<head>
    <title>Hospitali Karibu</title>
</head>
<body>
    <link rel="stylesheet" href="css/style.css">
<h2>Hospitali Karibu</h2>
<button onclick="getLocation()">Pata hospitali karibu</button>
<div id="map"></div>

<script>
function getLocation(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showHospitals);
    } else {
        alert("Browser yako haiungi mkono location services");
    }
}

function showHospitals(position){
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;

    fetch(`fetch_hospitals.php?lat=${lat}&lng=${lng}`)
    .then(res => res.json())
    .then(data => {
        let mapDiv = document.getElementById('map');
        mapDiv.innerHTML = "<ul>" + data.map(h=>`<li>${h.name} - ${h.address} (${h.contact})</li>`).join('') + "</ul>";
    });
}
</script>
</body>
</html>