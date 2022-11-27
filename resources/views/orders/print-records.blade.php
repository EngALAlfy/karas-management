@extends('layouts.admin')

@section('content')

    <table id="table"
           data-toggle="table"
           data-show-columns="true"
           data-search="true"
           data-show-print="true"
           dir="rtl"
           class="table table-striped text-right"
           data-buttons-align="left"
           data-search-align="left"
           data-show-fullscreen="true"
           data-toolbar-align="right"
           data-show-filter-control-switch="true"
           data-filter-control="true"
           data-filter-control-visible="false"
           data-show-columns-toggle-all="true" data-data="{{$records}}" >
        <thead>
        <tr>
            <th rowspan="2" data-valign="middle" data-field="id" data-visible="false" data-sortable="true">ID</th>
            <th rowspan="2" data-valign="middle"  data-field="number" data-filter-control="input" data-sortable="true">رقم الجواب</th>
            <th rowspan="2"  data-valign="middle" data-field="date" data-filter-control="datepicker" data-sortable="true">التاريخ</th>
            <th rowspan="2" data-valign="middle" data-field="tawkeel" data-filter-control="select"  data-sortable="true">التوكيل</th>
            <th rowspan="2" data-valign="middle" data-field="name" data-filter-control="input" data-sortable="true">اسم العميل</th>
            <th rowspan="2" data-valign="middle" data-field="s_w"  data-sortable="true">ص/و</th>
            <th rowspan="2" data-valign="middle" data-field="mekawel" data-filter-control="select" data-sortable="true">المقاول</th>
            <th colspan="2" data-valign="middle" data-align="center">عدد الحاويات</th>
            <th rowspan="2" data-valign="middle" data-field="sum" data-sortable="true">الحساب</th>
            <th rowspan="2" data-valign="middle" data-field="h_t" data-sortable="true">ح.ت</th>
            <th rowspan="2" data-valign="middle" data-field="grant" data-sortable="true">ضمان</th>
        </tr>

        <tr>
            <th data-field="count_20" data-align="center" data-sortable="true">20</th>
            <th data-field="count_40" data-align="center" data-sortable="true">40</th>
        </tr>

        </thead>
        <tbody></tbody>
    </table>


@endsection
