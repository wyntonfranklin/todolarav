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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tutorials as $tutorial)
                    <tr>
                        <td><img src="{{$tutorial->featuredImage}}" style="height: 40px;"/>{{ $tutorial->title }}</td>
                        <td>{{ $tutorial->description }}</td>
                        <td></td>
                        <td>
                            <a href="{{ route('tutorials.view',['id'=>$tutorial->id]) }}" class="btn btn-info">Show</a>
                            <a href="" class="btn btn-primary">Edit</a>
                            <form action="" method="post" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="app"></div>

            <example-component />
        </div>
    </body>


<!-- include app js -->
<script src="{{ asset('js/app.js') }}"></script>

</html>
