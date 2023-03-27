<template>
    <div id="map"></div>
</template>

<script setup>
import mapboxgl from 'mapbox-gl';
import 'mapbox-gl/dist/mapbox-gl.css';
import { onMounted } from 'vue';

const props = defineProps({
  accessToken: String
})

onMounted(() => {
    mapboxgl.accessToken = props.accessToken;

    const geojson = {
        'type': 'FeatureCollection',
        'features': [
            {
                'type': 'Feature',
                'properties': {
                    'message': 'Foo',
                    'iconSize': [44, 44]
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-66.324462, -16.024695]
                }
            },
            {
                'type': 'Feature',
                'properties': {
                    'message': 'Bar',
                    'iconSize': [44, 44]
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [-61.21582, -15.971891]
                }
            },
        ]
    };

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [-65.017, -16.457],
        zoom: 5,
    });

    for (const marker of geojson.features) {
        // Create a DOM element for each marker.
        const el = document.createElement('div');
        const width = marker.properties.iconSize[0];
        const height = marker.properties.iconSize[1];
        el.className = 'marker';
        el.style.backgroundImage = `url(https://placekitten.com/g/${width}/${height}/)`;
        el.style.width = `${width}px`;
        el.style.height = `${height}px`;
        el.style.backgroundSize = '100%';

        el.addEventListener('click', () => {
            window.alert(marker.properties.message);
        });

        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
    }

    map.addControl(
        new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true,
            showUserHeading: true
        })
    );
})
</script>

<style>
body {
    margin: 0;
    padding: 0;
}

#map {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
}
</style>
