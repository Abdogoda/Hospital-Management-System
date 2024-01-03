<!-- Modal -->
<div class="modal fade" id="delete{{$insurance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/insurance_trans.delete_insurance') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <form action="{{route("Insurances.destroy", $insurance->id)}}" method="post" autocomplete="off">
    @method('delete')
    @csrf
    <div class="modal-body">
     <input type="hidden" name="id" value="{{$insurance->id}}">
     <label for="name">{{ trans('Dashboard/insurance_trans.sure_to_delete') }} {{$insurance->name}}?</label>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary"
      data-dismiss="modal">{{ trans('Dashboard/insurance_trans.close') }}</button>
     <button type="submit" class="btn btn-primary">{{ trans('Dashboard/insurance_trans.save_changes') }}</button>
    </div>
   </form>
  </div>
 </div>
</div>