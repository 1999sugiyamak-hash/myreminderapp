<!-- The view for reminders index -->
@extends('layouts.app')
<h1>All Reminders</h1>

@foreach ($reminders as $reminder)
    <div>
        <h2>{{$reminder->title}}</h2>
        <p>{{$reminder->description}}</p>
        <p>{{$reminder->remind_at}}</p>
    </div>
@endforeach