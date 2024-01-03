<!-- Modal -->
<div class="modal fade" id="change_password{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/doctor_trans.change_password') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <form action="{{route("Doctors.changePassword")}}" method="post" autocomplete="off">
    @method('post')
    @csrf
    <div class="modal-body">
     <input type="hidden" name="id" value="{{$doctor->id}}">
     <div class="form-group">
      <label for="old_password">{{ trans('Dashboard/doctor_trans.old_password') }}</label>
      <input type="password" name="old_password" id="old_password" required class="form-control" autofocus>
     </div>
     <div class="form-group">
      <label for="password">{{ trans('Dashboard/doctor_trans.new_password') }}</label>
      <input type="password" name="password" id="password" required class="form-control">
     </div>
     <div class="form-group">
      <label for="password_confirmation">{{ trans('Dashboard/doctor_trans.con_password') }}</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">
     </div>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary"
      data-dismiss="modal">{{ trans('Dashboard/doctor_trans.close') }}</button>
     <button type="submit" class="btn btn-primary">{{ trans('Dashboard/doctor_trans.save_changes') }}</button>
    </div>
   </form>
  </div>
 </div>
</div>