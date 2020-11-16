<!DOCTYPE html>
<html>
<head>
    <title>view</title>
</head>
<body>

<table border="1">
    <tr>
    <th>S1</th>
    <th>Title</th>
    <th>Description</th>
    <th>View</th>
    <th>Download</th>
    </tr>
    @foreach($file as $key=>$data)
    <tr>
        <td>{{++$key}}</td>
        <td>{{$data->title}}</td>
        <td>{{$data->description}}</td>
        <td><a href="/files/{{$data->id}}">View</a></td>
        <td><a href="/file/download/{{$data->file}}">Download</a></td>
    </tr>
    @endforeach
</table>
    
</body>
</html>