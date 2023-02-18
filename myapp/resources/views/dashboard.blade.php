<html>
    <title>Hello World</title>
</html>

<!-- blade loop -->
@foreach($data as $key => $user)
    <!-- if condition with string match-->
    <p>{{ $key }} : {{ $user->email }}</p>
@endforeach
