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
                        <form class="form form-vertical" action="{{ route('recurring.payment.schedule') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-body">
                                <div class="row">                                    
                                    <div class="col-4">
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
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>startDate</label>
                                            <input type="date" name="startDate" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>expiryDate</label>
                                            <input type="date" name="expiryDate" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">View Schedule
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