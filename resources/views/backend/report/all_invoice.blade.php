<style>

.invoice-container {
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.invoice-container h3 {
    font-weight: 700;
    letter-spacing: 1px;
}

.invoice-container h5 {
    font-weight: 600;
    margin-bottom: 15px;
    color: #495057;
}

.invoice-container p {
    font-size: 14px;
    color: #6c757d;
}

.invoice-container strong {
    color: #212529;
}

.table {
    margin-top: 15px;
}

.table thead {
    background: #f8f9fa;
}

.table th {
    font-weight: 600;
    font-size: 14px;
}

.table td {
    font-size: 14px;
}

.table td:last-child,
.table th:last-child {
    text-align: right;
}

.text-end h4 {
    font-weight: 700;
    margin-top: 10px;
    padding: 15px;
    background: #f8f9fa;
    display: inline-block;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

/* Print Optimization */
@media print {

    .btn {
        display: none !important;
    }

    .card {
        border: none;
        box-shadow: none;
    }

    .invoice-container {
        box-shadow: none;
        border: none;
    }

    body {
        background: #fff;
    }
}

</style>
<div class="card-body">

    <div class="invoice-container p-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-0">INVOICE</h2>
                <small class="text-muted">Expense Details</small>
            </div>

            <div class="text-end">
                <button onclick="window.print()" class="btn btn-primary">
                    Print Invoice
                </button>
            </div>

        </div>

        <hr>

        <!-- Top Info -->
        <div class="row mt-4">

            <div class="col-md-6">
                <div class="invoice-box">

                    <h6 class="text-muted mb-2">Billed To</h6>

                    <h5 class="mb-1">
                        {{ $expense->employee->name ?? 'N/A' }}
                    </h5>

                    <p class="mb-0 text-muted">
                        {{ $expense->employee->position ?? '' }}
                    </p>

                </div>
            </div>

            <div class="col-md-6 text-end">
                <div class="invoice-box">

                    <h6 class="text-muted mb-2">Invoice Information</h6>

                    <p class="mb-1">
                        <strong>Invoice ID:</strong> #{{ $expense->id }}
                    </p>

                    <p class="mb-1">
                        <strong>Date:</strong> {{ $expense->date }}
                    </p>

                </div>
            </div>

        </div>

        <!-- Table -->
        <div class="mt-5">

            <h5 class="mb-3">Expense Summary</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th width="200" class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $expense->description }}</td>
                            <td class="text-end fw-semibold">
                                {{ number_format($expense->amount, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Total Section -->
        <div class="d-flex justify-content-end mt-4">

            <div class="total-box text-end">
                <small class="text-muted">Total Amount</small>
                <h3 class="fw-bold mb-0">
                    {{ number_format($expense->amount, 2) }}
                </h3>
            </div>

        </div>

    </div>

</div>