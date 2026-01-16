@extends('layouts.app')

@section('title', 'Complaint Details')
@section('content')
<style>
/* ==== خلفية متدرجة تفاعلية ==== */
body {
  background: linear-gradient(135deg, #dbeafe, #f0f9ff, #e0f7f6);
  font-family: 'Poppins', sans-serif;
  color: #1e293b;
  overflow-x: hidden;
}

/* ==== حركات دخول الصفحة ==== */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ==== الصفحة ==== */
.page-content {
  position: relative;
  z-index: 2;
  padding: 50px 40px;
  animation: fadeInUp 0.7s ease-out;
}

/* ==== العنوان ==== */
h2 {
  text-align: center;
  font-weight: 700;
  font-size: 32px;
  color: #1d4ed8;
  margin-bottom: 40px;
  letter-spacing: 1px;
  animation: fadeInUp 0.6s ease-out;
}

/* ==== الكارد ==== */
.card {
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.55);
  backdrop-filter: blur(10px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  border: 1px solid rgba(255,255,255,0.3);
  transition: 0.4s ease;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 32px rgba(59,130,246,0.25);
}

/* ==== الجدول ==== */
.table-responsive {
  border-radius: 16px;
  overflow-x: auto;
}
.table {
  width: 100%;
  border-collapse: collapse;
  color: #1e293b;
  font-size: 15px;
}
.table thead th {
  background: linear-gradient(135deg, #2563eb, #60a5fa);
  color: white;
  text-transform: uppercase;
  padding: 14px;
  border-bottom: none;
  font-weight: 600;
}
.table tbody td {
  background: rgba(255,255,255,0.8);
  padding: 12px 10px;
  border-bottom: 1px solid #e2e8f0;
  vertical-align: middle;
  transition: background 0.3s ease;
}
.table-hover tbody tr:hover td {
  background: rgba(219,234,254,0.9);
}

/* ==== الأزرار ==== */
.btn {
  border: none;
  padding: 8px 14px;
  border-radius: 10px;
  font-weight: 600;
  transition: 0.3s ease;
  cursor: pointer;
  font-size: 14px;
}
.btn-info {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  color: white;
  box-shadow: 0 4px 12px rgba(59,130,246,0.3);
}
.btn-info:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 18px rgba(59,130,246,0.4);
}
.btn-danger {
  background: linear-gradient(135deg, #ef4444, #b91c1c);
  color: white;
  box-shadow: 0 4px 12px rgba(239,68,68,0.25);
}
.btn-danger:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 18px rgba(239,68,68,0.4);
}

/* ==== الرسائل ==== */
.alert-success {
  background: rgba(187, 247, 208, 0.9);
  color: #166534;
  border: none;
  border-radius: 10px;
  padding: 12px 20px;
  font-weight: 400;
  animation: fadeInUp 0.6s ease-out;
}

/* ==== تأثير حركة عند مرور الفأرة ==== */
tr {
  transition: transform 0.2s ease;
}
tr:hover {
  transform: scale(1.01);
}

/* ==== استجابة الموبايل ==== */
@media (max-width: 768px) {
  .page-content { padding: 10px; }
  .table th, .table td { font-size: 7px; padding: 10px; }
  .btn { font-size: 12px; padding: 6px 10px; }
  h2 { font-size: 20px; }
}
</style>

<div class="container-fluid page-content">
  <h2>📬 Customer Complaints</h2>

  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif

  <div class="card p-3">
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($complaints as $index => $complaint)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $complaint->name }}</td>
              <td>{{ $complaint->email }}</td>
              <td>{{ $complaint->subject }}</td>
              <td style="max-width: 220px;">{{ Str::limit($complaint->message, 50) }}</td>
              <td>{{ $complaint->created_at->format('Y-m-d H:i') }}</td>
              <td>
                <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-info btn-sm">View</a>
                <form action="{{ route('admin.complaints.destroy', $complaint->id) }}" method="POST" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-muted">No complaints yet 🙌</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <div class="d-flex justify-content-center mt-3">
        {{ $complaints->links() }}
      </div>
    </div>
  </div>
</div>
@endsection