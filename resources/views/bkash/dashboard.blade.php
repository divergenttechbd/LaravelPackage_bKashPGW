<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container"><a href="{{ url('/') }}" class="float-right">Back to Home</a></div>

    <div class="container mt-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                    aria-controls="pills-home" aria-selected="true">Refund</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-refund-tab" data-toggle="pill" href="#pills-refund" role="tab"
                    aria-controls="pills-refund" aria-selected="false">Refund Status</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                    aria-controls="pills-profile" aria-selected="false">Payment Status</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                    aria-controls="pills-contact" aria-selected="false">Search Transaction</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-capture-payment-tab" data-toggle="pill"
                    href="#pills-capture-payment" role="tab" aria-controls="pills-capture-payment"
                    aria-selected="false">Capture Payment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-void-payment-tab" data-toggle="pill" href="#pills-void-payment"
                    role="tab" aria-controls="pills-void-payment" aria-selected="false">Void Payment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/query-org-bl') }}">Query
                    Organizational
                    Balance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-intra-transfer-tab" data-toggle="pill" href="#pills-intra-transfer"
                    role="tab" aria-controls="pills-intra-transfer" aria-selected="false">Intra-Account Transfer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-b2c-payout-tab" data-toggle="pill" href="#pills-b2c-payout"
                    role="tab" aria-controls="pills-b2c-payout" aria-selected="false">B2C Payout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-payment-history-tab" data-toggle="pill"
                    href="#pills-payment-history" role="tab" aria-controls="pills-payment-history"
                    aria-selected="false">Payment History</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form id="form_refund" action="{{ url('admin/refund') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>paymentID</label>
                            <input type="text" class="form-control" name="paymentID" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>amount</label>
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>trxID</label>
                            <input type="text" class="form-control" name="trxID" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>sku</label>
                            <input type="text" class="form-control" name="sku">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>reason</label>
                            <textarea name="reason" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary submit">Refund</button>
                </form>
            </div>
            <div class="tab-pane fade show" id="pills-refund" role="tabpanel" aria-labelledby="pills-refund-tab">
                <form id="form_refund_status" action="{{ url('admin/refund-status') }}" method="post"
                    autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>paymentID</label>
                            <input type="text" class="form-control" name="paymentID" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>trxID</label>
                            <input type="text" class="form-control" name="trxID" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Check Refund Status</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form id="form_payment_status" action="{{ url('admin/checkout/query-payment') }}" method="post"
                    autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>paymentID</label>
                            <input type="text" class="form-control" name="paymentID" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Check Payment Status</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <form action="{{ url('admin/checkout/search-transaction') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>trxID</label>
                            <input type="text" class="form-control" name="trxID" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-capture-payment" role="tabpanel"
                aria-labelledby="pills-capture-payment-tab">
                <form action="{{ url('admin/checkout/capture') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>paymentID</label>
                            <input type="text" class="form-control" name="paymentID" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Capture</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-void-payment" role="tabpanel"
                aria-labelledby="pills-void-payment-tab">
                <form action="{{ url('admin/checkout/void') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>paymentID</label>
                            <input type="text" class="form-control" name="paymentID" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Void</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-intra-transfer" role="tabpanel"
                aria-labelledby="pills-intra-transfer-tab">
                <form action="{{ url('admin/intra-transfer') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>amount</label>
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>currency</label>
                            <input type="text" class="form-control" name="currency" value="BDT" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>transferType</label>
                            <select name="transferType" class="form-control" required>
                                <option value="Collection2Disbursement">Collection2Disbursement</option>
                                <option value="Disbursement2Collection">Disbursement2Collection</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Refund</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-b2c-payout" role="tabpanel" aria-labelledby="pills-b2c-payout-tab">
                <form action="{{ url('admin/b2c-payout') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>amount</label>
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>currency</label>
                            <input type="text" class="form-control" name="currency" value="BDT" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>merchantInvoiceNumber</label>
                            <input type="text" class="form-control" name="merchantInvoiceNumber" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>receiverMSISDN</label>
                            <input type="text" class="form-control" name="receiverMSISDN" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Refund</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-payment-history" role="tabpanel"
                aria-labelledby="pills-payment-history-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Payment ID</th>
                            <th scope="col">Trnx ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Merchant Invoice Number</th>
                            <th scope="col">Create Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $key => $history)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $history->paymentId }}</td>
                                <td>{{ $history->trxID }}</td>
                                <td>{{ $history->amount }}</td>
                                <td>{{ $history->currency }}</td>
                                <td>{{ $history->merchantInvoiceNumber }}</td>
                                <td>{{ $history->createTime }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-7">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" width="40%">Field name</th>
                            <th scope="col" width="60%"> Value</th>
                        </tr>
                    </thead>
                    <tbody id="display_result">
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <table class="table" style="]table-layout: fixed;">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Raw Data</th>
                        </tr>
                    </thead>
                    <tbody id="display_result">
                        <tr>
                            <td id="raw_data_put" style="word-wrap:break-word">
                                Raw output
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function displayResult(data) {

            var result = document.getElementById('display_result');
            var str = "";
            for (const [key, value] of Object.entries(data)) {
                //console.log(`${key}: ${value}`);

                var txt = "<tr><td>" + key + "</td>";
                txt = txt + "<td>" + value + "</td></tr>";
                str += txt;
            }
            result.innerHTML = str;
        }

        function getRefundData() {
            var action = document.getElementById("form_refund");

            var url = '{{ url('admin/refund') }}';

            action.onsubmit = async (e) => {
                console.log(e);
                e.preventDefault();
                let response = await fetch(url, {
                    method: 'POST',
                    body: new FormData(action)
                });

                let result = await response.json();
                document.getElementById('raw_data_put').innerHTML = JSON.stringify(result);
                displayResult(result);
            };
        }

        function getRefundStatus() {
            var action = document.getElementById("form_refund_status");
            var url = '{{ url('admin/refund-status') }}';

        }

        function getPaymentStatus() {
            var action = document.getElementById("form_refund_status");
            var url = '{{ url('admin/refund-status') }}';
        }

        getRefundData();
    </script>
</body>

</html>
