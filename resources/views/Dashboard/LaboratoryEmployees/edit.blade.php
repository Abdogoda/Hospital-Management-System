<!-- Modal -->
<div class="modal fade" id="edit{{ $laboratory_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات موظف</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <form action="{{ route('LaboratoryEmployees.update', $laboratory_employee->id) }}" method="post">
             {{ method_field('patch') }}
             {{ csrf_field() }}
             @csrf
             <div class="modal-body">
                 <label for="exampleInputPassword1">الاسم</label>
                 <input type="text" value="{{$laboratory_employee->name}}" name="name" class="form-control"><br>

                 <label for="exampleInputPassword1">البريد الالكتروني</label>
                 <input type="email" value="{{$laboratory_employee->email}}" name="email" class="form-control"><br>

                 <label for="exampleInputPassword1">كلمة المرور</label>
                 <input type="password" name="password" class="form-control" autocomplete="new-password">
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                 <button type="submit" class="btn btn-primary">تعديل الموظف</button>
             </div>
         </form>
     </div>
 </div>
</div>