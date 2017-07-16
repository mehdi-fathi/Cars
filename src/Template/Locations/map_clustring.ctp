
<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Location[]|\Cake\Collection\CollectionInterface $locations
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
    <h3><?= __('Locations On The Map') ?></h3>

<?php foreach ($locations as $location):

    $myJSON[] = $location;
 endforeach;
?>



    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 50%;
            width: 50%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <div id="map"></div>
    <script>

        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 3,
                center: {lat: -28.024, lng: 140.887}
            });

            // Create an array of alphabetical characters used to label the markers.
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            var markers = locations.map(function(location, i) {
                return new google.maps.Marker({
                    position: location,
                    label: labels[i % labels.length]
                });
            });

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers,
                    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }
        var locationsTable=<?php echo json_encode($myJSON); ?>

        var locations=[];

        for(var i = 0; i < locationsTable.length; i++) {
            var obj = locationsTable[i];

            locations.push({  'lat': parseFloat(obj.latitube) , 'lng': parseFloat(obj.longitube) });
        }
    </script>



    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEz1aRtzotd8Pd2VbNxn6Mn9oy7RaqwOs&callback=initMap"
            type="text/javascript"></script>

