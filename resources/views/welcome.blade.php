<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>


<body>

    <div class="container">
        <h2 style="margin-top: 12px;" class="alert alert-success">Abhijit s Jagtap - Practical

        </h2><br>
        <div class="card">
            <div class="card-header">
                <div class="row">

                    <div class="col-sm-12">

                        <input type="number" value="" class="form-control" id="rowid" placeholder="Enter Row Number" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="number" value="" class="form-control" id="columnid" placeholder="Enter Column Number" required>
                    </div>

                    <div class="col-sm-12"></br>
                        <div class="text-right">
                            <button onclick="saveData()" class="btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <table id="laravel_crud" class="table  table-borderless">
                        <?php
                        $row_count = $data['rows'];
                        $col_count = $data['col'];
                        if (!empty($data['id'])) {
                            $id = $data['id'];
                        }
                        ?>
                        <tbody>

                            @for ($i = 0; $i < $row_count; $i++) <tr>
                                @for ($j=0; $j <$col_count ; $j++) <td class="text-center"><button onclick="getItemmodal('{{$i}}','{{$j}}')" class="btn btn-info">

                                        @if(!empty($data['item_details']))
                                        @foreach($data['item_details'] as $key=>$val)

                                        @foreach($val['item'] as $k=>$v)
                                        @if($val['rowid']==$i && $val['rowid']==$i && $v['col'] == $j)
                                        <span>{{$v['item_name']}}</span>
                                        @endif
                                        @endforeach

                                        @endforeach
                                        <span>+</span>
                                        @else
                                        <span>+</span>
                                        @endif



                                    </button></td>
                                    @endfor </tr> @endfor </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div id="add_prd_append">
    </div>
</body>
<script>
    function saveData() {
        var url = "{{URL('/order')}}";
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var rowId = document.getElementById('rowid').value;
        var colId = document.getElementById('columnid').value;
        // alert(rowId);
        if (rowId == "" || rowId == 0) {
            alert("please enter row number");
            return false;
        }
        if (colId == "" || colId == 0) {
            alert("please enter row number");
            return false;
        }
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                "rowID": rowId,
                "colId": colId

            },
            dataType: 'json',
            success: function(data) {

                if (data.success === true) {
                    alert(data.msg);
                    window.location = "/";
                } else {

                }

            },
        });
    }

    function getItemmodal(rowid, col) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/order/getmodal') }}",
            method: 'GET',
            data: {
                "row": rowid,
                "col": col

            },
            success: function(result) {

                $("#add_prd_append").html(result);
                $(".itemclass").modal("show");
            }
        });

    }

    function saveItem() {
        var url = "{{URL('/order/updateItem')}}";
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var item_row = document.getElementById('item_row').value;
        var item_col = document.getElementById('item_col').value;
        var item_name = document.getElementById('item_name').value;
        var item_price = document.getElementById('item_price').value;
        var id = '<?php echo $id; ?>';
        // alert(rowId);

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                "rowID": item_row,
                "colId": item_col,
                "item_name": item_name,
                "item_price": item_price,
                "id": id


            },
            dataType: 'json',
            success: function(data) {

                if (data.success === true) {
                    alert(data.msg);
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $("#add_prd_append").html('');
                    window.location = "/";
                }

            },
        });
    }
</script>

</html>