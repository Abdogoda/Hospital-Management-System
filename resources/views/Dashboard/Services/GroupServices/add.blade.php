<!-- Modal -->
<div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/section_trans.add_department') }}</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="{{route("Sections.store")}}" method="post" autocomplete="off">
     @csrf
     <div class="modal-body">
       <label for="name">{{ trans('Dashboard/section_trans.department_name') }}</label>
       <input type="text" id="name" name="name" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Dashboard/section_trans.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('Dashboard/section_trans.save_changes') }}</button>
      </div>
      </form>
   </div>
 </div>
</div>