<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .wrapper {
        width: 600px;
        margin: 0 auto;
    }

    .original {
        margin-top: 20px;
        width: 60%;
        position: initial;
        margin-bottom: 25px;
    }

    .title {
        font-size: large;
        margin-bottom: 17px;
    }

    .btn {
        background-color: #3b71ca;
    }
    .address-form{
        padding-top:25px;
    }
    </style>
</head>

<body>
    <div class="row justify-content-center address-form">
        <div class="col-md-5 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Address Validator</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <!-- Text input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example3">Address line 1</label>

                            <input type="text" name="address_1" id="address_1" class="form-control" />
                        </div>

                        <!-- Text input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example4">Address 2</label>
                            <input type="text" name="address_2" id="address_2" class="form-control" />
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example5">City</label>

                            <input type="text" name="city" id="city" class="form-control" />
                        </div>

                        <!-- Number input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example6">State</label>
                            <select name="state" id="state" class="form-control">
                                <option value="0" selected>Enter state</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">>Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example6">Zip Code</label>

                            <input type="text" id="zip" name="zip" class="form-control" />
                        </div>

                        <hr class="my-4" />

                        <button class="btn btn-primary btn-lg update_data" id="trigger"
                            type="button" name="save">
                            Validate
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><b>Save Address </b></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>

                    </button>

                </div>
                <div class="modal-body">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <div class="title">Which address format do you want to save?</div>
                        <ul class="nav nav-pills">
                             <li class="active"><a data-toggle="pill" href="#uploadTab" id="tabLinks">ORIGINAL</a></li>
                            <li ><a href="#browseTab" id="tabLinks"  data-toggle="pill">STANDARIZAD (USPS)</a>

                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content mb-2">
                            <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                <div class="card original">
                                    <div class="card-body text-center">
                                        <div id="individual_address"></div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="browseTab">
                                <div class="card original">
                                    <div class="card-body text-center">
                                        <div id="standard_address"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success flash-message mt-2" role="alert" style="display:none;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Credit card form -->
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<script type="text/javascript">
var orgData = {}
var stdData = {}
var activeTab = 0;

$(document).on('click', '#tabLinks', function() {
    activeTab = $(this).data('value');
})
$(document).ready(function () {
$(document).on('click', '.update_data', function(e) {

    e.preventDefault();
  
    data = {
        'address_1': $('#address_1').val(),
        'address_2': $('#address_2').val(),
        'city': $('#city').val(),
        'state': $('#state').val(),
        'zip': $('#zip').val(),
        'standardized': $('#individual').is(":checked") ? $("#individual_address").html() : $(
            "#standard_address").html(),
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const formData = JSON.stringify(data);

    $.ajax({
        type: "POST",
        url: "backend.save.php",
        data: {
            data: formData
        },
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        success: function(response) {
            const res = JSON.parse(response);
            if (res.statusCode == 200) {
              
              $('#myModal').modal('show');
                
                $('#individual_address').html('Address line 1 : ' + res.address_1 + '</br>' +
                    'Address Line 2 :' + res.address_2 +
                    '</br>' + 'City :' + res.city + '</br>' + 'State :' + res.state + '</br>' +
                    'Zip Code :' +
                    res.zip);

                $('#standard_address').html('Address line 1 : ' + res.address_1_usps + '</br>' +
                    'Address Line 2 :' + res.address_2_usps +
                    '</br>' + 'City :' + res.city_usps + '</br>' + 'State :' + res.state_usps +
                    '</br>' + 'Zip Code :' +
                    res.zip1_usps + '-' + res.zip2_usps);

                orgData = {
                    address_1: res.address_1,
                    address_2: res.address_2,
                    city: res.city,
                    state: res.state,
                    zip: res.zip,
                }

                stdData = {
                    address_1: res.address_1_usps,
                    address_2: res.address_2_usps,
                    city: res.city_usps,
                    state: res.state_usps,
                    zip: res.zip1_usps + '-' + res.zip2_usps,
                }

            } else if (res.statusCode == 202) {
                alert(res.error);
                $("#alert").html(res.error);
      
            }

        }
    });

});
})

$(document).on('click', '.save', function(e) {
    e.preventDefault();
    var data = activeTab == 0 ? orgData : stdData
    console.log("Dataaaa : ", data)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const formData = JSON.stringify(data);

    $.ajax({
        type: "POST",
        url: "address.save.php",
        data: {
            data: formData
        },
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        success: function(response) {
            const res = JSON.parse(response);
            if (res.statusCode == 200) {

                if (res.message) {
                    $('div.flash-message').html(res.message).css('display', 'block');
                }
            }
        }
    });

});
</script>