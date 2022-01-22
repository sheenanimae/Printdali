<!-- Main content -->

<div id="map"></div>


<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrP5iSdXj-EsckjLa5JmAzcqLqLC5xzhU&callback=initMap&libraries=&v=weekly&channel=2"
    async></script>

<script>
var arr = [];
var newarr = [];
var longH, latH;
let url = new URL(window.location.href);
let search_params = url.searchParams;
var vendorID = search_params.get('vendorID');
// console.log(vendorID);

$.ajax({
    type: "POST",
    url: window.location.origin + "/Printdali/Login/GetallVendorelocation",
    success: function(result) {
        var data = JSON.parse(result);
        for (let x = 0; x < data.length; x++) {
            arr.push(data[x]);
        }
        for (var ii = 0; ii < arr.length; ii++) {
            newarr.push(new Array());
            for (var key in arr[ii]) {
                newarr[ii].push(data[ii][key]);
            }
            // console.log(newarr);
        }
    }
})
if (vendorID != null) {
    $.ajax({
        type: "POST",
        url: window.location.origin + "/Printdali/Login/GetVendorelocationByvedndorID",
        data: {
            vendorID: vendorID
        },
        success: function(result) {
            var data = JSON.parse(result);
            longH = data[0]['locationLong'];
            latH = data[0]['locationLat'];
        }
    })
}

function initMap() {
    if (vendorID == null) {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(8.4542, 124.6319),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    } else {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 20,
            center: new google.maps.LatLng(latH, longH),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    }


    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < newarr.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(newarr[i][5], newarr[i][6]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(
                    "<center><h3>" + newarr[i][3] + "</h3></center><br>" +
                    "<div>" +
                    "<img id='Store-img' src='" + window.location.origin +
                    "/Printdali/assets/VendorApplicationData/" + newarr[i][0] +
                    "/" + newarr[i][1] +
                    "' style='max-width: 250px; height: auto; '/>" +
                    "</div>"
                );
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

}
</script>

<script>
$(document).ready(function() {
    initMap();
    $('#respondentMenu').removeClass('active');
    $('#complainMenu').removeClass('active');
    $('#applicationMenu').removeClass('active');
    $('#accountMenu').removeClass('active');
    $('#shopMenu').addClass('active');

    $('#dropdowncomplainMenu').removeClass('menu-is-opening menu-open');
    $('#dropdownaccountMenu').removeClass('menu-is-opening menu-open');
    $('#dropdownapplicationMenu').removeClass('menu-is-opening menu-open');

});
</script>