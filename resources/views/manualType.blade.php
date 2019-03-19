<form action="?" method="POST" enctype="multipart/form-data">

  @foreach ($manualTypes as $manualType)
    <b>{{ $manualType->title }}</b><br/><br/>

    @foreach ($manualType->manuals as $item)
      @include('types.' . $item->type_field, ['item' => $item, 'manualType' => $manualType])
    @endforeach

  @endforeach
  <br/>
  <input name="send" type="submit" value="Отправить">
</form>