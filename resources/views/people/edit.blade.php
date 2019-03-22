<a href="/">Home</a><br/><br/><br/>
<h1>{{ $user->login }}</h1>

<form action="/pages/people/{{ $user->id}}/edit" method="POST" enctype="multipart/form-data">
    @foreach ($manualTypes as $manualtype)
        <b>{{ $manualtype->title }}</b><br/><br/>
            @foreach ($manualtype->manuals as $item)
                @include('types.' . $item->type_field, ['item' => $item, 'user' => $user])
        @endforeach

    @endforeach
    <br/>
    <input name="send" type="submit" value="Отправить">
</form>