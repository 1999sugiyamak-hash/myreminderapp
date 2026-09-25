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
    <form method="POST" action="/users" id="create-user-form">
        @csrf
        <div>
            <input id="endpoint" name="endpoint" hidden />
            <input id="key" name="key" hidden />
            <input id="token" name="token" hidden />
            <input id="encoding" name="encoding" hidden />
        </div>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required />
        </div>
        <div>
            <input type="submit" value="Create User!" />
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

            try {
                const form = document.getElementById('create-user-form')

                form.addEventListener('submit', async function(e) {
                    // Get webpush data
                    e.preventDefault();
                    
                    const subscription = await registration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: window.validPublicKey,
                    })
                    const pushData = subscription.toJSON();

                    const encoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

                    document.getElementById('endpoint').value = pushData.endpoint;
                    document.getElementById('key').value = pushData.keys.p256dh;
                    document.getElementById('token').value = pushData.keys.auth;
                    document.getElementById('encoding').value = encoding;

                    form.submit();
                })
            } catch (e) {
                console.log(e);
            }
        }

        registerUser();
    </script>
</body>