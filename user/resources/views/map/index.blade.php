@extends('app')

@section('content')
<div class="map_container" style="position: relative; height: 100vh; max-width: 450px; margin: 0 auto;">
    <h1>地図</h1>
    <map-index access-token="{{ $accessToken }}"></map-index>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ mix("/css/map.css") }}" />
@endpush

@push('script')
<script src="{{ mix('js/pages/map/index.js') }}"></script>
@endpush
