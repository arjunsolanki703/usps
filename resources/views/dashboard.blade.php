@extends('layout')

@section('content')
<div class="container">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <div class="alert alert-success flash-message mt-2" role="alert" style="display:none;">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('address.create') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">
                                Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">
                                City</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">
                                State</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="state" name="state">
                            </div>
                        </div>
                    </form>


                    <div class="card-columns" id="address_show" style="display:none;">
                        <div class="card">

                            <div class="card-body text-center">
                                <div id="individual_address"></div>
                            </div>
                            <div class="radio">
                                <input name="standardized" id="individual" class="radio" type="radio">
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="standard_address"></div>
                            </div>
                            <div class="radio">
                                <input name="standardized" id="standardized" class="radio" type="radio">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary update_data">
                            Submit
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).on('click', '.update_data', function(e) {

    e.preventDefault();
    var data = {
        'address': $('#address').val(),
        'city': $('#city').val(),
        'state': $('#state').val(),
        'standardized': $('#individual').is(":checked") ? $("#individual_address").html() : $(
            "#standard_address").html(),
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/address",
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        success: function(response) {
            if (response.status == 200) {
                $('#address_show').css('display', 'block');
                $("#individual_address").html(response.address);
                $("#standard_address").html(response.usps);
                if (response.message) {
                    $('div.flash-message').html(response.message).css('display', 'block');
                }

            } else if (response.status == 202) {
                alert(response.error);
                $("#alert").html(response.error);

            }

        }
    });

});
</script>
@endsection