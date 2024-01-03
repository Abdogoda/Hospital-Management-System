<div class="main-chat-list" id="ChatList">
    @foreach ($conversations as $conversation)
        <div wire:click="ChatUserSelect({{$conversation}}, {{$this->getOtherUser($conversation)->id}})" class="media new">
            <div class="main-img-user online">
                <img alt="" src="{{URL::asset('Dashboard/img/profile.png')}}"> <span>2</span>
            </div>
            <div class="media-body">
                <div class="media-contact-name">
                    <span>{{$this->getOtherUser($conversation)->name}}</span> 
                    <span>{{$conversation->Messages->last()->created_at->diffForHumans()}}</span>
                </div>
                <p>{{$conversation->Messages->last()->body}}</p>
            </div>
        </div>
    @endforeach
</div>