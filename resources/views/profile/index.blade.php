@extends('templates.default')


@section('content')   
   <div class="row">
        <div class="col-lg-5">
            <!-- User information and status -->
        
            @include('user.partials.userBlock')
            <hr>
            
            
        </div>
        <!-- Auth::user() returns an instance of the authenticated user... -->
        <div class="col-lg-4 col-lg-offset-3">
            <!-- Friend , Friend request friend_id add user_id as a friend -->

            @if (Auth::user()->hasFriendRequestPending($user) )
	 	        <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
	 	     
              
            @elseif (Auth::user()->hasFriendRequestReceived($user) )
            <a href="#" class="btn btn-primary">Accept friend request</a>
            
            @elseif (Auth::user()->isFriendsWith($user) )
            <a href="#" class="btn btn-primary">You and {{ $user->getNameOrUsername()}} are friends.</a>
            
            @else <a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-primary">Add as friend</a>
	 	        
	 	    @endif
           
            <h4> {{  $user->getFirstNameOrUsername() }}'s friends.</h4>
            
            @if(!$user->friends()->count())
               
               <p>{{ $user->getFirstNameOrUsername() }}  has no friends.</p>
                
            @else
            
{{--            as $friend does not work here--}}
                @foreach( $user->friends() as $user)
                
                    @include('user.partials.userBlock')
                
                @endforeach
            
            @endif
        
        </div>
    </div>      
   
@stop