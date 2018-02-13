<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ url("bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ url("bootstrap/css/bootstrap-theme.min.css") }}">
    <!-- jquery js -->
    <script src="{{ url("js/jquery-3.2.1.min.js") }}"></script>
    <!-- bootstrap js -->
    <script src="{{ url("bootstrap/js/bootstrap.js") }}"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="{{ url("style.css") }}">
    <!-- custom js -->
    <script src="{{ url("script.js") }}"></script>

  </head>
  <body>
    @section('content')
    @show
  </body>
    @section('afterBody')
</html>
