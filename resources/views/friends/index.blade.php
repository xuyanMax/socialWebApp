@extends('templates.default')


@section('content')

    <div class="row">
	 	<div class="col-lg-6">
	 		<h3>Your friends</h3>

	 		<!-- List of friends -->
	 		@if(!$friends->count())
               
               <p>You have no friends.</p>
            @else

                @foreach($friends as $user)
                
                    @include('user.partials.userBlock')
                
                @endforeach
            
            @endif
	 	</div>
	 	<div class="col-lg-6">
	 		<h4>Friend requests</h4>

	 		<!--List of friend requests -->
	 	</div>
	 </div>
    
@stop