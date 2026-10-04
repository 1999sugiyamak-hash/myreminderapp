<!-- The template for sw.js to work in all pages -->
<head>
   @vite('resources/css/app.css')
   <meta name="viewport" content="width=device-width, initical-scale=1.0" />
   <link rel="manifest" href="/manifest.json" crossorigin="use-credentials"/>
   <script>console.log('load manifest')</script>
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <script>
      navigator.serviceWorker.register('/sw.js')
   </script>
   @yield('head')
</head>
<body>
   @csrf
   @yield('body')
</body>
