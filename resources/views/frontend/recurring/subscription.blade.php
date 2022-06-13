@extends('backend.layout.master')

@section('content')
<section id="basic-vertical-layouts">

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible show fade">
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach
    @endif

    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recurring - Subscription</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('recurring.subscription.create') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>subscriptionRequestId (System generated unique id)</label>
                                            <input type="text" class="form-control" name="subscriptionRequestId" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>subscriptionType</label>
                                            <select name="subscriptionType" class="form-control" required>
                                                <option value="BASIC">BASIC</option>
                                                <option value="WITH_PAYMENT">WITH_PAYMENT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>amount</label>
                                            <input type="text" class="form-control" name="amount" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>firstPaymentAmount (Mandatory if WITH_PAYMENT)</label>
                                            <input type="text" class="form-control" name="firstPaymentAmount">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>firstPaymentIncludedInCycle</label>
                                            <select name="firstPaymentIncludedInCycle" class="form-control">
                                                <option value="false">Not part of payment</option>
                                                <option value="true">Part of payment</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>frequency</label>
                                            <select name="frequency" class="form-control" required>
                                                <option value="DAILY">DAILY</option>
                                                <option value="WEEKLY">WEEKLY</option>
                                                <option value="FIFTEEN_DAYS">FIFTEEN_DAYS</option>
                                                <option value="THIRTY_DAYS">THIRTY_DAYS</option>
                                                <option value="NINETY_DAYS">NINETY_DAYS</option>
                                                <option value="ONE_EIGHTY_DAYS">ONE_EIGHTY_DAYS</option>
                                                <option value="CALENDAR_MONTH">CALENDAR_MONTH</option>
                                                <option value="CALENDAR_YEAR">CALENDAR_YEAR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>startDate</label>
                                            <input type="date" name="startDate" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>expiryDate</label>
                                            <input type="date" name="expiryDate" class="form-control" required>
                                        </div>
                                    </div>                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>subscriptionReference</label>
                                            <input type="text" name="subscriptionReference" readonly class="form-control" value="MSMSR{{ rand(1, 999) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Subscribe
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection