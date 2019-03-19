@foreach($users as $user)
    {{ $user->login }} <a href="/pages/people/edit.php?id={{$user->id}}">[ред.]</a> <a href="/pages/people/?id={{$user->id}}">[анкета]</a><br/>
@endforeach