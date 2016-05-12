<div class="media">
    <a href="{{ route('profile.index', ['username'=>$user->username]) }}" class="pull-left">
        <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNameOrUsername() }}" class="media-object">
    </a>
    
    <div class="media-body">
        <h4 class="media-heading">
        <a href="{{ route('profile.index', ['username' =>$user->username ]) }}">{{ $user->getNameOrUsername() }}
        </a>
        </h4>
    {{-- If authenticated user is not friend with user, does not show his/her personal info.  --}}
        @if(Auth::user()->isFriendsWith($user))
            @if($user->location || $user->id_number)


                <p>{{ $user->id_number }}</p>
                <p>{{ $user->location }}</p>

            @endif
       @endif
        
    </div>
</div>