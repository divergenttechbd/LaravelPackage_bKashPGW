@extends('backend.layout.master')

@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cancel Agreement</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ route('agreement.cancel') }}" method="post"
                                autocomplete="off">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>agreementID</label>
                                                <input type="text" class="form-control" name="agreementID" required>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Cancel
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
