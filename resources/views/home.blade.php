@foreach($users as $user)
    {{ $user->login }} <a href="/pages/people/{{$user->id}}/edit">[ред.]</a> <a href="/pages/people/{{$user->id}}">[анкета]</a><br/>
@endforeach