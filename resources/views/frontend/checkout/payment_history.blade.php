@extends('backend.layout.master')

@section('content')
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment History</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Payment ID</th>
                                        <th scope="col">Trnx ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Intent</th>
                                        <th scope="col">Merchant Invoice Number</th>
                                        <th scope="col">Create Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($histories) != 0)
                                        @foreach ($histories as $key => $history)
                                            <tr>
                                                <td>{{ $key + 1 }}</th>
                                                <td>{{ $history->paymentId }}</td>
                                                <td>{{ $history->trxID }}</td>
                                                <td>{{ $history->amount }}</td>
                                                <td>{{ $history->currency }}</td>
                                                <td>{{ $history->intent }}</td>
                                                <td>{{ $history->merchantInvoiceNumber }}</td>
                                                <td>{{ $history->createTime }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <th colspan="7" class="text-center">No Data</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
