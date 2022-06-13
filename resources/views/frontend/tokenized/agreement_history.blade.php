@extends('backend.layout.master')

@section('content')
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Agreement History</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Agreement ID</th>
                                        <th scope="col">Payment ID</th>
                                        <th scope="col">Create Data & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($userAgreements) != 0)
                                        @foreach ($userAgreements as $key => $userAgreement)
                                            <tr>
                                                <td>{{ $key + 1 }}</th>
                                                <td>{{ $userAgreement->user_id }}</td>
                                                <td>{{ $userAgreement->agreement_id }}</td>
                                                <td>{{ $userAgreement->payment_id }}</td>
                                                <td>{{ $userAgreement->created_at }}</td>
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
