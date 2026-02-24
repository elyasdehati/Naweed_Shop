<style>

.report-card {
    border-radius: 14px;
    border: 1px solid #e9ecef;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

.report-card .card-header {
    background: #fff;
    border-bottom: 1px solid #f1f3f5;
    padding: 18px 22px;
}

.report-card .card-body {
    padding: 25px;
}

.table thead tr {
    background: #f8f9fa;
}

.table th {
    font-weight: 600;
    font-size: 14px;
    color: #495057;
}

.table td {
    font-size: 14px;
    padding: 14px 10px;
}

.expense-badge {
    background: #eef2ff;
    color: #3b5bdb;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
}

.amount-text {
    font-weight: 700;
    color: #2b8a3e;
    font-size: 15px;
}

.empty-state {
    color: #6c757d;
}

.empty-state h5 {
    margin-bottom: 5px;
}

/* Hover Effect */
.table-hover tbody tr:hover {
    background: #f8f9fa;
    transition: 0.2s;
}

/* Print Optimization */
@media print {

    .btn {
        display: none !important;
    }

    .report-card {
        box-shadow: none;
        border: none;
    }

    body {
        background: #fff;
    }
}

</style>
<div class="content">

    <div class="container-xxl">

        <!-- Page Header -->
        <div class="py-3 mb-3">
            <h3 class="fw-bold mb-0">Yearly Employee Expense Report</h3>
            <small class="text-muted">Employee-wise financial summary</small>
        </div>

        <div class="card report-card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Expense Summary</h5>

                <button onclick="window.print()" class="btn btn-sm btn-primary">
                    Print Report
                </button>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle text-center">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-start">Employee</th>
                                <th class="text-start">Note</th>
                                <th>Expenses</th>
                                <th class="text-end">Total Amount</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($expenses as $key => $item)

                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td class="text-start fw-semibold">
                                        {{ $item->employee->name ?? 'N/A' }}
                                    </td>

                                      <td class="text-start fw-semibold">
                                        {{ $item->note  }}
                                    </td>

                                    <td>
                                        <span class="expense-badge">
                                            {{ $item->total_expenses }}
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <span class="amount-text">
                                            {{ number_format($item->total_amount, 2) }}
                                        </span>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="py-5">
                                        <div class="empty-state">
                                            <h5>No Records Found</h5>
                                            <small>No expenses available for this year</small>
                                        </div>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>