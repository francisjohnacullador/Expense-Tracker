@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold text-dark mb-3">Add Category</h4>
                
                @if (session('success'))
                    <div class="alert alert-success small py-2 rounded-3 border-0 mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Category Name</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="e.g., Food, Salary, Bill" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Type</label>
                        <select name="type" class="form-select rounded-3" required>
                            <option value="expense">Expense (Gastos)</option>
                            <option value="income">Income (Kita)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-3 w-100 mt-2">Save Category</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h4 class="fw-bold text-danger mb-3">Expenses Categories</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <tbody class="small">
                            @forelse($expenses as $category)
                                <tr>
                                    <td class="fw-medium text-dark">{{ $category->name }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center text-muted py-3">No expense categories.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold text-success mb-3">Income Categories</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <tbody class="small">
                            @forelse($incomes as $category)
                                <tr>
                                    <td class="fw-medium text-dark">{{ $category->name }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center text-muted py-3">No income categories.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection