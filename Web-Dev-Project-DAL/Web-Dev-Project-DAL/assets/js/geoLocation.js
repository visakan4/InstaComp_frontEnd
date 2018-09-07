
// source : https://www.w3schools.com/html/html5_geolocation.asp
$(document).ready(function () {
    getLocation();
})

function getLocation() {
    if (navigator.geolocation) {
        localStorage.setItem('HasGeoLocation', true);
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        localStorage.setItem('HasGeoLocation', false);
    }
}

function showPosition(position) {
    localStorage.setItem('user.lat', position.coords.latitude);
    localStorage.setItem('user.long', position.coords.longitude);
}