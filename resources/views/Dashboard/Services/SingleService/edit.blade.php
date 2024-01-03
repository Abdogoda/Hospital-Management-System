<!-- Modal -->
<div class="modal fade" id="edit{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/service_trans.edit_service') }}</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="{{route("Services.update", 'test')}}" method="post" autocomplete="off">
      @method('put')
     @csrf
     <div class="modal-body">
      <input type="hidden" name="id" value="{{$service->id}}">
      <div class="form-group">
       <label for="name">{{ trans('Dashboard/service_trans.service_name') }}</label>
       <input type="text" id="name" value="{{$service->name}}" name="name" class="form-control" required>
      </div>
       <div class="form-group">
        <label for="price">{{ trans('Dashboard/service_trans.service_price') }}</label>
       <input type="text" id="price" inputmode="numeric" value="{{$service->price}}" name="price" class="form-control">
       </div>
       <div class="form-group">
        <label for="description">{{ trans('Dashboard/service_trans.service_description') }}</label>
       <textarea id="description" name="description" class="form-control" style="min-height: 150px">{{$service->description}}</textarea>
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