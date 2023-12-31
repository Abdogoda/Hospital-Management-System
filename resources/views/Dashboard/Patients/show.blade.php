@extends('Dashboard.layouts.master')
@section('css')

@endsection
@section('title')
    معلومات المريض
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                                    data-toggle="tab">معلومات المريض</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">الفواتير</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">المدفوعات</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab4" class="nav-link" data-toggle="tab">كشف
                                                    حساب</a></li>
                                            <li class="nav-item"><a href="#tab5" class="nav-link" data-toggle="tab">الاشعه</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab6" class="nav-link" data-toggle="tab">المختبر</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{trans('Dashboard/patient_trans.patient_name')}}</th>
                                                        <th>{{trans('Dashboard/patient_trans.email')}}</th>
                                                        <th>{{trans('Dashboard/patient_trans.phone_number')}}</th>
                                                        <th>{{trans('Dashboard/patient_trans.date_of_birth')}}</th>
                                                        <th>{{trans('Dashboard/patient_trans.gender')}}</th>
                                                        <th>{{trans('Dashboard/patient_trans.blood_type')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{$patient->name}}</td>
                                                        <td>{{$patient->email}}</td>
                                                        <td>{{$patient->phone}}</td>
                                                        <td>{{$patient->date_of_birth}}</td>
                                                        <td>{{$patient->gender == 1 ? trans('Dashboard/patient_trans.male') :  trans('Dashboard/patient_trans.female')}}</td>
                                                        <td>{{$patient->blood_type}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Show Information patient --}}



                                        {{-- Start Invices patient --}}

                                        <div class="tab-pane" id="tab2">

                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الخدمه</th>
                                                        <th>تاريخ الفاتوره</th>
                                                        <th>الاجمالي مع الضريبه</th>
                                                        <th>نوع الفاتوره</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($invoices as $invoice)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$invoice->Service->name ?? $invoice->Group->name}}</td>
                                                            <td>{{$invoice->invoice_date}}</td>
                                                            <td>{{$invoice->total_with_tax}}</td>
                                                            <td>{{$invoice->type == 1 ? 'نقدي' : 'اجل'}}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="4" scope="row" class="alert alert-success">
                                                            الاجمالي
                                                        </th>
                                                        <td class="alert alert-primary">{{ number_format( $invoices->sum('total_with_tax') , 2)}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Invices patient --}}



                                        {{-- Start Receipt patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>تاريخ الاضافه</th>
                                                        <th>المبلغ</th>
                                                        <th>البيان</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($receipt_accounts as $receipt_account)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$receipt_account->date}}</td>
                                                            <td>{{$receipt_account->amount}}</td>
                                                            <td>{{$receipt_account->description ? $receipt_account->description : "---"}}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="2" scope="row" class="alert alert-success">الاجمالي
                                                        </th>
                                                        <td colspan="2"
                                                            class="alert alert-primary">{{ number_format( $receipt_accounts->sum('amount') , 2)}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Receipt patient  --}}


                                        {{-- Start payment accounts patient --}}
                                        <div class="tab-pane" id="tab4">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center" id="example1">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>تاريخ الاضافه</th>
                                                        <th>النوع</th>
                                                        <th>الوصف</th>
                                                        <th>مدبن</th>
                                                        <th>دائن</th>
                                                        <th>الرصيد النهائي</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($patient_accounts as $patient_account)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$patient_account->date}}</td>
                                                            @if($patient_account->invoice_id != Null)
                                                                <td>فاتورة</td>
                                                                <td>{{$patient_account->Invoice->Service->name ?? $patient_account->Invoice->Group->name}}</td>
                                                            @elseif($patient_account->receipt_id != Null)
                                                                <td>سند قبض</td>
                                                                <td>{{$patient_account->ReceiptAccount->description ? $patient_account->ReceiptAccount->description : "---"}}</td>
                                                            @elseif($patient_account->payment_id != Null)
                                                                <td>سند صرف</td>
                                                                <td>{{$patient_account->PaymentAccount->description ? $patient_account->PaymentAccount->description : "---"}}</td>
                                                            @endif
                                                            <td>{{ $patient_account->debit}}</td>
                                                            <td>{{ $patient_account->credit}}</td>
                                                            <td></td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="4" scope="row" class="alert alert-success">
                                                            الاجمالي
                                                        </th>
                                                        <td class="alert alert-primary">{{ number_format( $debit = $patient_accounts->sum('debit'), 2) }}</td>
                                                        <td class="alert alert-primary">{{ number_format( $credit = $patient_accounts->sum('credit'), 2) }}</td>
                                                        <td class="alert alert-secondary">
                                                             @if ($credit-$debit > 0)
                                                                 <span class="text-success"> {{$credit - $debit}} دائن</span>
                                                             @elseif($credit-$debit < 0)
                                                                 <span class="text-danger"> {{$credit - $debit}} مدين</span>
                                                             @else    
                                                                 <span class="text-warning"> {{$credit - $debit}}</span>
                                                             @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <br>

                                        </div>

                                        {{-- End payment accounts patient --}}


                                        <div class="tab-pane" id="tab5">
                                            <p>praesentium voluptatum deleniti atque corrquas molestias excepturi sint
                                                occaecati cupiditate non provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <p>praesentium et quas molestias excepturi sint occaecati cupiditate non
                                                provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
@endsection