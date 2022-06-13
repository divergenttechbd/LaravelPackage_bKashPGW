@extends('backend.layout.master')

@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Search Transaction</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ route('checkout.search.transaction') }}"
                                method="post" autocomplete="off">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>trxID</label>
                                                <input type="text" class="form-control" name="trxID" required>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Search
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
