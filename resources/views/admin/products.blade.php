@extends('layouts.app')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<style>
/* ===== خلفية متدرجة متحركة ===== */
body {
  background: linear-gradient(270deg, #dbeafe, #e0f2fe, #f1f5f9);
  background-size: 600% 600%;
  animation: gradientMove 12s ease infinite;
  font-family: 'Poppins', sans-serif;
  color: #1e293b;
}
@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* ===== دخول الصفحة بأنيميشن ===== */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ===== الصفحة ===== */
.page-content {
  padding: 50px;
  animation: fadeUp 0.6s ease-out;
}

/* ===== الهيدر ===== */
.header-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 40px;
  animation: fadeUp 0.7s ease-out;
}

.header-bar h1 {
  font-size: 32px;
  font-weight: 700;
  color: #0f172a;
  text-shadow: 1px 1px 2px #ffffff60;
  position: relative;
}
.header-bar h1::after {
  content: "";
  position: absolute;
  bottom: -6px;
  left: 0;
  width: 80px;
  height: 3px;
  background: linear-gradient(90deg, #3b82f6, #60a5fa);
  border-radius: 4px;
}

/* ===== الأزرار ===== */
.btn {
  padding: 9px 6px;
  border-radius: 50px;
  cursor: pointer;
  border: 0;
  background-color: white;
  box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  font-size: 15px;
  transition: all 0.5s ease;
}

.btn-primary {
  background: linear-gradient(135deg, #2563eb, #1d4ed8);
  color: white;
  box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
}
.btn-primary:hover {
  letter-spacing: 3px;
  background-color: hsl(261deg 80% 48%);
  color: hsl(0, 0%, 100%);
  box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
}

.btn-danger {
  background: linear-gradient(135deg, #ef4444, #b91c1c);
  color: white;
  box-shadow: 0 6px 20px rgba(239,68,68,0.3);
}
.btn-danger:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 8px 25px rgba(239,68,68,0.5);
}

.btn-outline {
  background: rgba(255, 255, 255, 0.45);
  border: 2px solid #2563eb;
  color: #2563eb;
  backdrop-filter: blur(8px);
}
.btn-outline:hover {
  background: #2563eb;
  color: white;
  transform: translateY(-2px);
}

/* ===== البحث ===== */
.search-box {
  display: flex;
  gap: 10px;
}
.search-box input {
  background: rgba(255,255,255,0.8);
  border: 2px solid #cbd5e1;
  border-radius: 12px;
  padding: 10px 16px;
  outline: none;
  transition: all 0.3s ease;
  font-weight: 500;
  color: #0f172a;
  box-shadow: inset 2px 2px 5px #cbd5e1, inset -2px -2px 5px #ffffff;
}
.search-box input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 12px #60a5fa80;
}

/* ===== الجدول ===== */
.table-responsive {
  width: 100%;
  overflow-x: auto;
  background: rgba(255,255,255,0.7);
  border-radius: 18px;
  box-shadow: 8px 8px 20px rgba(0,0,0,0.08), -4px -4px 10px rgba(255,255,255,0.6);
  backdrop-filter: blur(12px);
  animation: fadeUp 0.8s ease-out;
}

.table {
  width: 100%;
  table-layout: auto;
  border-collapse: collapse;
  color: #1e293b;
  font-size: 16px;
}

.table thead th {
  background: linear-gradient(135deg, #2563eb, #60a5fa);
  color: white;
  text-transform: uppercase;
  padding: 18px;
}

.table tbody tr {
  transition: all 0.25s ease;
  animation: fadeUp 0.6s ease both;
}
.table tbody tr:hover {
  background: rgba(219,234,254,0.7);
  transform: scale(1.01);
  box-shadow: 0 4px 16px rgba(59,130,246,0.15);
}
.table td, .table th {
  padding: 18px 14px;
  border-bottom: 1px solid #cbd5e1;
  vertical-align: middle;
  white-space: normal;
}

/* ===== الصور ===== */
.product-img {
  width: 100px;
  height: 100px;
  border-radius: 18px;
  object-fit: cover;
  border: 4px solid #e5e7eb;
  transition: all 0.3s ease;
  cursor: pointer;
}
.product-img:hover {
  transform: scale(1.1) rotate(3deg);
  box-shadow: 0 10px 25px rgba(37,99,235,0.3);
}

/* ===== Action buttons ===== */
.action-buttons {
  display: flex;
  justify-content: center;
  gap: 15px;
}

/* ===== Checkbox ===== */
input[type="checkbox"] {
  width: 18px;
  height: 18px;
  accent-color: #2563eb;
  cursor: pointer;
  border-radius: 6px;
}

/* ===== الزر العائم ===== */
.fab {
  position: fixed;
  bottom: 30px;
  right: 30px;
  background: linear-gradient(135deg, #2563eb, #1d4ed8);
  color: white;
  font-size: 22px;
  border-radius: 50%;
  width: 55px;
  height: 55px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 8px 25px rgba(37,99,235,0.4);
  transition: all 0.3s ease;
  z-index: 99;
}
.fab:hover {
  transform: scale(1.1) rotate(8deg);
  box-shadow: 0 12px 30px rgba(37,99,235,0.6);
}

/* ===== Responsive ===== */
@media (max-width: 1200px) {
  .table { font-size: 14px; }
  .table thead th, .table td { padding: 12px; }
  .product-img { width: 70px; height: 70px; }
}
@media (max-width: 768px) {
  .page-content { padding: 20px; }
  .header-bar { flex-direction: column; align-items: flex-start; gap: 10px; }
  .btn { font-size: 12px !important; padding: 8px 12px !important; }
}
</style>

<div class="container-fluid page-content">
  <div class="header-bar">
    <h1>📦 Products</h1>
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="🔍 Search products...">
      <form id="bulkDelete" action="{{ route('bulkDelete') }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <input type="hidden" id="ids">
        <button type="submit" class="btn btn-danger">🗑 Delete Selected</button>
      </form>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table text-center align-middle" id="productsTable">
      <thead>
        <tr>
          <th><input type='checkbox' id="select-all"></th>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Image</th>
          <th>Description</th>
          <th>Stock</th>
          <th>SKU</th>
          <th>Discount %</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
        <tr>
          <td><input type="checkbox" name="ids[]" class="select-item" value="{{ $product->id }}"></td>
          <td>{{ $product->id }}</td>
          <td>{{ $product->name }}</td>
          <td>${{ number_format($product->price, 2) }}</td>
          <td>
            @if($product->img)
              <img src="{{ asset('img/' . $product->img) }}" alt="{{ $product->name }}" class="product-img">
            @else
              <span class="text-muted">No image</span>
            @endif
          </td>
          <td>{{ Str::limit($product->description, 60) }}</td>
          <td>{{ $product->stock }}</td>
          <td>{{ $product->sku }}</td>
          <td>{{ $product->discount_percentage ?? 0 }}%</td>
          <td>
            <div class="action-buttons">
              <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline btn-sm">✏ Edit</a>
              <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="10" class="text-muted">No products found</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <a href="{{ route('products.create') }}" class="fab">+</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const selectAll = document.getElementById('select-all');
  const checkboxes = document.querySelectorAll('.select-item');
  const bulkDeleteForm = document.getElementById('bulkDelete');
  const idsInput = document.getElementById('ids');
  const searchInput = document.getElementById('searchInput');
  const rows = document.querySelectorAll('#productsTable tbody tr');

  selectAll.addEventListener('change', function () {
    checkboxes.forEach(cb => cb.checked = selectAll.checked);
  });

  bulkDeleteForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const selectedIds = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
    if (selectedIds.length === 0) return alert('Please select at least one product.');
    if (!confirm('Are you sure you want to delete selected products?')) return;

    fetch(this.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ ids: selectedIds, _method: 'DELETE' })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Selected products deleted successfully.');
        location.reload();
      } else alert('Something went wrong.');
    })
    .catch(err => alert('Error deleting products.'));
  });

  searchInput.addEventListener('keyup', function () {
    const term = this.value.toLowerCase();
    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(term) ? '' : 'none';
    });
  });
});
</script>

@endsection