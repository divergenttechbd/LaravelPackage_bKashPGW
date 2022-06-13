@extends('backend.layout.master')

@section('content')
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Tokenized - B2B Payout History</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">trxID</th>
                                        <th scope="col">payoutID</th>
                                        <th scope="col">b2bFee</th>
                                        <th scope="col">payoutType</th>
                                        <th scope="col">transactionStatus</th>
                                        <th scope="col">amount</th>
                                        <th scope="col">receiverMSISDN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($payouts) != 0)
                                        @foreach ($payouts as $key => $payout)
                                            @php
                                                $payout = json_decode($payout->data);
                                            @endphp
                                            <tr>
                                                <td>{{ $payout->trxID }}</th>
                                                <td>{{ $payout->payoutID }}</td>
                                                <td>{{ $payout->b2bFee }}</td>
                                                <td>{{ $payout->payoutType }}</td>
                                                <td>{{ $payout->transactionStatus }}</td>
                                                <td>{{ $payout->amount }}</td>
                                                <td>{{ $payout->receiverMSISDN }}</td>
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
