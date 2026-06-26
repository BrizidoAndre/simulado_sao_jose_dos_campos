<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhotoPortal</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap.css')}}">
</head>
<body>
{{$slot}}
<x-alerts></x-alerts>
<script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
