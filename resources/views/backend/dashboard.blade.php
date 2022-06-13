@extends('backend.layout.master')

@section('content')

    <div class="page-heading">
        <h3>Customer-End bKash Services</h3>
    </div>
    <div class="container mt-5">
        @include('backend.includes.message')
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-6 col-md-6">
                        <a href="{{ url('customer/checkout/products') }}">
                            <div class="card" style="background: #d62267 !important;">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-muted font-semibold"
                                                style="color: white !important; text-transform: uppercase;">Instant
                                                Checkout</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card" style="background: #d62267 !important;">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('agreement.create') }}" method="POST" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="payerReference" value="demo123"
                                                class="form-control"
                                                placeholder="payerReference - DEMO12345 / 017********">
                                            <button type="submit" class="text-muted font-semibold"
                                                style="color: white !important; color: white !important; background: none; border: none; padding: inherit; cursor: pointer; text-transform: uppercase;">
                                                Add bKash Account (Create Agreement)</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <a href="{{ route('tokenized.products', 'true') }}">
                            <div class="card" style="background: #d62267 !important;">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-muted font-semibold"
                                                style="color: white !important; text-transform: uppercase;">Checkout -
                                                With Agreement</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <a href="{{ route('tokenized.products', 'false') }}">
                            <div class="card" style="background: #d62267 !important;">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-muted font-semibold"
                                                style="color: white !important; text-transform: uppercase;">Checkout -
                                                Without Agreement</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-6 col-lg-6 col-md-6">
                        <a href="{{ route('recurring.subscription') }}">
                            <div class="card" style="background: #d62267 !important;">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-muted font-semibold"
                                                style="color: white !important; text-transform: uppercase;">Recurring - Create Subscription</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
