@extends('layouts.app')
@section('title', 'Add Product - My Shop Admin')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - My Shop Admin</title>
    <link rel="icon" href="{{ asset('MYshop5.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<style>
:root {
    --primary: #4f46e5;
    --primary-light: #818cf8;
    --success: #10b981;
    --danger: #ef4444;
    --dark: #0f172a;
    --gray: #64748b;
    --light-gray: #e2e8f0;
    --bg: #f1f5f9;
    --white: #ffffff;
}

* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--dark); }

.topbar {
    background: var(--white);
    padding: 14px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 100;
}
.brand { display: flex; align-items: center; gap: 12px; }
.brand img { width: 42px; height: 42px; border-radius: 10px; }
.brand h2 { font-size: 1.15rem; font-weight: 700; color: var(--primary); }
.back-btn {
    padding: 8px 16px; border-radius: 8px; background: var(--bg);
    border: 1px solid var(--light-gray); color: var(--dark); text-decoration: none;
    font-size: 0.82rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px;
}
.back-btn:hover { background: var(--primary); color: white; border-color: var(--primary); }

.main { padding: 24px 28px; }

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
.page-header h1 { font-size: 1.35rem; font-weight: 700; color: var(--dark); }
.page-header p { color: var(--gray); font-size: 0.82rem; margin-top: 2px; }

.panel {
    background: var(--white);
    border-radius: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    overflow: hidden;
    max-width: 800px;
}
.panel-head {
    padding: 18px 24px;
    border-bottom: 1px solid var(--light-gray);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.panel-head h3 { font-size: 0.95rem; font-weight: 600; display: flex; align-items: center; gap: 8px; color: var(--dark); }
.panel-head h3 i { color: var(--primary); }

.form-body { padding: 28px 24px; }

/* ALERT */
.alert {
    padding: 12px 16px; border-radius: 10px; font-size: 0.85rem;
    margin-bottom: 18px; display: flex; align-items: center; gap: 10px;
}
.alert-danger { background: #fee2e2; color: #991b1b; }

/* FORM GRID */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.full { grid-column: 1 / -1; }

.form-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 5px;
}
.form-label i { color: var(--primary); font-size: 0.75rem; }

.form-control {
    padding: 10px 14px;
    border: 1.5px solid var(--light-gray);
    border-radius: 10px;
    font-size: 0.85rem;
    font-family: 'Poppins';
    color: var(--dark);
    background: var(--white);
    transition: all 0.3s;
    outline: none;
}
.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
}
.form-control::placeholder { color: #94a3b8; }

textarea.form-control { resize: vertical; min-height: 80px; }

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: calc(100% - 12px) center;
    padding-right: 36px;
}

/* IMAGE UPLOAD */
.img-upload-area {
    border: 2px dashed var(--light-gray);
    border-radius: 12px;
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: var(--bg);
}
.img-upload-area:hover { border-color: var(--primary); background: rgba(79,70,229,0.04); }
.img-upload-area i { font-size: 2rem; color: var(--light-gray); margin-bottom: 8px; }
.img-upload-area p { font-size: 0.82rem; color: var(--gray); margin: 0; }
.img-upload-area p span { color: var(--primary); font-weight: 600; }
.img-upload-area input[type="file"] { display: none; }

.img-preview-wrap {
    display: flex; gap: 10px; flex-wrap: wrap; margin-top: 12px;
}
.img-preview {
    width: 72px; height: 72px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid var(--light-gray);
}
.img-preview-placeholder {
    width: 72px; height: 72px;
    border-radius: 10px;
    border: 2px dashed var(--light-gray);
    display: flex; align-items: center; justify-content: center;
    color: var(--gray); font-size: 1.5rem;
}

/* TOGGLE SWITCH */
.toggle-wrap { display: flex; align-items: center; gap: 10px; }
.toggle-label { font-size: 0.8rem; color: var(--gray); font-weight: 500; }
.toggle-switch {
    position: relative; width: 44px; height: 24px;
}
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider {
    position: absolute; inset: 0;
    background: var(--light-gray);
    border-radius: 24px;
    cursor: pointer;
    transition: 0.3s;
}
.toggle-slider::before {
    content: '';
    position: absolute;
    width: 18px; height: 18px;
    left: 3px; bottom: 3px;
    background: white;
    border-radius: 50%;
    transition: 0.3s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}
.toggle-switch input:checked + .toggle-slider { background: var(--primary); }
.toggle-switch input:checked + .toggle-slider::before { transform: translateX(20px); }

/* HINT TEXT */
.form-hint { font-size: 0.72rem; color: var(--gray); margin-top: 2px; }

/* ACTION FOOTER */
.form-actions {
    padding: 16px 24px;
    border-top: 1px solid var(--light-gray);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fafafa;
}

.btn {
    padding: 10px 22px; border-radius: 10px; font-size: 0.85rem;
    font-weight: 600; cursor: pointer; transition: all 0.3s;
    border: none; display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Poppins'; text-decoration: none;
}
.btn-primary { background: var(--primary); color: white; }
.btn-primary:hover { background: #3730a3; }
.btn-outline { background: transparent; border: 1.5px solid var(--light-gray); color: var(--gray); }
.btn-outline:hover { background: var(--bg); color: var(--dark); }

@media (max-width: 600px) {
    .form-grid { grid-template-columns: 1fr; }
    .topbar { padding: 12px 16px; }
    .main { padding: 16px; }
}
</style>

@section('content')
<!-- TOPBAR -->
<div class="topbar">
    <div class="brand">
        <img src="{{ asset('MYshop5.png') }}" alt="My Shop">
        <h2>My Shop Admin</h2>
    </div>
    <a href="{{ route('products.index') }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Back to Products
    </a>
</div>

<!-- MAIN -->
<div class="main">
    <div class="page-header">
        <div>
            <h1>Add Product</h1>
            <p>Fill in the product details below to add it to your catalog</p>
        </div>
    </div>

    <!-- ALERTS -->
    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul style="margin:4px 0 0 16px;padding:0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="panel">
        <div class="panel-head">
            <h3><i class="fa-solid fa-plus-circle"></i> Product Information</h3>
            <span style="font-size:0.75rem;color:var(--gray);">All fields marked * are required</span>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf

            <div class="form-body">
                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group full">
                        <label class="form-label"><i class="fa-solid fa-box-open"></i> Product Name *</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}"
                               placeholder="e.g. Wireless Bluetooth Headphones" required>
                    </div>

                    <!-- Price & Discount -->
                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-tag"></i> Price (EGP) *</label>
                        <input type="number" name="price" class="form-control"
                               value="{{ old('price') }}"
                               placeholder="0.00" min="0" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-percent"></i> Discount %</label>
                        <input type="number" name="discount_percentage" class="form-control"
                               value="{{ old('discount_percentage', 0) }}"
                               placeholder="0" min="0" max="100">
                        <span class="form-hint">Leave at 0 for no discount</span>
                    </div>

                    <!-- Description -->
                    <div class="form-group full">
                        <label class="form-label"><i class="fa-solid fa-align-left"></i> Description</label>
                        <textarea name="description" class="form-control"
                                  rows="3"
                                  placeholder="Describe your product features, materials, and usage...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Stock & SKU -->
                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-boxes-stacked"></i> Stock Quantity *</label>
                        <input type="number" name="stock" class="form-control"
                               value="{{ old('stock') }}"
                               placeholder="0" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-barcode"></i> SKU *</label>
                        <input type="text" name="sku" class="form-control"
                               value="{{ old('sku') }}"
                               placeholder="e.g. WBH-001" required>
                        <span class="form-hint">Unique product code</span>
                    </div>

                    <!-- is_new toggle -->
                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-sparkles"></i> Mark as New</label>
                        <div class="toggle-wrap">
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Enable New badge on this product</span>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group full">
                        <label class="form-label"><i class="fa-solid fa-image"></i> Product Images</label>
                        <div class="img-upload-area" id="imgUploadArea">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <p>Click or drag images here to upload<br><span>Supports JPG, PNG, WEBP (max 10 images)</span></p>
                            <input type="file" name="img[]" id="imgInput" multiple accept="image/*">
                        </div>
                        <div class="img-preview-wrap" id="imgPreviewWrap"></div>
                        <span class="form-hint">First image will be used as the main product thumbnail</span>
                    </div>
                </div>
            </div>

            <!-- FOOTER ACTIONS -->
            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn btn-outline">
                    <i class="fa-solid fa-xmark"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Add Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Image preview
    const uploadArea = document.getElementById('imgUploadArea');
    const imgInput = document.getElementById('imgInput');
    const previewWrap = document.getElementById('imgPreviewWrap');

    uploadArea.addEventListener('click', () => imgInput.click());

    imgInput.addEventListener('change', function () {
        previewWrap.innerHTML = '';
        const files = Array.from(this.files).slice(0, 4);
        if (files.length > 0) {
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-preview';
                    img.onerror = () => { img.src = 'https://via.placeholder.com/72?text=Error'; };
                    previewWrap.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
});
</script>

@endsection