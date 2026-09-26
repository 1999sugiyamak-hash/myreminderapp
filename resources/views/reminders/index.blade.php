<!-- The view for reminders index -->

<head>
    @vite('resources/css/app.css')
    @extends('layouts.app')
</head>
<h1 class="header">All Reminders</h1>
<div class="button">
    <button onclick="location.href='/reminders/create'">Let's Create Reminder!!</button>
</div>
<div class="button">
    <button onclick="location.href='/users/create'">User Registration</button>
</div>
@foreach ($reminders as $reminder)
<div class="card">
    <div class="reminder">
        <h2 class="title">{{$reminder->title}}</h2>
        <p class="description">{{$reminder->description}}</p>
        @isset($reminder->remind_at)
        <p class="remind_at">Remind at {{$reminder->remind_at}}</p>
        @endisset
        @isset($reminder->location_name)
        <p class="location">Remind when you are near {{$reminder->location_name}}</p>
        @endisset
        <div class="button">
            <form method="POST" action="/reminders/complete/{{$reminder->id}}">
                @method('PATCH')
                <input type="submit" value="Complete!" />
            </form>
        </div>
    </div>
</div>
@endforeach