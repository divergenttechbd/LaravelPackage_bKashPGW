@extends('backend.layout.master')

@section('content')

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Log Data</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {{-- {!! \Divergent\Bkash\BkashLog::readLog() !!} --}}
                            @if (\App\Models\ActivityLog::all()->sortByDesc('created_at')->count() != 0)
                                @foreach (\App\Models\ActivityLog::all()->sortByDesc('created_at') as $item)
                                    <div>API URL = {{ $item->api_url }}</div>
                                    <div>DATE TIME = {{ $item->date_time }}</div>
                                    <div>RESPONSE = {{ $item->response }}</div>
                                    <div>
                                        ---------------------------------------------------------------------------------------------------
                                    </div>
                                @endforeach
                            @else
                                <p>No Data!!!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
