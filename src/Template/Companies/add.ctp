<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Logos'), ['controller' => 'Logos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logo'), ['controller' => 'Logos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companies form large-9 medium-8 columns content">
    <?= $this->Form->create($company, array('type' => 'file')) ?>
    <fieldset>
        <legend><?= __('Add Company') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('city');
            echo $this->Form->control('established_date');
            echo $this->Form->control('location.latitube', ['id'=>'lat','type'=>'hidden']);
            echo $this->Form->control('location.longitube', [ 'id'=>'lng','type'=>'hidden']);
        ?>
        <?php
        echo $this->Form->file('file');
        ?>

    </fieldset>





    <div id="map" style="width:100%;height:300px;"></div>

    <script>
        function myMap() {
            var mapCanvas = document.getElementById("map");
            var myCenter=new google.maps.LatLng(51.508742,-0.120850);
            var mapOptions = {center: myCenter, zoom: 5};
            var map = new google.maps.Map(mapCanvas, mapOptions);
            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(map, event.latLng);

                console.log(event.latLng.lat());

                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lng').value = event.latLng.lng();


            });
        }
        var marker;

        function placeMarker(map, location) {

            if ( marker ) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEz1aRtzotd8Pd2VbNxn6Mn9oy7RaqwOs&callback=myMap"
            type="text/javascript"></script>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
