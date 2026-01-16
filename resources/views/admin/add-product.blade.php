@extends('layouts.add')
@section('page-title', 'Add Product')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: radial-gradient(circle at top left, #203a43, #2c5364, #0f2027);
        font-family: 'Poppins', sans-serif;
        color: #fff;
    }

    /* Glass effect square card */
   .normal-card {
    width: 500px;
    min-height: 500px; /* بدل height ثابت */
    padding: 35px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    transition: all 0.3s ease-in-out;
}
    .normal-card:hover {
        transform: scale(1.03);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.6);
    }

    label {
        color: #ffd86b;
        font-weight: 600;
    }

    .input-box {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        color: #fff;
        padding: 10px;
    }

    .input-box::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .btn-custom {
        background: linear-gradient(135deg, #324b67, #446b8a);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background: linear-gradient(135deg, #446b8a, #5d8db1);
        color: #ffe07a;
        transform: scale(1.05);
    }

    h3 {
        color: #ffe07a;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
    }
</style>

<div class="center-container">
    <div class="card normal-card">
        <div class="mb-4 text-center">
            <h3 class="fw-bold text-uppercase">Add Product</h3>
            <p class="text-light opacity-75">Please enter your product details below:</p>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-2">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control input-box" placeholder="Enter product name..." required>
            </div>

            <div class="mb-2">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control input-box" placeholder="Enter product price..." required>
            </div>

            <div class="mb-2">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control input-box" rows="2" placeholder="Enter product description..."></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control input-box" placeholder="Enter available units..." required>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" class="form-control input-box" placeholder="Enter unique code..." required>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Discount%</label>
                <input type="number" name="discount_percentage" class="form-control input-box" placeholder="Enter discount %"
                    min="0" max="100"  required>

            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="img" class="form-control input-box">
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-custom px-4">
                    <i class="bi bi-arrow-left-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-custom px-4">
                    <i class="bi bi-plus-circle"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection