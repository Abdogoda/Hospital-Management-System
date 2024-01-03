<div>
    @if ($selected_conversation)
    <form wire:submit.prevent="sendMessage" method="post">
        <div class="main-chat-footer">
            @csrf
            <input class="form-control" wire:model="body" placeholder="اكتب رسالتك...." type="text" autofocus> 
            <button type="submit" class="main-msg-send text-dark" style="outline: none;border:none; background:none"><i class="far fa-paper-plane"></i></button>
        </div>
    </form>
    @endif
</div>