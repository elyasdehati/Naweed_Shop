@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">گزارش سالانه {{ $year }}</h4>
            </div>
        </div>

        {{-- ---------------- Expenses Table ---------------- --}}
        <div class="row mt-3">
            <div class="col-12">
                <div class="card shadow-sm">

                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">گزارش مصارف</h5>
                    </div>

                    <div class="card-body">
                        <table id="datatable-expenses" class="table table-bordered dt-responsive nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>نام کارمند</th>
                                    <th>آخرین تاریخ مصرف</th>
                                    <th>تعداد مصارف</th>
                                    <th>مجموع مبلغ</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dailyExpenses->values() as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->employee_id ? ($item->employee->name ?? 'N/A') : 'Shop' }}</td>
                                    <td>{{ $item->last_date }}</td>
                                    <td>{{ $item->total_expenses }}</td>
                                    <td>{{ number_format($item->total_amount,2) }}</td>
                                    <td>
                                        <a href="{{ route('all.expenses.invoice', [
                                            'employee_id' => $item->employee_id ?: 0,
                                            'year' => $year   // اضافه شد
                                        ]) }}" class="btn btn-success btn-sm">مشاهده مصارف</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">مصارفی وجود ندارد</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        {{-- ---------------- Sales Table ---------------- --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">

                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">گزارش فروش</h5>
                    </div>

                    <div class="card-body">
                        <table id="datatable-sales" class="table table-bordered dt-responsive nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>نام کارمند</th>
                                    <th>محصول</th>
                                    <th>دسته</th>
                                    <th>تعداد</th>
                                    <th>مبلغ</th>
                                    <th>تاریخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sales->values() as $key => $sale)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $sale->employee->name ?? 'N/A' }}</td>
                                    <td>{{ $sale->product->name ?? 'N/A' }}</td>
                                    <td>{{ $sale->category->name ?? 'N/A' }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ number_format($sale->total,2) }}</td>
                                    <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">فروشی وجود ندارد</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        {{-- ---------------- Summary Card ---------------- --}}
        <div class="row mt-4">
            <div class="col-4 d-flex justify-content-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="p-4 shadow-sm rounded text-end" style="width:320px; background:#f8f9fa; border-right:4px solid #0d6efd;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">تعداد مصارف:</span>
                                <strong>{{ $dailyExpenses->sum('total_expenses') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">تعداد فروش‌ها:</span>
                                <strong>{{ $sales->sum('quantity') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">مجموع فروشات:</span>
                                <strong>{{ number_format($salesTotal,2) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">مجموع مصارفات:</span>
                                <strong>{{ number_format($dailyExpensesTotal,2) }}</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">مفاد :</span>
                                <strong class="{{ $finalAmount >= 0 ? 'text-primary' : 'text-danger' }}">
                                    {{ number_format($finalAmount,2) }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection