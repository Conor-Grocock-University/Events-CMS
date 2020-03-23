@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <div class="details">
        <div class="form-group">
            <label for="name">What do you want to call your event</label>
            <input type="text" id="name" name="name" autocomplete="off" value={{ old('name') }}>
        </div>
        <div class="form-group">
            <label for="start-time">When does your event start</label>
            <input type="datetime-local" id="start-time" name="start-time" value="{{ \Carbon\Carbon::now()->format("yy-m-d\Th:i") }}">
        </div>

        <div class="form-group">
            <label for="tags">Please enter some tags to help us market your event (Comma seperated)</label>
            <input type="textbox" id="tags" name="tags" autocomplete="off" value={{ old('tags') }}>
        </div>
    </div>
    <input type="hidden" id="map_latitude" name="latitude" value={{ old('map_latitude') }}>
    <input type="hidden" id="map_longitude" name="longitude" value={{ old('map_longitude') }}>

    <div class="full_width">
        <textarea name="description">Tell us about your event!</textarea>
        <div id="map"></div>
    </div>

    <input type="submit" value="Create new event">
</form>

@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/o7o92xdgyi42506wphcfkscjugj1p54qm2bycxih0za667kd/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
    <script>tinymce.init({
        selector:'textarea',
        height: 400,
        plugins: 'a11ychecker advcode formatpainter linkchecker lists checklist powerpaste table tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter table',
      });</script>

    <script>
        var map;
        function initMap() {
            var myLatlng = new google.maps.LatLng(53.3771868,-1.4751143);
            updateLocationForm(myLatlng.lat(), myLatlng.lng());

            var mapOptions = {
                zoom: 10,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map
            });

            map.addListener(
                "click",
                function (event) {
                    marker.setPosition(event.latLng);
                    updateLocationForm(event.latLng.lat(), event.latLng.lng());
                }
            );
        }

        function updateLocationForm(lat, long) {
            document.getElementById("map_latitude").value = lat;
            document.getElementById("map_longitude").value = long;
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkLGoWEiu2GicrgPCEJi2_S53JN6-Xm2Q&callback=initMap" async defer></script>
@endsection

@section('styles')
<link href="{{ asset('css/event/create.css') }}" rel="stylesheet">
<link href="{{ asset('css/partial/form.css') }}" rel="stylesheet">
@endsection
