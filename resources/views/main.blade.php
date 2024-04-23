<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM1BDr8MbqGuH6vy/c4ul2hynQ9aYvLZ5Vh4/R" crossorigin="anonymous">

</head>
<style>
  html {
    scroll-behavior: smooth;
  }
</style>
<body>

  @include('template.navbar')

  @yield('content')





</body>

@include('template.footer')

</html>
