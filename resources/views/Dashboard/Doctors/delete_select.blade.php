<!-- Modal -->
<div class="modal fade" id="delete_selected_doctors" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/doctor_trans.delete_doctors') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <form action="{{route("Doctors.destroy", 'test')}}" method="post" autocomplete="off">
    @method('delete')
    @csrf
    <div class="modal-body">
     <input type="hidden" name="delete_select_id"  id="delete_select_id" value="">
     <input type="hidden" name="one_multi" value="multi">
     <label>{{ trans('Dashboard/doctor_trans.sure_to_delete') }} <span class="count"></span> {{ trans('Dashboard/doctor_trans.doctors') }}?</label>
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

