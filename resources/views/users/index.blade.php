<!-- The view for moving to reminder creation page after user registration -->
@extends('layouts.app')

@section('body')
<div style="margin-top: 100px;">
    <button onclick="location.href='/reminders/create'" class="button">Let's Create Reminder!!</button>
</div>
@endsection