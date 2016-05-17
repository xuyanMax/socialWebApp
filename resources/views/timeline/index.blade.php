@extends('templates.default')


@section('content')
    
    <div class="row">
        <div class="col-lg-6">
           
           
            <form role="form" action="{{ route('status.post') }}" method="post" >
                <div class="form-group {{ $errors->has('status')? ' has-error' : ''}}">
                    <textarea placeholder="What's on your mind {{Auth::user()->username}}?" name="status" class="form-control" rows="6" style="margin-top:120px"></textarea >
                    @if($errors->has('status'))
                    
                   <span class="help-block"> {{ $errors->first('status')}}</span>
                    
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Update status</button>
                
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            <hr>
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <!-- Timeline statuses and replies -->
             <!--check any statuses-->
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
                                
                                @if(!Auth::user()->hasLikedStatus($status) && $status->user->id !== Auth::user()->id)
                                    <li><a href="{{ route('status.like',['statusId'=>$status->id]) }}">Like</a>
                                    </li>
                                @elseif(Auth::user()->hasLikedStatus($status) && $status->user->id !== Auth::user()->id) <li><a href="{{ route('status.unlike', ['statusId' => $status->id])}}">Ulike</a></li>
                                    
                                @endif
                                    <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count() ) }}
                                    </li>
                            
                            </ul>
{{-------------------------------------------- each status' replies---------------------------}}
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
                                        
                                        @if(!Auth::user()->hasLikedStatus($reply) && $reply->user->id !== Auth::user()->id)
                                            <li><a href="{{ route('status.like',['statusId' => $reply->id]) }}">Like</a></li>
                                            
                                        @elseif(Auth::user()->hasLikedStatus($reply) && $reply->user->id !== Auth::user()->id)
                                         <li><a href="{{ route('status.unlike', ['statusId' => $reply->id])}}">Ulike</a></li>    
                                        @endif
                                            <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count() ) }}
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
{{-----------------------------------------END each status' replies---------------------------}}
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
                          </div>
                      </div>

                      
                 @endforeach
                 {!! $statuses->render() !!}
             @endif
             
        </div>
    </div>
@stop