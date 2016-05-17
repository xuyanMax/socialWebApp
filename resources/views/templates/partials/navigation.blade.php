<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style= "margin-bottom:2cm">
        <div class="container">
               <div class="navbar-brand">
                  <a href="{{ route('home')}}">XiPuBook</a>
                   
               </div>
                             
                <div class="collapse navbar-collapse">
                      @if(Auth::check())
                        <ul class="nav navbar-nav">
                               <li><a href="{{ route('home')}}"><span class="glyphicon glyphicon-home         
                aria-hidden ="true></span>Home</a></li>
                                <li><a href="{{ route('home')}}">Moments</a></li>
                                <li><a href="{{ route('friends.index') }}">Friends</a></li>
                        </ul>
                       
                        <form action="{{ route('search.results') }}" role="search" class="navbar-form navbar-left">
                                <div class="form-group">
                                        <input type="text" name="query" class="form-control" width="150px"
                                        placeholder="Search people/ an ISBN"/>
                                </div>
                                
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                                
                                
                                
                        </form>
                      @endif
                        <ul class="nav navbar-nav navbar-right">
                            @if(Auth::check())
                                <li><a href="{{ route('profile.index',['username'=>Auth::user()->username])}}">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"> {{ Auth::user()-> getNameOrUsername() }}
                                </span></a></li>
                                <li><a href="{{ route('profile.edit')}}">Update profile</a></li>
                                <li><a href="{{ route('auth.signout')}}">Sign out</a></li>
                            @else
                                <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                                <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                            @endif
                        </ul>
                </div>
        </div>
</nav>