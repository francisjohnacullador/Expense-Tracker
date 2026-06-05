@extends('layouts.main')

@section('content')
<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-0">Dashboard</h2>
            <p class="text-muted small">Welcome back, {{ Auth::user()->name }}! Here is your personal financial overview.</p>
        </div>
        <div>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm rounded-3 px-3">
                <i class="bi bi-plus-circle me-1"></i> Add Transaction
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success small py-2 rounded-3 border-0 shadow-sm mb-3" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card p-3 border-0 shadow-sm rounded-4 bg-primary text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="small text-white-50 text-uppercase fw-medium mb-1">Total Balance</p>
                        <h3 class="fw-bold mb-0">₱{{ number_format($totalBalance, 2) }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-circle p-2 d-inline-flex">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 border-0 shadow-sm rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="small text-muted text-uppercase fw-medium mb-1">Monthly Income</p>
                        <h3 class="fw-bold text-success mb-0">+₱{{ number_format($monthlyIncome, 2) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-inline-flex">
                        <i class="bi bi-arrow-down-left-circle fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 border-0 shadow-sm rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="small text-muted text-uppercase fw-medium mb-1">Monthly Expenses</p>
                        <h3 class="fw-bold text-danger mb-0">-₱{{ number_format($monthlyExpenses, 2) }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-2 d-inline-flex">
                        <i class="bi bi-arrow-up-right-circle fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0">Recent Transactions</h5>
            <a href="#" class="text-primary text-decoration-none small fw-medium">View All</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase">
                    <tr>
                        <th class="border-0 text-muted">Date</th>
                        <th class="border-0 text-muted">Description</th>
                        <th class="border-0 text-muted">Category</th>
                        <th class="border-0 text-none text-end text-muted">Amount</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @foreach($recentTransactions as $transaction)
                        <tr>
                            <td class="text-muted">{{ date('M d, Y', strtotime($transaction->transaction_date)) }}</td>
                            <td class="fw-medium text-dark">{{ $transaction->description }}</td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 px-2.5 py-1.5 rounded-pill">
                                    {{ $transaction->category->name ?? 'General' }}
                                </span>
                            </td>
                            <td class="text-end fw-bold {{ $transaction->type == 'income' ? 'text-success' : 'text-danger' }}">
                                {{ $transaction->type == 'income' ? '+' : '-' }}₱{{ number_format($transaction->amount, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection