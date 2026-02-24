@extends('backend.master')
@section('body')

<div class="content">

    <div class="container-xxl">

        <!-- Page Title -->
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Yearly Report</h4>
            </div>
        </div>

        <!-- Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Expense List</h5>
                    </div>

                    <div class="card-body">

                        <!-- Optional Total Section -->
                        @isset($totalAmount)
                            <div class="mb-3 text-end">
                                <h5>
                                    Year Total: 
                                    <span class="text-primary">
                                        {{ number_format($totalAmount, 2) }}
                                    </span>
                                </h5>
                            </div>
                        @endisset

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">

                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($expenses as $key => $item)

                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $item->title }}</td>
                                        <td class="text-center">
                                            {{ number_format($item->amount, 2) }}
                                        </td>
                                        <td class="text-center">{{ $item->date }}</td>
                                        <td class="text-center">{{ $item->note }}</td>
                                        <td class="text-center">{{ $item->type }}</td>
                                        <td class="text-center">
                                            {{ $item->employee->name  }}
                                        </td>
                                   
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="text-muted">
                                                <h5 class="mb-1">No Records Found</h5>
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

</div>

<!-- Styling -->
<style>

.card {
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.table th {
    font-weight: 600;
    font-size: 14px;
}

.table td {
    font-size: 14px;
}

.btn-sm {
    padding: 5px 12px;
    border-radius: 6px;
}

</style>

@endsection