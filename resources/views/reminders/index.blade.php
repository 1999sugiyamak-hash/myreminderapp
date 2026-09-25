<!-- The view for reminders index -->

<h1>All Reminders</h1>

@foreach ($reminders as $reminder)
    <div>
    <h2>{{$reminder->title}}</h2>
        <p>{{$reminder->description}}</p>
        <p>{{$reminder->remind_at}}</p>
        <div>
            <form method="POST" action="/reminders/complete/{{$reminder->id}}">
                @method('PATCH')
                <input type="submit" value="Complete!" />
            </form>
        </div>
    </div>
@endforeach