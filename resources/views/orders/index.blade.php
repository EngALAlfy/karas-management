@extends('layouts.system')

@section('content')

    <div class="text-right" dir="rtl" id="toolbar">
        <form class="form form-inline" action="/home/search" method="post" enctype="multipart/form-data">
            @csrf
                <label for="from">من : </label>
                <input type="date" name="from" id="from" class="form-control mx-1">
                <label for="to">الي : </label>
                <input type="date" name="to" id="to" class="form-control mx-1">
                <input class="form-control mx-1" autocomplete="true" type="text" name="mekawel_name" placeholder="ادخل اسم المقاول" id="search">

                <button class="btn btn-primary" type="submit">بحث</button>
            </form>
    </div>
    <table id="table" data-toggle="table" data-show-columns="true"
           data-search="true"
           data-toolbar="#toolbar"
           data-show-print="true"
           dir="rtl"
           @isset($search)
            data-mekawel_name="{{$mekawel_name}}"
            data-to="{{$to}}"
            data-from="{{$from}}"
           @endisset
           class="table table-striped text-right"
           data-buttons-align="left"
           data-search-align="left"
           data-show-fullscreen="true"
           data-toolbar-align="right"
           data-show-filter-control-switch="true"
           data-filter-control="true"
           data-filter-control-visible="false"
           data-show-columns-toggle-all="true" data-data="{{ isset($search) ? $orders :  json_encode($orders->items())}}" >
        <thead>
        <tr>
            <th rowspan="2" data-valign="middle" data-field="id" data-visible="false" data-sortable="true">ID</th>
            <th rowspan="2" data-valign="middle" data-field="number" data-filter-control="input" data-sortable="true">رقم الجواب</th>
            <th rowspan="2" data-valign="middle" data-field="date" data-filter-control="datepicker" data-sortable="true">التاريخ</th>
            <th rowspan="2" data-valign="middle" data-field="tawkeel" data-filter-control="select" data-formatter="tawkeelFormat"  data-sortable="true">التوكيل</th>
            <th rowspan="2" data-valign="middle" data-field="name" data-filter-control="input" data-sortable="true">اسم العميل</th>
            <th rowspan="2" data-valign="middle" data-field="s_w" data-formatter="sWFormat" data-sortable="true">ص/و</th>
            <th rowspan="2" data-valign="middle" data-field="mekawel" data-filter-control="select" data-formatter="mekawelFormat" data-sortable="true">المقاول</th>
            <th colspan="2" data-valign="middle" data-align="center">عدد الحاويات</th>
            <th rowspan="2" data-valign="middle" data-field="sum"   data-formatter="sumFormat" data-sortable="true">الحساب</th>
            <th rowspan="2" data-valign="middle" data-field="h_t" data-sortable="true">ح.ت</th>
            <th rowspan="2" data-valign="middle" data-field="grant" data-sortable="true">ضمان</th>
        </tr>

        <tr>
            <th data-field="count_20" data-align="center" data-sortable="true">20</th>
            <th data-field="count_40" data-align="center" data-sortable="true">40</th>
        </tr>

        </thead>
        <tbody>
        </tbody>
    </table>
    <table style="border: 1px solid #dee2e6" class="table">
        <tbody>
        <tr>
            <td style="text-align: center;border: 1px solid #dee2e6; ">المجموع</td>
            <td id="allSum" style="text-align: center;border: 1px solid #dee2e6; "> - </td>
        </tr>

        </tbody>
    </table>

    @if(!isset($search))

        <div class="card-footer">
            {{ $orders->links() }}
        </div>
    @endif

    <script>


        $(function() {
            $('#table').bootstrapTable({

                printPageBuilder: function (t) {

                    @if (isset($search))
                        return '<!DOCTYPE html><html dir="rtl" lang="ar">' +
                        '<head>' +
                        '' +
                        '    <style type="text/css" media="print">' +
                        '' +
                        '        @page {' +
                        '            size: auto;' +
                        '            margin: 25px 0 25px 0;' +
                        '        }' +
                        '    </style>' +
                        '' +
                        '    <style type="text/css" media="all">' +
                        '' +
                        '        table {' +
                        '            border-collapse: collapse;' +
                        '            font-size: 12px;' +
                        '        }' +
                        '' +
                        '' +
                        '        table, th, td {' +
                        '            border: 1px solid grey;' +
                        '        }' +
                        '' +
                        '        th, td {' +
                        '            text-align: center;' +
                        '            vertical-align: middle;' +
                        '        }' +
                        '' +
                        '        p {' +
                        '            font-weight: bold;' +
                        '            margin-left: 20px;' +
                        '        }' +
                        '' +
                        '        table {' +
                        '            width: 94%;' +
                        '            margin-left: 3%;' +
                        '            margin-right: 3%;' +
                        '        }' +
                        '' +
                        '        div.bs-table-print {' +
                        '            text-align: center;' +
                        '        }' +
                        '    </style>' +
                        '' +
                        '    <title>الاوردارات</title>' +
                        '' +
                        '</head>' +
                        '<body>' +
                        '<center><h3>' + this.options.mekawel_name + '<h3></center>' +
                        '<center><h4>من تاريخ ' + this.options.from + ' الي تاريخ ' + this.options.to + '<h4></center>' +
                        '<div class="bs-table-print">' +
                        '' +
                        t +
                        '<table style="" class="table">' +
                        '<tbody>' +
                        '<tr>' +
                        '<td style="text-align: center; ">المجموع</td>' +
                        '<td style="text-align: center;" > '+allSum()+'</td>' +
                        '</tr>' +
                        '</div>' +
                        '' +
                        '</body>' +
                        '' +
                        '</html>';

            @else
                return '<!DOCTYPE html><html dir="rtl" lang="ar">' +
                '<head>' +
                '    <style type="text/css" media="print">' +
                '' +
                '        @page {' +
                '            size: auto;' +
                '            margin: 25px 0 25px 0;' +
                '        }' +
                '    </style>' +
                '' +
                '    <style type="text/css" media="all">' +
                '' +
                '        table {' +
                '            border-collapse: collapse;' +
                '            font-size: 12px;' +
                '        }' +
                '' +
                '' +
                '        table, th, td {' +
                '            border: 1px solid grey;' +
                '        }' +
                '' +
                '        th, td {' +
                '            text-align: center;' +
                '            vertical-align: middle;' +
                '        }' +
                '' +
                '        p {' +
                '            font-weight: bold;' +
                '            margin-left: 20px;' +
                '        }' +
                '' +
                '        table {' +
                '            width: 94%;' +
                '            margin-left: 3%;' +
                '            margin-right: 3%;' +
                '        }' +
                '' +
                '        div.bs-table-print {' +
                '            text-align: center;' +
                '        }' +
                '    </style>' +
                '' +
                '    <title>الاوردارات</title>' +
                '' +
                '</head>' +
                '<body>' +
                '<center><h3>الاوردرات<h3></center>' +
                '<div class="bs-table-print">' +
                '' +
                t +
                '<table style="" class="table">' +
                '<tbody>' +
                '<tr>' +
                '<td style="text-align: center; ">المجموع</td>' +
                '<td style="text-align: center;" > '+allSum()+'</td>' +
                '</tr>' +

                '</tbody>' +
                '</table>' +
                '</div>' +
                '' +
                '</body>' +
                '' +
                '</html>';
            @endif

                }
            });

            allSum();
        });

        function savePrints(){
            var unFormattedData  = $('#table').bootstrapTable('getData');
            var data = [];

            for(var index in unFormattedData){
                var row = unFormattedData[index];

                data.push({
                    sum: 5,
                    count_20: row.count_20,
                    count_40: row.count_40 ,
                    date: row.date ,
                    grant: row.grant ,
                    h_t: row.h_t ,
                    mekawel:row.mekawel.name ,
                    name: row.name,
                    number: row.number ,
                    s_w: row.s_w ,
                    tawkeel:row.tawkeel.name,
                });
            }

            postData( '/admin/print-records/store' , {'rows':data} ,  function(result){console.log(result);});
        }

    function sWFormat(value){
            if(value == "s")
                return "ص";
            else if(value == "w")
                return "و"
            else
                return value;
        }

        function tawkeelFormat(value){
            return value.name;
        }

        function mekawelFormat(value){
            return value.name;
        }

        function sumFormat(value , row){
            var sum = 0;
            row.mekawel.tawkeels.forEach(element => {
               if(element.id == row.tawkeel.id){
                   sum = element.pivot.mekawel_price_20 * row.count_20 + element.pivot.mekawel_price_40 * row.count_40
               }
            });
            return sum;
        }

        function allSum(){
            var all = 0;

            $('#table').bootstrapTable('getData').forEach(row => {
                var sum = 0;
                row.mekawel.tawkeels.forEach(element => {
                    if(element.id == row.tawkeel.id){
                        sum = element.pivot.mekawel_price_20 * row.count_20 + element.pivot.mekawel_price_40 * row.count_40
                    }
                });

                all += sum;
            });

            $('#allSum').html(all);

            return all;
        }
    </script>

@endsection
