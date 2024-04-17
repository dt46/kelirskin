<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    {{-- @if (auth()->user()->role->name == "admin")
    @elseif(auth()->user()->role->name == "petugas")
    @else
    @endif --}}

    <br>
    {{ "nama: " . auth()->user()->name  }}
    <br>
    {{ "role: " . auth()->user()->role->name  }}

    <form action="/signout" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>

</html>