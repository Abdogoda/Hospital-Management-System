<!-- Modal -->
<div class="modal fade" id="delete{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">حذف سند قبض</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <form action="{{ route('Payments.destroy',$payment->id ) }}" method="post">
             {{ method_field('delete') }}
             {{ csrf_field() }}
         <div class="modal-body">
             <input type="hidden" name="id" value="{{ $payment->id }}">
             <h5>Are You Sure You Want To Delete This payment <span style="color: red"> {{ $payment->patients->name }}</span></h5>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn btn-danger">Delete</button>
         </div>
         </form>
     </div>
 </div>
</div>