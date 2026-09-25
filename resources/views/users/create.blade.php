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

            console.log(registration);
            const permission = await Notification.requestPermission();
            if (permission !== 'granted') {
                alert('Please enable notifications');
                return;
            }

            // // Get webpush data
            // const subscription = await registration.pushManager.subscribe({
            //     userVisibleOnly: true,
            //     applicationServerKey: window.validPublicKey,
            // })
            // const pushData = subscription.toJSON();

            // console.log(pushData);

            // Submit webpush data with user name
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

                    console.log(pushData);

                    await fetch({
                        method: 'POST',
                        body: JSON.stringify({
                            endpoint: pushData.endpoint,
                            key: pushData.keys.p256ph,
                            auth: pushData.keys.auth,
                        }),
                    });
                })
            } catch (e) {
                console.log(e);
            }
            // await fetch(form.action, {
            //     method: 'POST',
            //     body: JSON.stringify({
            //         endpoint: pushData.endpoint,
            //         key: pushData.keys.p256ph,
            //         auth: pushData.keys.auth,
            //     }),
            // });
            // console.log(pushData.endpoint);
            // console.log(pushData.keys);
        }

        registerUser();
    </script>
</body>