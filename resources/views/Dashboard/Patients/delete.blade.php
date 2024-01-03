<!-- Modal -->
<div class="modal fade" id="delete{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/patient_trans.delete_patient') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <form action="{{route("Patients.destroy", $patient->id)}}" method="post" autocomplete="off">
    @method('delete')
    @csrf
    <div class="modal-body">
     <input type="hidden" name="id" value="{{$patient->id}}">
     <label for="name">{{ trans('Dashboard/patient_trans.sure_to_delete') }} {{$patient->name}}?</label>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary"
      data-dismiss="modal">{{ trans('Dashboard/patient_trans.close') }}</button>
     <button type="submit" class="btn btn-primary">{{ trans('Dashboard/patient_trans.save_changes') }}</button>
    </div>
   </form>
  </div>
 </div>
</div>