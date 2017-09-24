<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

</head>
<body>
<div class="flex-center position-ref full-height">
    <p>Check out the notifiable trait </p>
    @foreach(\Illuminate\Support\Facades\Auth::user()->unreadNotifications as $notification)
        <p>{{$notification->type}} </p>
    @endforeach

    <form action="{{route('mark-read')}}" method="post">
        {{method_field('DELETE')}}
        {{csrf_field()}}
        <button type="submit">Mark Read</button>
    </form>
</div>
</body>
</html>
