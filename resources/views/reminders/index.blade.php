<!-- The view for reminders index -->
@extends('layouts.app')

@section('body')
<h1 class="header">All Reminders</h1>
<div>
    <button onclick="location.href='/reminders/create'" class="button">Let's Create Reminder!!</button>
</div>
<div>
    <button onclick="location.href='/users/create'" class="button">User Registration</button>
</div>
@foreach ($reminders as $reminder)
@php
$reminder_class = $reminder->reminded ? "reminded_reminder" : "reminder"
@endphp

<div class="card">
    <div class={{$reminder_class}}>
        <h2 class="title">{{$reminder->title}}</h2>
        <p class="description">{{$reminder->description}}</p>
        @isset($reminder->remind_at)
        <p class="remind_at">Remind at {{$reminder->remind_at}}</p>
        @endisset
        @isset($reminder->location_name)
        <p class="location">Remind when you are near {{$reminder->location_name}}</p>
        @endisset
        <div>
            <form method="GET" action="/reminders/update/{{$reminder->id}}">
                <input type="submit" value="Update datatime or location" class="button" />
            </form>
        </div>
        <div>
            <form method="POST" action="/reminders/complete/{{$reminder->id}}">
                @method('PATCH')
                <input type="submit" value="Complete!" class="button" />
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection