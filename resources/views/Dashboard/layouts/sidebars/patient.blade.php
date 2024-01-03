<ul class="side-menu">
 <li class="side-item side-item-category">{{ trans('Dashboard/main_sidebar_trans.HMS') }}</li>
 <li class="slide">
  <a class="side-menu__item" href="/patient/dashboard"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">{{ trans('Dashboard/main_sidebar_trans.main') }}</span></a>
 </li>
 <li class="slide">
  <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">{{ trans('Dashboard/main_sidebar_trans.p_operations') }}</span><i class="angle fe fe-chevron-down"></i></a>
  <ul class="slide-menu">
   <li><a class="slide-item" href="{{ route('PatientInvoices.index') }}">{{ trans('Dashboard/main_sidebar_trans.invoices_list') }}</a></li>
   <li><a class="slide-item" href="{{ route('RayPatientInvoices') }}">{{ trans('Dashboard/main_sidebar_trans.x_ray') }}</a></li>
   <li><a class="slide-item" href="{{ route('PatientInvoicesPayments') }}">{{ trans('Dashboard/main_sidebar_trans.payments') }}</a></li>
   <li><a class="slide-item" href="{{ route('PatientInvoicesReceipts') }}">{{ trans('Dashboard/main_sidebar_trans.receipts') }}</a></li>
  </ul>
 </li>
 <li class="slide">
  <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">{{ trans('Dashboard/main_sidebar_trans.conversations') }}</span><i class="angle fe fe-chevron-down"></i></a>
  <ul class="slide-menu">
   <li><a class="slide-item" href="{{ route('DoctorsList') }}">{{ trans('Dashboard/main_sidebar_trans.doctors_list') }}</a></li>
   <li><a class="slide-item" href="{{ route('LateastMessages') }}">{{ trans('Dashboard/main_sidebar_trans.lateast_conversations') }}</a></li>
  </ul>
 </li>
</ul>