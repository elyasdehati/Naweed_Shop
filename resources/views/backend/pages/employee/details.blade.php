@extends('backend.master')
@section('body')

<div class="content mt-4">
    <div class="container-xxl">

        <div class="row">

            <!-- Left Side - Employee Info -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">جزئیات کارمند</h4>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">نام</th>
                                <td>{{ $emp->name }}</td>
                            </tr>

                            <tr>
                                <th>تخلص</th>
                                <td>{{ $emp->lname }}</td>
                            </tr>

                            <tr>
                                <th>ولایت</th>
                                <td>{{ $emp->province }}</td>
                            </tr>

                            <tr>
                                <th>ایمیل</th>
                                <td>{{ $emp->email }}</td>
                            </tr>

                            <tr>
                                <th>شماره تماس</th>
                                <td>{{ $emp->phone }}</td>
                            </tr>

                            <tr>
                                <th>نمبر تذکره</th>
                                <td>{{ $emp->national_id }}</td>
                            </tr>
                        </table>

                        <h5 class="mb-3">گزارش ماه جاری</h5>

                        <table class="table table-bordered">
                            <tr>
                                <th>فروش در حال انتظار</th>
                                <td>{{ number_format($pending) }}</td>
                            </tr>

                            <tr>
                                <th>فروش تکمیل شده</th>
                                <td>{{ number_format($completed) }}</td>
                            </tr>

                            <tr>
                                <th>فروش لغو شده</th>
                                <td>{{ number_format($cancelled) }}</td>
                            </tr>

                            <tr>
                                <th>سود </th>
                                <td>{{ number_format($profit) }}</td>
                            </tr>

                            <tr>
                                <th>مصارف کارمند</th>
                                <td>{{ number_format($employeeCharges) }}</td>
                            </tr>

                            <tr>
                                <th>برداشت ها</th>
                                <td>{{ number_format($withdraw) }}</td>
                            </tr>

                            <tr>
                                <th>اسپانسر</th>
                                <td>{{ number_format($sponsor) }}</td>
                            </tr>
                        </table>

                        <a href="{{ route('all.employee') }}" class="btn btn-secondary mt-3">
                            بازگشت
                        </a>

                    </div>
                </div>
            </div>


            <!-- Right Side - Employee Image -->
            <div class="col-md-4 my-auto">
                <div class="card">
                    <div class="card-body text-center">

                        @if($emp->photo)
                            <img src="{{ asset($emp->photo) }}" 
                                 class="img-fluid rounded" 
                                 style="max-height:350px; object-fit:cover;">
                        @else
                            <p>عکس موجود نیست</p>
                        @endif

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection