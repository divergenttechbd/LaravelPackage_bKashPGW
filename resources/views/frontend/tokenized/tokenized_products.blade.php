<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Detail</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet"
        id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="{{ env('BKASH_CHECKOUT_SANDBOX_SCRIPT') }}"></script>

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
                            <div class="tab-pane active" id="pic-1"><img
                                    src="https://media.istockphoto.com/photos/downtown-cleveland-hotel-entrance-and-waiting-taxi-cab-picture-id472899538?b=1&k=20&m=472899538&s=170667a&w=0&h=oGDM26vWKgcKA3ARp2da-H4St2dMEhJg23TTBeJgPDE=" />
                            </div>
                            <div class="tab-pane" id="pic-2"><img
                                    src="https://media.istockphoto.com/photos/downtown-cleveland-hotel-entrance-and-waiting-taxi-cab-picture-id472899538?b=1&k=20&m=472899538&s=170667a&w=0&h=oGDM26vWKgcKA3ARp2da-H4St2dMEhJg23TTBeJgPDE=" />
                            </div>
                            <div class="tab-pane" id="pic-3"><img
                                    src="https://media.istockphoto.com/photos/downtown-cleveland-hotel-entrance-and-waiting-taxi-cab-picture-id472899538?b=1&k=20&m=472899538&s=170667a&w=0&h=oGDM26vWKgcKA3ARp2da-H4St2dMEhJg23TTBeJgPDE=" />
                            </div>
                            <div class="tab-pane" id="pic-4"><img
                                    src="https://media.istockphoto.com/photos/downtown-cleveland-hotel-entrance-and-waiting-taxi-cab-picture-id472899538?b=1&k=20&m=472899538&s=170667a&w=0&h=oGDM26vWKgcKA3ARp2da-H4St2dMEhJg23TTBeJgPDE=" />
                            </div>
                            <div class="tab-pane" id="pic-5"><img
                                    src="https://media.istockphoto.com/photos/downtown-cleveland-hotel-entrance-and-waiting-taxi-cab-picture-id472899538?b=1&k=20&m=472899538&s=170667a&w=0&h=oGDM26vWKgcKA3ARp2da-H4St2dMEhJg23TTBeJgPDE=" />
                            </div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"><img
                                        src="https://image.shutterstock.com/image-illustration/hotel-sign-stars-3d-illustration-260nw-195879770.jpg" /></a>
                            </li>
                            <li><a data-target="#pic-2" data-toggle="tab"><img
                                        src="https://image.shutterstock.com/image-illustration/hotel-sign-stars-3d-illustration-260nw-195879770.jpg" /></a>
                            </li>
                            <li><a data-target="#pic-3" data-toggle="tab"><img
                                        src="https://image.shutterstock.com/image-illustration/hotel-sign-stars-3d-illustration-260nw-195879770.jpg" /></a>
                            </li>
                            <li><a data-target="#pic-4" data-toggle="tab"><img
                                        src="https://image.shutterstock.com/image-illustration/hotel-sign-stars-3d-illustration-260nw-195879770.jpg" /></a>
                            </li>
                            <li><a data-target="#pic-5" data-toggle="tab"><img
                                        src="https://image.shutterstock.com/image-illustration/hotel-sign-stars-3d-illustration-260nw-195879770.jpg" /></a>
                            </li>
                        </ul>

                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">Hotel Room Booking</h3>
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
                        <h4 class="price">per day: ৳<span id="amount"> 35000</span></h4>
                        <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87
                                votes)</strong></p>
                        <div class="action">
                            @if ($is_with_agreement == 'true')
                                <form action="{{ route('with-agreement.create') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="amount" id="hidden_amount2">
                                    <input type="hidden" name="invoice" value="{{ rand(1, 99) }}">
                                    <input type="hidden" name="payerReference" value="demo123" class="form-control"
                                        placeholder="payerReference - DEMO12345 / 017********">
                                    <button id="bKash_button" class="add-to-cart btn btn-default" type="submit">Pay with
                                        bKash (With Agreement Payment)</button>
                                </form>
                                <br>
                                <form action="{{ route('with-agreement.create') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="amount" id="hidden_amount">
                                    <input type="number" style="margin: 5px; padding: 10px;" placeholder="Enter User ID" name="user_id">
                                    <input type="hidden" name="invoice" value="{{ rand(1, 99) }}">
                                    <input type="hidden" name="payerReference" value="demo123" class="form-control"
                                        placeholder="payerReference - DEMO12345 / 017********">
                                    <button id="bKash_button" class="add-to-cart btn btn-default" type="submit">Pay with
                                        bKash - Only Payment (With/Without Agreement)</button>
                                </form>
                            @else
                                <form action="{{ route('without-agreement.create') }}" method="POST"
                                    autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="amount" id="hidden_amount">
                                    <input type="hidden" name="invoice" value="{{ rand(1, 99) }}">
                                    <input type="hidden" name="payerReference" value="demo123" class="form-control"
                                        placeholder="payerReference - DEMO12345 / 017********">
                                    <button id="bKash_button" class="add-to-cart btn btn-default" type="submit">Pay with
                                        bKash (Without Agreement)</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        var amount = $('#amount').text();
        $("#hidden_amount2").val(amount);
        $("#hidden_amount").val(amount);
    });
</script>

</html>
