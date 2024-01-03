<!-- Modal -->
<div class="modal fade" id="delete{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/service_trans.delete_service') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <form action="{{route("Services.destroy", $service->id)}}" method="post" autocomplete="off">
    @method('delete')
    @csrf
    <div class="modal-body">
     <input type="hidden" name="id" value="{{$service->id}}">
     <label for="name">{{ trans('Dashboard/service_trans.sure_to_delete') }} {{$service->name}}?</label>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary"
      data-dismiss="modal">{{ trans('Dashboard/service_trans.close') }}</button>
     <button type="submit" class="btn btn-primary">{{ trans('Dashboard/service_trans.save_changes') }}</button>
    </div>
   </form>
  </div>
 </div>
</div>