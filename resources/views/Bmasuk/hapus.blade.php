<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<td> <form action="/jurusan{{$Keperluan->id}}" method="POST">

  <input type="hidden" name="_method" value="delete"></input>

  
<input type="hidden" name="_token" value="{{csrf_token()}}">

  <input class="btn btn-danger" type="submit" name="name" value="delete" >
 
 
  
</form>
</body>
</html>