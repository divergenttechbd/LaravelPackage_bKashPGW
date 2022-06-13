@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Subscriber History</h4>
                </div>
                <div class="card-content">
                    <!-- table hover -->
                    <div>
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">subscriptionRequestId</th>
                                    <th scope="col">expirationTime</th>
                                    <th scope="col">timeStamp</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($subs) != 0)
                                @foreach ($subs as $key => $subscriber)
                                @php
                                $subscriber = json_decode($subscriber->response);
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</th>
                                    <td>{{ $subscriber->subscriptionRequestId??"" }}</td>
                                    <td>{{ $subscriber->expirationTime??"" }}</td>
                                    <td>{{ $subscriber->timeStamp??"" }}</td>
                                    <td>
                                        <a target="_blank" class="btn btn-primary" href="{{ route('recurring.subscription.query.requestID', $subscriber->subscriptionRequestId??"") }}">Query Subscription</a>
                                    </td>
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