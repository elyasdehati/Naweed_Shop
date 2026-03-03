@extends('backend.master')
@section('body')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">خانه</h4>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="row g-3">

                    <!-- Total Stock -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">موجودی کل محصولات</div>
                                <div class="fs-22 fw-semibold text-primary">
                                    {{ number_format($totalStock) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">تعداد کارمندان</div>
                                <div class="fs-22 fw-semibold text-info">
                                    {{ $totalEmployees }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">تعداد فروش امروز</div>
                                <div class="fs-22 fw-semibold text-info">
                                    {{ $todaySalesCount }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Today -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">تعداد مصارف امروز</div>
                                <div class="fs-22 fw-semibold text-black">
                                    {{ $todayExpensesCount }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Today -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">فروش امروز</div>
                                <div class="fs-22 fw-semibold text-black">
                                    {{ number_format($todaySales,2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expenses Today -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">مصارف امروز</div>
                                <div class="fs-22 fw-semibold text-danger">
                                    {{ number_format($todayExpenses,2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">برداشت امروز</div>
                                <div class="fs-22 fw-semibold text-warning">
                                    {{ number_format($todayWithdraw,2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profit Today -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-14 mb-1">سود امروز</div>
                                <div class="fs-22 fw-semibold text-success">
                                    {{ number_format($todayProfit,2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- end sales -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>

@endsection