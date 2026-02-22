@extends('backend.master')
@section('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">افزودن مصرف جدید</h4>
            </div> 
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show text-center">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row"> 
            <div class="col-xl-12"> 
                <div class="card"> 
                    <div class="card-body"> 

                        <form action="{{ route('store.expenses') }}" method="post" class="row g-3">
                            @csrf

                            <!-- نوع مصرف -->
                            <div class="form-group col-md-4">
                                <label class="form-label">نوع مصرف:</label>
                                <select name="type" id="typeSelect" class="form-control">
                                    <option value="">انتخاب نوع</option>
                                    <option value="employee">کارمند</option>
                                    <option value="shop">دکان</option>
                                </select>
                            </div>

                            <!-- کارمند -->
                            <div class="form-group col-md-4" id="employeeDiv">
                                <label class="form-label">نام کارمند:</label>
                                <select name="employee_id" id="employeeSelect" class="form-control">
                                    <option value="">انتخاب کارمند</option>
                                    @foreach($employee as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- عنوان مصرف -->
                            <div class="form-group col-md-4">
                                <label class="form-label">عنوان مصرف:</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <!-- مقدار -->
                            <div class="form-group col-md-4">
                                <label class="form-label">مقدار:</label>
                                <input type="number" name="amount" class="form-control">
                            </div>

                            <!-- تاریخ -->
                            <div class="form-group col-md-4">
                                <label class="form-label">تاریخ:</label>
                                <input type="date" name="date" class="form-control">
                            </div>

                            <!-- توضیحات -->
                            <div class="form-group col-md-4">
                                <label class="form-label">توضیحات:</label>
                                <input type="text" name="note" class="form-control">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">ذخیره</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function(){

    $('#typeSelect').change(function(){

        let type = $(this).val();

        if(type === 'shop'){

            // غیرفعال
            $('#employeeSelect').val('');
            $('#employeeSelect').prop('disabled', true);

            // رنگ سرخ
            $('#employeeSelect').addClass('is-invalid');

            // مخفی شدن
            $('#employeeDiv').hide();

        } else {

            $('#employeeSelect').prop('disabled', false);
            $('#employeeSelect').removeClass('is-invalid');
            $('#employeeDiv').show();
        }

    });

});
</script>

@endsection