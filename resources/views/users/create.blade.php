<!-- The view for creating users -->

<head>
    @extends('layouts.app')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.validPublicKey = "{{ config('services.web_push.public_key') }}";
    </script>
</head>

<body>
    <h1>Create User</h1>
    <!-- TODO: enable resposible design -->
    <form method="POST" action="/users">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required />
        </div>
    </form>
    <script>
        async function registerUser() {
            const registration = await navigator.serviceWorker.register('/sw.js');
            await navigator.serviceWorker.ready;

            const permission = await Notification.requestPermission();
            if (permission !== 'granted') {
                alert('Please enable notifications');
                return;
            }

            const subscription = await registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: window.validPublicKey,
            })
            const pushData = subscription.toJSON();

            console.log(pushData);
        }
    </script>
</body>