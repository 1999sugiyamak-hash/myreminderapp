<!-- The view for moving to reminder creation page after user registration -->

<head>
    @vite(['resources/css/app.css'])
    @extends('layouts.app')
</head>
<div class="button" style="margin-top: 100px;">
    <button onclick="location.href='/reminders/create'">Let's Create Reminder!!</button>
</div>