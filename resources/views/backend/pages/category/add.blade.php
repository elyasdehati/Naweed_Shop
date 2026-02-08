@extends('backend.master')
@section('body')

<div class="content">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">اضافه کردن دسته بندی</h4>
            </div>
        </div>

        {{-- Server-side error alert with close button --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        <form action="{{ route('store.category') }}" method="post" class="row g-3" id="myForm" style="width:100%; max-width:400px;">
                            @csrf

                            <div class="form-group col-12 text-center">
                                <label for="name" class="form-label">نام دسته بندی محصول</label>
                                <input type="text" class="form-control" name="name" placeholder="نام دسته بندی را وارد کنید">
                            </div>

                            <div class="col-12 text-center mt-3">
                                <button class="btn btn-primary" type="submit">ذخیره</button>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    </div> <!-- container-fluid -->
</div>


@endsection