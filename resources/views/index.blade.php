<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="/css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	</head>
	<body>
    <form action="/dd">
        @csrf
    </form>
    <form action="/fdv">
        @csrf
    </form>
		<div id="wrapper">
			<h1>Объявления</h1>
            <form>
                <div class="page-header">
                    @foreach($categories as $category)
                        <a class="btn" href="{{$category->id}}">{{$category->name}}</a>
                    @endforeach
                </div>
            </form>

            @foreach($advertisements as $advertisement)
                <form action="{{route('update')}}" method="post">
                    @csrf
                    <div class="note">
                        <p>
                            <span class="date">{{$advertisement->created_at}}</span>
                            <span class="name">{{$advertisement->name}}</span>
                        </p>
                        <p>{{$advertisement->description}}</p>
                    </div>
                    <input class="d-none" name="id" value="{{$advertisement->id}}">
                    @php
                    @endphp
                    <button class="btn-default">UP</button>
                </form>
            @endforeach
		</div>

    @if($utility_collection['is_first'])
        <form action="{{ route('store') }}" method="POST">

            @csrf

            <div class="row" style="width: 500px;" >
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <input class="" name="category_id" value="{{$utility_collection['category']}}">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    @else
        <h1>Выберите категорию</h1>
    @endif
	</body>
</html>

