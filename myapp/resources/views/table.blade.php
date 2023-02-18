<!-- html website -->
<html>
<head>
    <title>My App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- vue js -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body id="app">
<div class="container">
    <h1>My App</h1>
    <p>My App is a simple app that allows you to create a list of tutorials.</p>
    <p>Click on the button below to add a new tutorial.</p>
    <a href="" class="btn btn-primary">Add Tutorial</a>
    <br><br>

    <tutorials-component tuts="{{$tutorials}}"></tutorials-component>

</div>
</body>


<!-- include app js -->
<script src="{{ asset('js/app.js') }}"></script>

</html>
