<!DOCTYPE html>
<html>
<head>
    <title>Details</title>
</head>
<body>
<h2>{{$data->title}}</h2>
<h3>{{$data->description}}</h3>
<p>
    <iframe src="{{url('storage/'.$data->file)}}" style="width: 600px;height: 500px;" frameborder="0"></iframe>
</p>
</body>
</html>