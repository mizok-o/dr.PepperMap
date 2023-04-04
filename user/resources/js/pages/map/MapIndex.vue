<template>
    <div id="map"></div>
    <div class="test" :class="{ show_popup: showPopup }">
        <p>{{ title }}</p>
    </div>
</template>

<script setup>
import MapboxLanguage from '@mapbox/mapbox-gl-language';
import mapboxgl from 'mapbox-gl';
import 'mapbox-gl/dist/mapbox-gl.css';
import { onMounted, ref } from 'vue';

const props = defineProps({
    accessToken: String
});

const map = ref(null);
const title = ref("");
const showPopup = ref(false);
const isItemPosted = ref(false);

onMounted(() => {
    mapboxgl.accessToken = props.accessToken;

    const geojson = {
        'type': 'FeatureCollection',
        'features': [
            {
                'type': 'Feature',
                'properties': {
                    'message': 'dr pepper pink',
                    'iconSize': [44, 44]
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [139.5587711128723, 35.43034530096159]
                }
            },
        ]
    };

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        zoom: 5,
    });

    const language = new MapboxLanguage();
    map.addControl(language);

    map.value = map;

    for (const marker of geojson.features) {
        const el = document.createElement('div');
        const width = marker.properties.iconSize[0];
        const height = marker.properties.iconSize[1];
        el.className = 'marker';
        el.style.backgroundImage = `url(https://placekitten.com/g/${width}/${height}/)`;
        el.style.width = `${width}px`;
        el.style.height = `${height}px`;
        el.style.backgroundSize = '100%';

        el.addEventListener('click', () => {
            title.value = marker.properties.message;
            showPopup.value = true;
        });

        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map.value);
    }

    // 地図をクリックしたら投稿処理が始まる
    map.value.on('click', (event) => postItem(event));

    const geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserHeading: true
    });
    map.value.addControl(geolocate);

    map.value.on('load', function () {
        geolocate.trigger();
    });

    map.value.addControl(
        new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        })
    );
})

function postItem(event) {
    if (!window.confirm("アイテムを投稿する")) {
        return;
    }

    try {
        console.log("アイテムを保存しました。");
        isItemPosted.value = true;
    } catch (error) {
        console.error("エラー", error);
        throw error;
    }

    // アイテム投稿成功時に地図にアイコンを追加する
    if (isItemPosted.value) {
        setPostItemMarker(event);
    }
}

function setPostItemMarker(event) {
    const coordinates = event.lngLat;
    new mapboxgl.Marker().setLngLat(coordinates).addTo(map.value);
    isItemPosted.value = false;
}
</script>

<style scoped>
#map {
    position: absolute;
    top: 10vh;
    bottom: 0;
    width: 100%;
    height: 90vh;
}

.test {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 20px;
    transform: translateY(100%);
    transition: .3s;
    background-color: #fff;
    z-index: 10;
}

.show_popup {
    transform: translateY(0);
}
</style>
