<!-- The template for sw.js to work in all pages -->

   @vite('resources/css/app.css')
   <meta name="viewport" content="width=device-width, initical-scale=1.0" />
   <link rel="manifest" href="/manifest.json" />
   <script>console.log('load manifest')</script>
   <script>
      navigator.serviceWorker.register('/sw.js')
   </script>
