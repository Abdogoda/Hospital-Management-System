<!-- Modal -->
<div class="modal fade" id="edit{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/section_trans.edit_department') }}</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="{{route("Sections.update", 'test')}}" method="post" autocomplete="off">
      @method('patch')
     @csrf
     <div class="modal-body">
      <input type="hidden" name="id" value="{{$section->id}}">
       <label for="name">{{ trans('Dashboard/section_trans.department_name') }}</label>
       <input type="text" id="name" value="{{$section->name}}" name="name" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Dashboard/section_trans.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('Dashboard/section_trans.save_changes') }}</button>
      </div>
      </form>
   </div>
 </div>
</div>