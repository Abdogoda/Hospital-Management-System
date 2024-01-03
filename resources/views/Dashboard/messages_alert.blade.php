@if (count($errors)>0)
    <div class="alert alert-danger">
     <button class="close" aria-label="Close" data-dismiss="alert" type="button">
      <span aria-hidden="ture">x</span>
     </button>
     <ul>
        <strong><u>{{ trans('Dashboard/message_trans.error') }}</u></strong>
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
     </ul>
    </div>
@endif

@if ((Session()->has('add')))
    <script>
     window.onload = function(){
      notif({
       msg: "{{trans('Dashboard/message_trans.added')}}",
       type: 'success'
      })
     }
    </script>
@endif
@if ((Session()->has('edit')))
    <script>
     window.onload = function(){
      notif({
       msg: "{{trans('Dashboard/message_trans.updated')}}",
       type: 'success'
      })
     }
    </script>
@endif
@if ((Session()->has('delete')))
    <script>
     window.onload = function(){
      notif({
       msg: "{{trans('Dashboard/message_trans.deleted')}}",
       type: 'success'
      })
     }
    </script>
@endif
@if ((Session()->has('error')))
    <script>
     window.onload = function(){
      notif({
       msg: "{{trans('Dashboard/message_trans.something_went_wrong')}}",
       type: 'danger'
      })
     }
    </script>
@endif
@if ((Session()->has('old_password_wrong')))
    <script>
     window.onload = function(){
      notif({
       msg: "{{trans('Dashboard/message_trans.old_password_wrong')}}",
       type: 'danger'
      })
     }
    </script>
@endif