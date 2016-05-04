

@extends('layouts.app')

@section('content')

<div class=panel-body>
    {!! Form::open(['id'=>'search','method'=>'GET','url'=>'properties','class'=>'form-horizontal','role'=>'form','autocomplete'=>'off'])  !!}

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="input-name" placeholder="try type here..">
        </div>
        <div id="auto-suggest"></div>
        <label for="price" class="col-sm-2 control-label">Price:</label>
        <div class="col-sm-3">
            from
            <input type="number" step="0.01" class="form-control" id="input-from-price"> to
            <input type="number" step="0.01" class="form-control" id="input-to-price">
        </div>
    </div>

    <div class="form-group">
        <label for="bedrooms" class="col-sm-2 control-label">Bedrooms:</label>
        <div class="col-sm-3">
            <input type="number" step="1" class="form-control" id="input-bedrooms">
        </div>
        <label for="bathrooms" class="col-sm-2 control-label">Bathrooms:</label>
        <div class="col-sm-3">
            <input type="number" step="1" class="form-control" id="input-bathrooms">
        </div>
    </div>
    <div class="form-group">
        <label for="storeys" class="col-sm-2 control-label">Storeys:</label>
        <div class="col-sm-3">
            <input type="number" step="1" class="form-control" id="input-storeys">
        </div>
        <label for="garages" class="col-sm-2 control-label">Garages:</label>
        <div class="col-sm-3">
            <input type="number" step="1" class="form-control" id="input-garages">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-6">
            <button type="submit" class="btn btn-default">Search</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <!-- Table Headings -->
    <thead>
    <th>Porperty</th>
    <th>Price</th>
    <th>No Bedrooms</th>
    <th>No Bathrooms</th>
    <th>Storeys</th>
    <th>Garages</th>
    </thead>
    <!-- Table Data -->
    <tbody class="property-body">

    </tbody>
</table>


<script>
    //FIRST initial load to get the data by AJAX
    $(function(){
        $.ajax({
            url : '/properties',
            dataType: 'json',
        }).done(function (data) {
            console.log(data);
            if(data.length >0){
                renderTable(data);
            }else {
                alert('No Records are found, Please revise your search Criteria');
            }

        }).fail(function () {
            alert('Properties failed to load.');
        });
    })

    //Handle Autocomplete
    $('#input-name').autocomplete({
        source : function(request, response) {
            $.ajax({
                url: '/properties',
                dataType: "json",
                data: {
                    name : $('#name').val()
                },
                success: function(data) {
                    var array = data.error ? [] : $.map(data, function(m) {
                        return {
                            label: m.name
                        };
                    });
                    response(array);
                }
            });
        },
        minlength: 2,
        autoFocus: true,
        delay: 500,
    })

    //HANDLE SEARCH
    $('#search').submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url : form.attr('action'),
            data :{
                name: $('#input-name').val(),
                fromprice: $('#input-from-price').val(),
                toprice: $('#input-to-price').val(),
                bedrooms: $('#input-bedrooms').val(),
                bathrooms: $('#input-bathrooms').val(),
                storeys: $('#input-storeys').val(),
                garages: $('#input-garages').val()
            },
            dataType: 'json',
        }).done(function (data) {
            if(data.length >0){
                renderTable(data);
            }else {
                alert('No Records are found, Please revise your search Criteria');
            }

        }).fail(function () {
            alert('Properties failed to load.');
        });
    })

    //HANDLE PAGINATION AJAX


    //Rerender the table result
    function renderTable(data){
        var html = '';
        $.each(data, function (i, item) {
            html += '<tr><td>' + item.name + '</td><td>$' + item.price + '</td><td>' + item.bedrooms + '</td><td>' + item.bathrooms + '</td><td>' + item.storeys + '</td><td>' + item.garages + '</td></tr>';
        });
        $('.property-body').html(html);
    }
</script>
@endsection