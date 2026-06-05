@extends('layouts.main')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <h3 class="fw-bold text-dark mb-1">Add New Transaction</h3>
        <p class="text-muted small mb-4">Record your income or expense below, just like creating a note.</p>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase">Transaction Type</label>
                <select name="type" id="transaction_type" class="form-select rounded-3 @error('type') is-invalid @enderror" required>
                    <option value="expense" selected>Expense (Gastos)</option>
                    <option value="income">Income (Kita)</option>
                </select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase">Category</label>
                <select name="category_id" id="category_dropdown" class="form-select rounded-3 @error('category_id') is-invalid @enderror" required>
                    <option value="" disabled selected>-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" data-type="{{ $category->type }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <span class="text-muted" style="font-size: 11px;">Tip: Add categories first in the Categories tab if empty.</span>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                <input type="text" name="description" class="form-control rounded-3 @error('description') is-invalid @enderror" placeholder="e.g., Jollibee, Grocery, Salary" value="{{ old('description') }}" required>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase">Amount ($)</label>
                <input type="number" name="amount" step="0.01" class="form-control rounded-3 @error('amount') is-invalid @enderror" placeholder="0.00" value="{{ old('amount') }}" required>
                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted text-uppercase">Date</label>
                <input type="date" name="transaction_date" class="form-control rounded-3 @error('transaction_date') is-invalid @enderror" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                @error('transaction_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-3 px-4 w-100">Save Transaction</button>
                <a href="{{ route('dashboard') }}" class="btn btn-light rounded-3 px-4 w-100">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('transaction_type');
    const categorySelect = document.getElementById('category_dropdown');
    const allOptions = Array.from(categorySelect.options).filter(opt => opt.value !== "");

    function filterCategories() {
        const selectedType = typeSelect.value; // 'expense' o 'income'
        
        // I-clear muna ang dropdown at ibalik ang default na "-- Select Category --"
        categorySelect.innerHTML = '<option value="" disabled selected>-- Select Category --</option>';
        
        // Isalpak lang pabalik ang mga kategorya na tumutugma sa napiling type
        allOptions.forEach(option => {
            if (option.getAttribute('data-type') === selectedType) {
                categorySelect.appendChild(option.cloneNode(true));
            }
        });
    }

    // Patakbuhin ang filter sa unang load ng page (default is expense)
    filterCategories();

    // Patakbuhin ang filter tuwing binabago ng user ang pili sa Transaction Type
    typeSelect.addEventListener('change', filterCategories);
});
</script>
@endsection