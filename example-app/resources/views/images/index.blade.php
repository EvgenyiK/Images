<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Список картинок</title>
</head>
<body>

<div class="container mt-5 mb-3 d">
    <div class="row">
        @foreach($images as $item)
        <div class="card p-3 mb-2" style="width: 18rem;">
            <img src="{{ Storage::url('image/thumbnail/'.$item->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">{{$item->name}}, {{$item->created_at}}</p>
                <a href="{{ Storage::url('image/origin/'.$item->image) }}" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        @endforeach
    </div>
</div>


</body>
</html>
