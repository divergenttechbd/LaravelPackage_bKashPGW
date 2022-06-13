<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('backend/assets/images/logo/Bkash-logo.png') }}"
                            alt="Logo" style="height: 60px;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item active ">
                    <a href="{{ url('/') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title">Checkout (Regular)</li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Refund</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('refund') }}">Refund</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('refund.status') }}">Refund Status</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Payment</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('payment.history') }}">Payment History</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('payment.capture') }}">Capture Payment</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('payment.void') }}">Void Payment</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Utilities</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('payment.status') }}">Payment Status</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('search.transaction') }}">Search Transaction</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>B2B Payout</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('website.checkout.b2bpayout.history') }}">B2B Payout History</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.checkout.b2bpayout') }}">B2B Payout</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.checkout.querypayout') }}">Query Payout</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Tokenized</li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Agreement</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('website.agreement.history') }}">Agreement History</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.agreement.status') }}">Agreement Status</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.agreement.cancel') }}">Cancel Agreement</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Auth & Capture</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.capture') }}">Capture Payment</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.void') }}">Void Payment</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Refund</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.refund') }}">Refund</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.refund-status') }}">Refund Status</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>B2B Payout</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.b2bpayout.history') }}">B2B Payout History</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.b2bpayout') }}">B2B Payout</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.querypayout') }}">Query Payout</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Recurring</li>

                <li class="sidebar-item  ">
                    <a href="{{ route('subscriber.history') }}" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Subscriber History
                        </span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Subscription Utilities</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('subscriber.query.id') }}">Query by ID</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('subscriber.cancel.id') }}">Cancel Subscription</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('subscription.list.page-size') }}">List by page & size</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Payment</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('subscription.payment.list') }}">Payment list by Subscription ID</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('subscription.payment.refund') }}">Refund Payment</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('subscription.payment.schedule') }}">Payment Schedule</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Disbursement</li>

                <li class="sidebar-item  ">
                    <a href="{{ route('disbursement.query-org-balance') }}" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Query Organizational Balance
                        </span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Checkout</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('disbursement.intra-account.transfer') }}">Intra-Account Transfer</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('disbursement.b2cpayout') }}">B2C Payout</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Tokenized</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('tokenized.intra-account.transfer') }}">Intra-Account Transfer</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('website.tokenized.b2cpayout') }}">B2C Payout</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Log Management</li>

                <li class="sidebar-item  ">
                    <a href="{{ route('log') }}" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>View Log</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
