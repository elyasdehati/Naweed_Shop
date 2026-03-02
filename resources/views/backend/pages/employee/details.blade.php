@extends('backend.master')
@section('body')

<div class="content mt-4">
    <div class="container-xxl">

        <div class="row">

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

                        <a href="{{ route('all.employee') }}" class="btn btn-secondary mt-3">
                            بازگشت
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection