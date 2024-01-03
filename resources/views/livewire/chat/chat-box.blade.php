<div>
    @if ($selected_conversation)
    <div class="main-content-body main-content-body-chat">
        <div class="main-chat-header">
            <div class="main-img-user"><img alt="" src="{{URL::asset('Dashboard/img/faces/9.jpg')}}"></div>
            <div class="main-chat-msg-name">
                <h6>{{$receiver->name}}</h6><small>Last seen: 2 minutes ago</small>
            </div>
            <nav class="nav">
                <a class="nav-link" href=""><i class="icon ion-md-more"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Call"><i class="icon ion-ios-call"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Archive"><i class="icon ion-ios-filing"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Trash"><i class="icon ion-md-trash"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="View Info"><i class="icon ion-md-information-circle"></i></a>
            </nav>
        </div>
        <div class="main-chat-body" id="ChatBody">
            <div class="content-inner">
                <label class="main-chat-time"><span>3 days ago</span></label>
                @foreach ($messages as $message)
                    <div class="media{{$message->sender_email==$user->email ? ' flex-row-reverse' : ' '}}">
                        <div class="main-img-user online"><img alt="" src="{{$message->sender_email==$user->email ? URL::asset('Dashboard/img/profile.png') : URL::asset('Dashboard/img/faces/9.jpg')}}"></div>
                        <div class="media-body">
                            <div class="main-msg-wrapper right"> {{$message->body}} </div>
                            <div>
                                <span>{{$message->created_at->diffForHumans()}}</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>