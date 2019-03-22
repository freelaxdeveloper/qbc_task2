<b>{{ $item->label }}</b><br/>

<input name="dictionary_file_{{$item->id}}" type="file"><br/>
{{-- <a href="#" target="_blank">{{$item->value['value']}}</a> <a href="#">[x]</a>  --}}


@if ($item->value['file_path'])
{{-- {{dd2($destroy)}} --}}
    {{$item->value['value']}}<br>
    <br><a href="{{$item->value['file_path']}}"><img src="{{$item->value['file_path']}}" width="150" height="150" alt="lorem"></a>
    <br><a href="/manual/value/{{ $user->id }}/{{ $item->value['id'] }}/delete" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
@endif