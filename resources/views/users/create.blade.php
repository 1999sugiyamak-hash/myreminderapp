<!-- The view for creating users -->

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="vapid-public-key" content="{{ config('webpush.vapid.public_key') }}">
</head>
<h1>Create User</h1>
<!-- TODO: enable resposible design -->
<form method="POST" action="/users">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required />
    </div>

</form>