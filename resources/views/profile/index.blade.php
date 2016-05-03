@extends('templates.default')


@section('content')   
   <div class="row">
        <div class="col-lg-5">
            <!-- User information and status -->
        
            @include('user.partials.userBlock')
            <hr>
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            <!-- Friend , Friend request -->
            <h4> {{  $user->getFirstNameOrUsername() }}'s friends.</h4>
            
            @if(!$user->friends()->count())
               
               <p>{{ $user->getFirstNameOrUsername() }} has no friends.</p>
                
            @else
{{--            as $friend does not work here--}}
                @foreach( $user->friends() as $user)
                
                    @include('user.partials.userBlock')
                
                @endforeach
            
            @endif
        
        </div>
    </div>      
   
@stop