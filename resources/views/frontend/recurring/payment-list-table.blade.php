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
                    <h4 class="card-title">Payment List by Subscription ID</h4>
                </div>
                <div class="card-content">
                    <div>
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">subscriptionId</th>
                                    <th scope="col">dueDate</th>
                                    <th scope="col">status</th>
                                    <th scope="col">trxId</th>
                                    <th scope="col">trxTime</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($response) != 0)                                
                                @foreach ($response as $key => $data)
                                <tr>
                                    <td>{{ $data->id }}</th>
                                    <td>{{ $data->subscriptionId }}</td>
                                    <td>{{ $data->dueDate }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->trxId }}</td>
                                    <td>{{ $data->trxTime }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>
                                        <a target="_blank" class="btn btn-primary" href="{{ route('recurring.payment.info', $data->id) }}">Payment Info</a>
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