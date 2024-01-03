<!-- Modal -->
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/service_trans.add_service') }}</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="{{route("Services.store")}}" method="post" autocomplete="off">
     @csrf
     <div class="modal-body">
       <div class="form-group">
        <label for="name">{{ trans('Dashboard/service_trans.service_name') }}</label>
       <input type="text" id="name" name="name" class="form-control"value="{{old('name')}}">
       </div>
       <div class="form-group">
        <label for="price">{{ trans('Dashboard/service_trans.service_price') }}</label>
       <input type="text" id="price" inputmode="numeric" name="price" class="form-control"value="{{old('price')}}">
       </div>
       <div class="form-group">
        <label for="description">{{ trans('Dashboard/service_trans.service_description') }}</label>
       <textarea id="description" name="description" class="form-control" style="min-height: 150px">{{old('description')}}</textarea>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Dashboard/service_trans.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('Dashboard/service_trans.save_changes') }}</button>
      </div>
      </form>
   </div>
 </div>
</div>