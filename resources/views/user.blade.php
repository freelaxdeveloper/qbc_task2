<h1>{{ $user->login }}</h1>

@foreach($manualtypes as $manualtype)
   <b>{{ $manualtype->title }}</b><br><br>
    @foreach($manualtype->manuals as $item)
        {{$item->label}}: {{$item->value['value']}} <br/>
    @endforeach
   <hr/>
@endforeach
