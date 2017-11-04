<p>Name : {{$data['name']}}</p>
<p>hey there </p>
<p>plz like this image </p>
<p><img width="200px" height="200px" src="{{asset('/storage/images/'.$data['path'])}}"></p>
<p style="text-align: center"><a style="background-color: #ccc; pading:10;" href="{{url('/image/'.$data['id_image'])}}">click here </a></p>