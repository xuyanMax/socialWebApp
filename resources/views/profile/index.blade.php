@extends('templates.default')


@section('content')   
   <div class="row">
        <div class="col-lg-5">
            <!-- User information and status -->
        
            @include('user.partials.userBlock')
            <hr>
            
            @if(!$statuses -> count())
                 <p>You have not updated your status yet.</p>
             @else
                {{--  Loop statuses --------}}
                 @foreach($statuses as $status)
                      <!-- Downloaded code-->
                      <div class="media">
                        <a class="pull-left" href="{{route('profile.index', ['username'=>$status->user->username]) }}">
                            <img class="media-object" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
                        </a>
                          <div class="media-body">
                            <h4 class="media-heading"><a href="{{route('profile.index', ['username'=>$status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
                            <p>{{ $status->body }}</p>
                            <ul class="list-inline">
                                <li>{{ $status->created_at->diffForHumans() }}</li>
{{--
                                @if($status->user->id !== Auth::user()->id)
                                    <li><a href="{{ route('status.like',['statusId' => $status->id]) }}">Like</a></li>
                                    <li>10 likes</li>
                                @endif
--}}
                            </ul>
        
                        @foreach($status->replies as $reply)
                            <div class="media">
                                <a class="pull-left" href="{{route('profile.index', ['username'=>$reply->user->username]) }}">
                                    <img class="media-object" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
                                </a>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="{{route('profile.index', ['username'=>$reply->user->username]) }}">{{$reply->user->getNameOrUsername() }}</a></h5>
                                    <p>{{ $reply->body}}</p>
                                    <ul class="list-inline">
                                        <li>{{$reply->created_at->diffForHumans()}}</li>
                                        
                                        @if($reply->user->id !== Auth::user()->id)
                                            <li><a href="{{ route('status.like',['statusId'=>$reply->id])}}">Like</a></li>
                                            <li>4 likes</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($authUserIsFriend || Auth::user()->id === $status->user->id)
                            <form role="form" action="{{ route('status.reply',['statusId' => $status->id])}}" method="post">
                                <div class="form-group{{ $errors->has("reply-{$status->id}")? ' has-error' : ''}}">
                                    <textarea name="reply-{{$status->id}}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
                                    
                                    @if($errors->has("reply-{$status->id}"))                             
                                    <span class="help-block">{{ $errors->first("reply-{$status->id}")}}</span>
                                    @endif
                                    
                                </div>
                                <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </form>
                        @endif
                          </div>
                      </div>

                      
                 @endforeach
                
             @endif
        </div>
        <!-- Auth::user() returns an instance of the authenticated user... -->
        <div class="col-lg-4 col-lg-offset-3">
            <!-- Friend , Friend request friend_id add user_id as a friend -->

            @if (Auth::user()->hasFriendRequestPending($user) )
 	 	        <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
	 	     
              
            @elseif (Auth::user()->hasFriendRequestReceived($user) )
                <a href="{{ route('friends.accept',['username'=>$user->username ])}}" class="btn btn-primary">Accept friend request
                </a>
            
            @elseif (Auth::user()->isFriendsWith($user) )
                <a href="#" class="btn btn-primary">You and {{ $user->getNameOrUsername()}} are friends.</a>
            
            <!--if the authenticated user id does equal current user if-->
            @elseif(Auth::user()->id !== $user->id) 
                <a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-primary">Add as friend</a>
	 	        
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