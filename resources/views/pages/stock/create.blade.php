@extends('layouts.app')

@section('title', 'Stock Create')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Stock</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('stock.index') }}">Stocks</a></div>
                    <div class="breadcrumb-item">Create Stock</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Stock</h2>

                <div class="card">
                    <form action="{{ route('stock.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Transaction Time</label>
                                <input type="datetime"
                                    class="form-control @error('transaction_time')
                                is-invalid
                            @enderror"
                                    name="transaction_time" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:m:i') }}" readonly>
                                @error('transaction_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="from-group">
                                <div class="form-group">
                                    <label for="product_id">Nama Produk <span class="text-danger"></span></label>
                                    <select class="select2 form-control" name="product_id" id="product_id">
                                        <option value="" selected disabled>Pilih Nama Produk</option>
                                        @foreach(\App\Models\Product::all() as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number"
                                    class="form-control @error('quantity')
                                is-invalid
                            @enderror"
                                    name="quantity">
                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        {{-- <div class="form-group">
                                <label>Cost Price</label>
                                <input type="number"
                                    class="form-control @error('cost_price')
                                is-invalid
                            @enderror"
                                    name="cost_price">
                                @error('cost_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-group">
                                <label class="form-label">Category</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="produk1" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Produk 1</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="produk2" class="selectgroup-input">
                                        <span class="selectgroup-button">Produk 2</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="produk3" class="selectgroup-input">
                                        <span class="selectgroup-button">Produk 3</span>
                                    </label>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
        console.log('');
        $('.select2').select2();
        });
    </script>
@endpush
