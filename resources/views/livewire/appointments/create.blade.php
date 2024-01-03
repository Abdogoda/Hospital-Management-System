<div>
    @if ($message == true)
        <script>
            alert('تم ارسال الحجز الي ادارة المستشفي');
            window.location.reload();
        </script>
    @endif
    <form wire:submit.prevent="store" method="post" action="appointment.html">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="username">اسمك</label>
                    <input type="text" wire:model="name" class="form-control py-2" name="username" id="username" required="">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                <label for="email">البريد الالكتروني</label>
                    <input type="email" wire:model="email" class="form-control py-2" name="email" id="email" required="">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12"> 
                <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                    <input type="tel" wire:model="phone" class="form-control py-2" name="phone" id="phone" required="">
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                <label for="section">القسم</label>
                    <select name="section" wire:model="section" id="section" class="form-control py-2" required>
                        <option selected disabled value="">___اختار القسم___</option>
                        @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="doctor">الطبيب</label>
                    <select name="doctor" wire:model="doctor" id="doctor" class="form-control py-2" required>  
                        <option selected disabled value="">___اختار الطبيب___</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <textarea name="notes" wire:model="notes" class="form-control py-2" id="notes"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                    <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                        <span class="txt">تاكيد</span></button>
                </div>
            </div>
        </div>
    </form>
</div>
