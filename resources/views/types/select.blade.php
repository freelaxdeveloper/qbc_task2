<b>{{ $item->label }}</b><br/>

<select name="dictionary[{{$item->id}}]">
  @foreach ($item->options as $option)
    <option value="{{ $option->label }}">{{ $option->label }}</option>
  @endforeach
</select>
<br>
