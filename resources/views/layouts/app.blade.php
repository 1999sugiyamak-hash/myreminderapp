<!-- The template for sw.js to work in all pages -->

   @vite('resources/css/app.css')
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <script>
      navigator.serviceWorker.register('/sw.js')
   </script>