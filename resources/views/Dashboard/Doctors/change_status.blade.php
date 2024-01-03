<!-- Modal -->
<div class="modal fade" id="change_status{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/doctor_trans.change_status') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <form action="{{route("Doctors.changeStatus")}}" method="post" autocomplete="off">
    @method('post')
    @csrf
    <div class="modal-body">
     <input type="hidden" name="id" value="{{$doctor->id}}">
     <input type="hidden" name="status" value="{{$doctor->status}}">
     <label for="name">{{ trans('Dashboard/doctor_trans.sure_to_change_status') }} <b>{{$doctor->status == 1 ? trans('Dashboard/doctor_trans.active') : trans('Dashboard/doctor_trans.deactive')}}</b> {{ trans('Dashboard/doctor_trans.to') }} <b>{{$doctor->status == 1 ? trans('Dashboard/doctor_trans.deactive') : trans('Dashboard/doctor_trans.active')}}</b>?</label>
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