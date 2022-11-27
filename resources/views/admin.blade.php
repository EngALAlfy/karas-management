@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6  col-xlg-4 mb-3">

                <div class="card border-success text-right">
                <div class="card-header bg-success">
                    <div class="card-title text-white"><h5>الحسابات</h5></div>
                </div>
                <div class="card-body ">
                        <div class="row">
                            <div class="col-6">ارباح اليوم :</div>
                            <div class="col-6">{{ $daily_earnings }} ج.م.</div>
                        </div>
                        <div class="row">
                            <div class="col-6">ارباح الاسبوع :</div>
                            <div class="col-6">{{ $weekly_earnings }} ج.م.</div>
                        </div>
                        <div class="row">
                            <div class="col-6">ارباح الشهر :</div>
                            <div class="col-6" >{{ $monthly_earnings }} ج.م.</div>
                        </div>


                    </div>
                </div>

            </div>


            <div class="col-xs-12 col-md-6 col-xlg-3 mb-3">
                <div class="card border-danger text-right col-12 px-0">
                    <div class="card-header bg-danger">
                        <div class="card-title text-white"><h5 class="h5">المصروفات والايرادات</h5></div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <a id="outgoings" class="col-12 mb-1 btn btn-info">المصروفات</a>
                            <a id="incomings" class="col-12 btn btn-warning">الايرادات</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-xlg-3 mb-3">
                <div class="card border-primary text-right">
                <div class="card-header bg-primary">
                    <div class="card-title text-white"><h5>المقاولين</h5></div>
                </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <a id="add-mekawel" class="col-12 mb-1 btn btn-success">اضف مقاول</a>
                            <a id="mekawels" class="col-12 btn btn-danger">قائمة المقاولين</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xs-12 col-md-6 col-xlg-3 mb-3">
                <div class="card border-info text-right">
                <div class="card-header bg-info">
                    <div class="card-title text-white"><h5>التوكيلات</h5></div>
                </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <a id="add-tawkeel" class="col-12 mb-1 btn btn-success">اضف توكيل</a>
                            <a id="tawkeels" class="col-12 btn btn-danger">قائمة التوكيلات</a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xs-12 col-md-6 col-xlg-3 mb-3">
                <div class="card border-warning text-right col-12 mb-1 px-0">
                    <div class="card-header bg-warning">
                        <div class="card-title text-white"><h5 class="h5">سجلات الطباعة</h5></div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <a id="records" class="col-12 btn btn-info">قائمة السجلات</a>
                        </div>
                    </div>
                </div>



            </div>


            <div class="col-xs-12 col-md-6 col-xlg-3 mb-3">
                <div class="card border-primary text-right col-12 mb-1 px-0">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white"><h5 class="h5">سجلات الصادرات والواردات</h5></div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <a id="incoming_records" class="col-12 btn btn-success">قائمة الواردات</a>
                            <a id="outgoing_records" class="col-12 btn btn-warning">قائمة الصادرات</a>
                        </div>
                    </div>
                </div>



            </div>



        </div>
    </div>

    <script>



        function mekawelTawkeels(id , name){
            $.get("{{ url("/")  }}" + "/admin/mekawels/"+id+"/tawkeels/get", function (result) {

                var html = '<table class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >التوكيل</th>' +
                            ' <th >سعر 20</th>' +
                            ' <th >سعر 40</th>' +
                            ' <th >سعر المقاول 20</th>' +
                            ' <th >سعر المقاول 40</th>' +
                            '<th >حذف</th> ' +
                            '</tr></thead>' +
                            '<tbody>';

                        for(var item of result.data){
                            html += '<tr>' +
                                '<td>'+item.name+'</td>' +
                                '<td>'+item.price_20+'</td>' +
                                '<td>'+item.price_40+'</td>' +
                                '<td>'+item.pivot.mekawel_price_20+'</td>' +
                                '<td>'+item.pivot.mekawel_price_40+'</td>' +
                                '<td><a href="/admin/tawkeels/'+item.id+'/delete" target="_blank" class="btn btn-danger">حذف</a></td>' +
                                '</tr>';
                        }

                        html +=
                            '</tbody>' +
                            '</table>';

                        showTableDialog("توكيلات المقاول : " + name , html);

            });
        }


        function addMekawelTawkeel(id , name) {

            $.get("{{ url("/")  }}" + "/admin/tawkeels", function (result) {
                if (result != null && result.success === true) {

                    var html = '<div class="form-group text-right">' +
                    '<label for="tawkeel_id">التوكيل</label>' +
                    '<select  class="custom-select" id="tawkeel_id">';


                    for(var item of result.data){
                            html += '<option id="'+item.id+'">'+item.name+'</option>';
                    }


                    var htmlEnd = '</select>' +
                    '</div>' +
                    '<div class="form-group text-right">' +
                    '<label for="mekawel_price_20">سعر 20</label>' +
                    '<input type="number" class="form-control" id="mekawel_price_20"' +
                    '      required placeholder="سعر 20" autocomplete="true">' +
                    '</div>'+
                    '<div class="form-group text-right">' +
                    '<label for="mekawel_price_40">سعر 40</label>' +
                    '<input type="number" class="form-control" id="mekawel_price_40"' +
                    '      required placeholder="سعر 40" autocomplete="true">' +
                    '</div>';

                    html += htmlEnd;

                    return Swal.fire({
                title: "اضف توكيل للمقاول : " + name,
                html: html,
                confirmButtonText: 'حفظ',
                confirmButtonColor: 'green',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    postData( '/admin/mekawels/'+id+'/tawkeels/store' ,
                     {'tawkeel_id': $('#tawkeel_id option:selected').attr('id'),'mekawel_price_40': $('#mekawel_price_40').val(),'mekawel_price_20': $('#mekawel_price_20').val()}
                     /*, function(result){console.log(result);}*/);
                }
            });


                } else {
                    if (result.errors) {
                        toastError(JSON.stringify(result.errors).replaceAll("\"" , "").replaceAll("[" , "").replaceAll("]" , "").replaceAll("{" , "").replaceAll("}" , ""));
                    } else {
                        toastError();
                    }
                }
            });

        }

        function addTawkeel() {
            return Swal.fire({
                title: "اضف توكيل جديد",
                html: '<div class="form-group text-right">' +
                    '<label for="name">الاسم</label>' +
                    '<input type="text" class="form-control" id="name"' +
                    '      required placeholder="ادخل الاسم" autocomplete="true">' +
                    '</div>' +
                    '<div class="form-group text-right">' +
                    '<label for="price_20">سعر 20</label>' +
                    '<input type="number" class="form-control" id="price_20"' +
                    '      required placeholder="price_20" autocomplete="true">' +
                    '</div>'+
                    '<div class="form-group text-right">' +
                    '<label for="price_40">سعر 40</label>' +
                    '<input type="number" class="form-control" id="price_40"' +
                    '      required placeholder="price_40" autocomplete="true">' +
                    '</div>',
                confirmButtonText: 'حفظ',
                confirmButtonColor: 'green',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    postData( '/admin/tawkeels/store' , {'name': $('#name').val(),'price_40': $('#price_40').val(),'price_20': $('#price_20').val()});
                }
            });
        }

        function addMekawel() {
            return Swal.fire({
                title: "اضف مقاول جديد",
                html: '<div class="form-group text-right">' +
                    '<label for="name">الاسم</label>' +
                    '<input type="text" class="form-control" id="name"' +
                    '      required placeholder="ادخل الاسم" autocomplete="true">' +
                    '</div>'+
                    '<div class="form-group text-right">' +
                    '<label for="phone">الهاتف</label>' +
                    '<input type="text" class="form-control" id="phone"' +
                    '      required placeholder="ادخل رقم الهاتف" autocomplete="true">' +
                    '</div>',
                confirmButtonText: 'حفظ',
                confirmButtonColor: 'green',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    postData( '/admin/mekawels/store' , {'name': $('#name').val() , 'phone': $('#phone').val()});
                }
            });
        }

        function showTableDialog(title , html) {
            return Swal.fire({
                title: title,
                html: html,
                width:700,
                confirmButtonText: 'اغلاق'
            });
        }

        function showIncomingRecords(id){


            $.get("{{ url("/") }}" + "/admin/incoming-records/"+id+"/get" , function (result) {
            if(result && result.success === true){

            var html = '<table class="table table-bordered table-striped" > ' +
            '<thead> ' +
            '<tr> ' +
            ' <th >اسم المندوب</th>' +
            ' <th >المدفوع</th>' +
            ' <th >المتبقي</th>' +
            ' <th >التاريخ</th>' +
            '</tr></thead>' +
            '<tbody>';

        var paidSum = 0;
        var unpaidSum = 0;


        for(var item of result.data){
            html += '<tr>' +
                '<td>'+item.name+'</td>' +
                '<td>'+item.paid+'</td>' +
                '<td>'+item.unpaid+'</td>' +
                '<td>'+item.date+'</td>' +
                '</tr>';

                paidSum += item.paid;
                unpaidSum += item.unpaid;
                }

                    html +=
                    '</tbody>' +
                    '</table>';

                    html += '<div class="card-footer row px-0 mx-0">'+
                    '<div class="col-6">مجموع المدفوع : </div>'+
                    '<div class="col-6">'+paidSum+'</div>'+
                    '<div class="col-6">مجموع المتبقي : </div>'+
                    '<div class="col-6">'+unpaidSum+'</div>'+
                    //'<div class="col-12"><a target="_blank" href="/admin/incomings/delete" class="btn btn-danger">حذف</a></div>'+
                    '</div>';

                    showTableDialog("سجلات الايرادات المحفوظة" , html);
                }else{
                    toastError();
                }
            });
        }


        function showOutgoingRecords(id){
            $.get("{{ url("/") }}" + "/admin/outgoing-records/"+id+"/get" , function (result) {
                    if(result && result.success === true){

                        var html = '<table class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >نوع المصروف</th>' +
                            ' <th >السعر</th>' +
                            ' <th >التاريخ</th>' +

                            '</tr></thead>' +
                            '<tbody>';

                        var sum = 0;

                        for(var item of result.data){
                            html += '<tr>' +
                                '<td>'+item.type+'</td>' +
                                '<td>'+item.price+'</td>' +
                                '<td>'+item.date+'</td>' +
                                '</tr>';

                                sum += item.price;
                        }

                        html +=
                            '</tbody>' +
                            '</table>';



                        html += '<div class="card-footer row px-0 mx-0">'+
                        '<div class="col-6">المجموع : </div>'+
                        '<div class="col-6">'+sum+'</div>'+
                        //'<div class="col-12"><a target="_blank" href="/admin/outgoings/delete" class="btn btn-danger">حذف</a></div>'+
                        '</div>';

                        showTableDialog("سجلات المصروفات المحفوظة" , html);
                    }else{
                        toastError();
                    }
                });
        }


        $(function () {


            $('#add-tawkeel').click(function () {
                addTawkeel();
            });

            $('#add-mekawel').click(function () {
                addMekawel();
            });

            $('#mekawels').click(function () {
                $.get("{{ url("/") }}" + "/admin/mekawels" , function (result) {
                    if(result && result.success === true){

                        var html = '<table class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >اسم المقاول</th>' +
                            ' <th >رقم الهاتف</th>' +
                            ' <th >التوكيلات</th> ' +
                            ' <th >اضف توكيل</th>' +
                            '<th >حذف</th> ' +
                            '</tr></thead>' +
                            '<tbody>';

                        for(var item of result.data){
                            var htmlEnd = '<tr>' +
                                '<td>'+item.name+'</td>' +
                                '<td>'+item.phone+'</td>' +
                                '<td><button onclick="mekawelTawkeels(\''+item.id+'\' , \''+item.name+'\')" class="btn btn-primary">قائمة التوكيلات</button></td>' +
                                '<td><button  onclick="addMekawelTawkeel(\''+item.id+'\' , \''+item.name+'\')" class="btn btn-success">اضافه توكيل</button></td>' +
                                '<td><a  href="/admin/mekawels/'+item.id+'/delete"  class="btn btn-danger">حذف</a></td>' +
                                '</tr>';
                            html += htmlEnd;
                        }

                        html +=
                            '</tbody></table>';

                        showTableDialog('المقاولين' , html);
                    }else{
                        toastError();
                    }
                });
            });


            $('#tawkeels').click(function () {
                $.get("{{ url("/") }}" + "/admin/tawkeels" , function (result) {
                    if(result && result.success === true){

                        var html = '<table class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >الاسم</th>' +
                            ' <th >سعر 20</th>' +
                            ' <th >سعر 40</th>' +
                            '<th >حذف</th> ' +
                            '</tr></thead>' +
                            '<tbody>';

                        for(var item of result.data){
                            html += '<tr>' +
                                '<td>'+item.name+'</td>' +
                                '<td>'+item.price_20+'</td>' +
                                '<td>'+item.price_40+'</td>' +
                                '<td><a href="/admin/tawkeels/'+item.id+'/delete" target="_blank" class="btn btn-danger">حذف</a></td>' +
                                '</tr>';
                        }

                        html +=
                            '</tbody>' +
                            '</table>';

                        showTableDialog("التوكيلات" , html);
                    }else{
                        toastError();
                    }
                });
            });

            $('#records').click(function () {
                $.get("{{ url("/") }}" + "/admin/print-dates" , function (result) {
                    if(result && result.success === true){

                        var html = '<table class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >التاريخ</th>' +
                            ' <th >عرض</th>' +
                           // '<th >حذف</th> ' +
                            '</tr></thead>' +
                            '<tbody>';

                        for(var item of result.data){
                            html += '<tr>' +
                                '<td>'+item.date+'</td>' +
                                '<td><a href="/admin/print-records/'+item.id+'/get" target="_blank" class="btn btn-success">عرض</a></td>' +
                                //'<td><a href="/admin/print-records/'+item.id+'/delete" target="_blank" class="btn btn-danger">حذف</a></td>' +
                                '</tr>';
                        }

                        html +=
                            '</tbody>' +
                            '</table>';

                        showTableDialog("سجلات الطباعه" , html);
                    }else{
                        toastError();
                    }
                });
            });


            $('#outgoings').click(function () {
                $.get("{{ url("/") }}" + "/admin/outgoings" , function (result) {
                    if(result && result.success === true){

                        var html = '<table id="table" dir="rtl" data-toggle="table" data-show-print="true" data-search="true" class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th data-field="type" >نوع المصروف</th>' +
                            ' <th data-field="price" >السعر</th>' +
                            ' <th  data-field="date">التاريخ</th>' +

                            '</tr></thead>' +
                            '<tbody>';

                        var sum = 0;

                        for(var item of result.data){
                            html += '<tr>' +
                                '<td data-value="'+item.type+'">'+item.type+'</td>' +
                                '<td data-value="'+item.price+'" >'+item.price+'</td>' +
                                '<td data-value="'+item.date+'">'+item.date+'</td>' +
                                '</tr>';

                                sum += item.price;
                        }

                        html +=
                            '</tbody>' +
                            '</table>';



                        html += '<div class="card-footer row px-0 mx-0">'+
                        '<div class="col-6">المجموع : </div>'+
                        '<div class="col-6">'+sum+'</div>'+
                        '<div class="col-12"><a target="_blank" href="/admin/outgoings/delete" class="btn btn-danger">حذف</a></div>'+
                        '</div>';

                        showTableDialog("المصروفات" , html);

                        $('#table').bootstrapTable({
                            printPageBuilder: function (t) {
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
                    '    <title>المصروفات</title>' +
                    '' +
                    '</head>' +
                    '<body>' +
                    '<center><h3>المصروفات<h3></center>'+
                    '<div class="bs-table-print">' +
                    '' +
                    t+
                    '</div>' +
                    '' +
                    '</body>' +
                    '' +
                    '</html>';
                            }
                        });
                    }else{
                        toastError();
                    }
                });
            });

            $('#incomings').click(function () {
                $.get("{{ url("/") }}" + "/admin/incomings" , function (result) {
                    if(result && result.success === true){

                        var html = '<table id="table" data-show-print="true" class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >اسم المندوب</th>' +
                            ' <th >المدفوع</th>' +
                            ' <th >المتبقي</th>' +
                            ' <th >التاريخ</th>' +
                            '</tr></thead>' +
                            '<tbody>';

                        var paidSum = 0;
                        var unpaidSum = 0;


                        for(var item of result.data){
                            html += '<tr>' +
                                '<td>'+item.name+'</td>' +
                                '<td>'+item.paid+'</td>' +
                                '<td>'+item.unpaid+'</td>' +
                                '<td>'+item.date+'</td>' +
                                '</tr>';

                                paidSum += item.paid;
                                unpaidSum += item.unpaid;
                        }

                        html +=
                            '</tbody>' +
                            '</table>';

                        html += '<div class="card-footer row px-0 mx-0">'+
                        '<div class="col-6">مجموع المدفوع : </div>'+
                        '<div class="col-6">'+paidSum+'</div>'+
                        '<div class="col-6">مجموع المتبقي : </div>'+
                        '<div class="col-6">'+unpaidSum+'</div>'+
                        '<div class="col-12"><a target="_blank" href="/admin/incomings/delete" class="btn btn-danger">حذف</a></div>'+
                        '</div>';

                        showTableDialog("الايرادات" , html);

                        $('#table').bootstrapTable({
                            printPageBuilder: function (t) {
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
                    '    <title>الايرادات</title>' +
                    '' +
                    '</head>' +
                    '<body>' +
                    '<center><h3>الايرادات<h3></center>'+
                    '<div class="bs-table-print">' +
                    '' +
                    t+
                    '</div>' +
                    '' +
                    '</body>' +
                    '' +
                    '</html>';
                            }
                        });
                    }else{
                        toastError();
                    }
                });
            });


            $('#outgoing_records').click(function () {
                $.get("{{ url("/") }}" + "/admin/outgoing-dates" , function (result) {
                    if(result && result.success === true){

                        var html = '<table data-show-print="true" id="table" class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >التاريخ</th>' +
                            ' <th >عرض</th>' +
                            //'<th >حذف</th> ' +
                            '</tr></thead>' +
                            '<tbody>';

                        for(var item of result.data){
                            html += '<tr>' +
                                '<td>'+item.date+'</td>' +
                                '<td><a onclick="showOutgoingRecords(\''+item.id+'\')" target="_blank" class="btn btn-success">عرض</a></td>' +
                                //'<td><a href="/admin/outgoing-records/'+item.id+'/delete" target="_blank" class="btn btn-danger">حذف</a></td>' +
                                '</tr>';
                        }

                        html +=
                            '</tbody>' +
                            '</table>';

                        showTableDialog("سجلات الصادرات" , html);

                        $('#table').bootstrapTable({
                            printPageBuilder: function (t) {
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
                    '    <title>سجل لصادرات</title>' +
                    '' +
                    '</head>' +
                    '<body>' +
                    '<center><h3>سجل الصادرات<h3></center>'+
                    '<div class="bs-table-print">' +
                    '' +
                    t+
                    '</div>' +
                    '' +
                    '</body>' +
                    '' +
                    '</html>';
                            }
                        });
                    }else{
                        toastError();
                    }
                });
            });

            $('#incoming_records').click(function () {
                $.get("{{ url("/") }}" + "/admin/incoming-dates" , function (result) {
                    if(result && result.success === true){

                        var html = '<table data-show-print="true" id="table" class="table table-bordered table-striped" > ' +
                            '<thead> ' +
                            '<tr> ' +
                            ' <th >التاريخ</th>' +
                            ' <th >عرض</th>' +
                            //'<th >حذف</th> ' +
                            '</tr></thead>' +
                            '<tbody>';

                        for(var item of result.data){
                            html += '<tr>' +
                                '<td>'+item.date+'</td>' +
                                '<td><a onclick="showIncomingRecords(\''+item.id+'\')" target="_blank" class="btn btn-success">عرض</a></td>' +
                               // '<td><a href="/admin/incoming-records/'+item.id+'/delete" target="_blank" class="btn btn-danger">حذف</a></td>' +
                                '</tr>';
                        }

                        html +=
                            '</tbody>' +
                            '</table>';

                        showTableDialog("سجلات الواردات" , html);

                        $('#table').bootstrapTable({
                            printPageBuilder: function (t) {
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
                    '    <title>سجل الايرادات</title>' +
                    '' +
                    '</head>' +
                    '<body>' +
                    '<center><h3>سجل الايرادات<h3></center>'+
                    '<div class="bs-table-print">' +
                    '' +
                    t+
                    '</div>' +
                    '' +
                    '</body>' +
                    '' +
                    '</html>';
                            }
                        });
                    }else{
                        toastError();
                    }
                });
            });




        });

    </script>



@endsection
