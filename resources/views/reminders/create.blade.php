<!-- The view for creating reminders -->

<head>
    @vite (['resources/js/app.js', 'resources/css/app.css'])
    @extends('layouts.app')
    <script src="http://maps.google.com/maps/api/js?key={{ config( 'services.google_map.api_key' )}}&language=en" async defer></script>
</head>
<h1 class="header">Create Reminder</h1>
<!-- TODO: enable resposible design -->
<form method="POST" action="/reminders">
    @csrf
    <!-- <div>
        <label for="created_user">Name</label>
        <input type="text" id="created_user" name="created_user" required />
    </div> -->
    <div class="form">
        <label for="title">Reminder title</label>
        <input type="text" id="title" name="title" class="input" required />
    </div>
    <div class="form">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="input"></textarea>
    </div>
    <!-- <div>
        <label for="user_received_reminder">Name received reminder</label>
        <input type="text" id="user_received_reminder" name="user_received_reminder" required />
    </div> -->
    <div class="form">
        <label for="remind_at">DateTime</label>
        <input type="datetime-local" id="remind_at" name="remind_at" class="input" />
    </div>
    <div class="form">
        <label for="location_name">Location name</label>
        <input type="text" id="location_name" name="location_name" class="input"/>
    </div>
    <div class="form">
        <label for="map">Map</label>
        <div id="map" style="height: 400px"></div>
        <input hidden id="latitude" name="latitude" />
        <input hidden id="longitude" name="longitude" />
    </div>
    <div class="button">
        <input type="submit" value="Create reminder!" />
    </div>
</form>