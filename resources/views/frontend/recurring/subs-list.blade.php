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
                    <h4 class="card-title">Subscription List by page & size</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('recurring.subscription.list') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Page Number</label>
                                            <input type="number" class="form-control" name="page" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Size (number of rows)</label>
                                            <input type="number" class="form-control" name="size" required>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Get List
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