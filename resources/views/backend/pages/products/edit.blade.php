@extends('backend.master')
@section('body')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">اضافه کردن محصول</h4>
                            </div>
                        </div>

                         {{-- Server-side validation errors --}}
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

                        <!-- Form Validation -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div><!-- end card header -->
        
        <div class="card-body">
            <form action="{{ route('update.products', $product->id) }}" method="post" class="row g-3" id="myForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group col-md-4">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <label for="lname" class="form-label">دسته بندی <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control">
                    <option value="">انتخاب دسته بندی</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="name" class="form-label">نام محصول<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                </div>

                <div class="form-group col-md-4">
                    <label for="quantity" class="form-label">مقدار اجناس<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}"min="1" required>
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label" for="code">کد:<span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control" value="{{ $product->code }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="price">قیمت خرید: </label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="note">نوت:</label>
                    <textarea class="form-control" name="note" rows="1" placeholder="Enter Notes">{{ $product->note }}</textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label">عکس:</label>
                    <input name="image" type="file" class="upload-input-file form-control">
                </div>

                <div class="col-12">
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