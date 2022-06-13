<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Detail</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    @php
    $config = config(\Divergent\Bkash\Consts\BkashConstant::CHECKOUT);
    @endphp
    @if($config['sandbox'])
    <script src="{{ $config['sandbox_script'] }}"></script>
    @else
    <script src="{{ $config['production_script'] }}"></script>
    @endif

    <style>
        /*****************globals*************/
        body {
            font-family: 'open sans';
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
        }

        .preview {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px;
            }
        }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px;
        }

        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%;
        }

        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block;
        }

        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0;
        }

        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0;
        }

        .tab-content {
            overflow: hidden;
        }

        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s;
        }

        .card {
            margin-top: 50px;
            background: #eee;
            padding: 3em;
            line-height: 1.5em;
        }

        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
            }
        }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .product-title,
        .price,
        .sizes,
        .colors {
            text-transform: UPPERCASE;
            font-weight: bold;
        }

        .checked,
        .price span {
            color: #ff9f1a;
        }

        .product-title,
        .rating,
        .product-description,
        .price,
        .vote,
        .sizes {
            margin-bottom: 15px;
        }

        .product-title {
            margin-top: 0;
        }

        .size {
            margin-right: 10px;
        }

        .size:first-of-type {
            margin-left: 40px;
        }

        .color {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            height: 2em;
            width: 2em;
            border-radius: 2px;
        }

        .color:first-of-type {
            margin-left: 20px;
        }

        .add-to-cart,
        .like {
            background: #d62267;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
        }

        .add-to-cart:hover,
        .like:hover {
            background: #ad0244;
            color: #fff;
        }

        .not-available {
            text-align: center;
            line-height: 2em;
        }

        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff;
        }

        .orange {
            background: #ff9f1a;
        }

        .green {
            background: #85ad00;
        }

        .blue {
            background: #0076ad;
        }

        .tooltip-inner {
            padding: 1.3em;
        }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        /*# sourceMappingURL=style.css.map */
    </style>

</head>

<body>

    <div class="container">
        <div class="card">
            <a href="{{ url('/') }}" class="pull-right">Back to Home</a>
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                        </ul>

                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">Ashera Cat</h3>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">41 reviews</span>
                        </div>
                        <p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium
                            cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
                        <h4 class="price">current price: ৳<span id="amount">18000</span></h4>
                        <input type="hidden" id="invoice_no" value="{{ rand(1, 99) }}">
                        <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87
                                votes)</strong></p>
                        <div class="action">
                            <button id="bKash_button" class="add-to-cart btn btn-default" type="button">Pay with
                                bKash</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var paymentID = '';

    function errorMessage(response) {
        let msg = '';
        if (typeof response.errorMessage === 'undefined') {
            msg += 'payment_failed';
        } else {
            let errorMessage = 'Sorry, your payment was unsuccessful !!! ' + response.errorMessage;
            let errorCode = response.errorCode;
            let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013,
                2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029,
                2030, 2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045,
                2046, 2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061,
                2062, 2063, 2064, 2065, 2066, 2067, 2068, 2069, 503
            ];

            if (bkashErrorCode.includes(errorCode)) {
                errorMessage = 'Sorry, your payment was unsuccessful !!! ' + response.errorMessage;
            } else if (errorCode == 2029) {
                errorMessage =
                    'Sorry, your payment was unsuccessful !!! For same amount transaction, please try again after 10 minutes.';
            }

            msg += errorMessage;
        }
        return msg;
    }

    function callQueryPayment(paymentID) {
        $.ajax({
            url: "{{ url('admin/checkout/query-payment') }}",
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                "paymentID": paymentID
            }),
            success: function(data) {
                //data = JSON.parse(data);                 
                //console.log(data);
                if (data && data.transactionStatus == "Initiated") {
                    $("#bKash_button").click();
                } else if (data && data.transactionStatus == "Completed") {
                    window.location.href = "{{ url('customer/checkout/success') }}/" +
                        JSON.stringify(data); //Merchant’s success page                     
                } else {
                    bKash.execute().onError();
                    window.location.href = "{{ url('customer/checkout/failed') }}/" +
                        errorMessage(data);
                }
            },
            error: function() {
                bKash.execute().onError();
            }
        });
    }

    function callBkashPayment() {
        bKash.init({
            paymentMode: 'checkout', //fixed value ‘checkout’ 
            //paymentRequest format: {amount: AMOUNT, intent: INTENT} 
            //intent options 
            //1) ‘sale’ – immediate transaction (2 API calls) 
            //2) ‘authorization’ – deferred transaction (3 API calls) 
            paymentRequest: {
                amount: document.getElementById("amount").innerText, //max two decimal points allowed 
                invoice_no: document.getElementById("invoice_no").value
            },
            createRequest: function(
                request
            ) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method             
                $.ajax({
                    url: "{{ url('customer/checkout/create') }}",
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        amount: document.getElementById("amount")
                            .innerText, //max two decimal points allowed 
                        invoice_no: document.getElementById("invoice_no").value
                    }),
                    success: function(data) {
                        //data = JSON.parse(data);
                        if (data && data.paymentID != null) {
                            paymentID = data.paymentID;
                            bKash.create().onSuccess(
                                data
                            ); //pass the whole response data in bKash.create().onSucess() method as a parameter 
                        } else {
                            bKash.create().onError();
                        }
                    },
                    error: function() {
                        bKash.create().onError();
                    }
                });
            },
            executeRequestOnAuthorization: function() {
                $.ajax({
                    url: "{{ url('customer/checkout/execute') }}",
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        "paymentID": paymentID
                    }),
                    success: function(data) {
                        //console.log(data);
                        if (data == null || data == "") {
                            callQueryPayment(paymentID);
                        } else if (data && data.paymentID != null) {
                            window.location.href = "{{ url('customer/checkout/success') }}/" +
                                JSON.stringify(data); //Merchant’s success page
                        } else {
                            bKash.execute().onError();
                            window.location.href = "{{ url('customer/checkout/failed') }}/" +
                                errorMessage(data);
                        }
                    },
                    error: function() {
                        bKash.execute().onError();
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        callBkashPayment();
    });
</script>

</html>