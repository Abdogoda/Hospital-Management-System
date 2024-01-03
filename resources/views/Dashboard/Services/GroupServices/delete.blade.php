<!-- Modal -->
<div class="modal fade" id="delete{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/section_trans.delete_department') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <form action="{{route("Sections.destroy", 'test')}}" method="post" autocomplete="off">
    @method('delete')
    @csrf
    <div class="modal-body">
     <input type="hidden" name="id" value="{{$section->id}}">
     <label for="name">{{ trans('Dashboard/section_trans.sure_to_delete') }} {{$section->name}}?</label>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary"
      data-dismiss="modal">{{ trans('Dashboard/section_trans.close') }}</button>
     <button type="submit" class="btn btn-primary">{{ trans('Dashboard/section_trans.save_changes') }}</button>
    </div>
   </form>
  </div>
 </div>
</div>