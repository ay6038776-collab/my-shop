@extends('layouts.app')

@section('title', 'Complaint Details')

@section('content')

<style>
body {
  background: linear-gradient(135deg, #1e3a8a, #0f172a);
  font-family: 'Poppins', sans-serif;
  color: #fff;
  overflow-x: hidden;
}

/* ===== الصفحة ===== */
.page-content {
  position: relative;
  min-height: 100vh;
  padding: 60px 15px;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* ===== الكارت ===== */
.card {
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.25);
  width: 100%;
  max-width: 750px;
  padding: 30px;
  transition: 0.4s;
  animation: fadeInUp 0.6s ease;
}

/* ===== مراحل العرض ===== */
.steps {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
  position: relative;
}
.steps::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 5%;
  right: 5%;
  height: 3px;
  background: rgba(255, 255, 255, 0.15);
  z-index: 0;
  transform: translateY(-50%);
}
.step {
  position: relative;
  z-index: 2;
  text-align: center;
  width: 25%;
}
.step .circle {
  width: 36px;
  height: 36px;
  margin: 0 auto 8px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.2);
  display: flex;
  justify-content: center;
  align-items: center;
  color: #a5b4fc;
  font-weight: 600;
  transition: 0.3s;
}
.step.active .circle {
  background: linear-gradient(135deg, #60a5fa, #2563eb);
  color: #fff;
  box-shadow: 0 0 15px rgba(96,165,250,0.5);
}
.step small {
  color: #cbd5e1;
  font-size: 13px;
}

/* ===== المحتوى ===== */
.stage {
  display: none;
  animation: fadeIn 0.5s ease;
}
.stage.active {
  display: block;
}

label {
  font-weight: 600;
  color: #cbd5e1;
}
p {
  background: rgba(255,255,255,0.08);
  padding: 12px 15px;
  border-radius: 10px;
  color: #f1f5f9;
}

/* ===== الأزرار ===== */
.btn-nav {
  background: linear-gradient(135deg, #2563eb, #1d4ed8);
  border: none;
  color: #fff;
  padding: 10px 25px;
  border-radius: 10px;
  transition: 0.3s;
  font-weight: 600;
}
.btn-nav:hover {
  opacity: 0.9;
  transform: translateY(-2px);
}
.btn-nav:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

/* ===== حركات ===== */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ===== الموبايل ===== */
@media(max-width: 768px) {
  .steps small { font-size: 11px; }
  .btn-nav { font-size: 13px; padding: 8px 18px; }
}
</style>

<div class="page-content">
  <div class="card">

    <!-- مراحل التقدم -->
    <div class="steps">
      <div class="step" data-step="1">
        <div class="circle">1</div>
        <small>Sender Info</small>
      </div>
      <div class="step" data-step="2">
        <div class="circle">2</div>
        <small>Complaint</small>
      </div>
      <div class="step" data-step="3">
        <div class="circle">3</div>
        <small>Status</small>
      </div>
      <div class="step" data-step="4">
        <div class="circle">4</div>
        <small>Finish</small>
      </div>
    </div>

    <!-- المرحلة 1 -->
    <div class="stage active" data-stage="1">
      <h4 class="mb-3">👤 Sender Information</h4>
      <label>Name:</label>
      <p>{{ $complaint->name }}</p>

      <label>Email:</label>
      <p>{{ $complaint->email }}</p>
    </div>

    <!-- المرحلة 2 -->
    <div class="stage" data-stage="2">
      <h4 class="mb-3">📝 Complaint Content</h4>
      <label>Subject:</label>
      <p>{{ $complaint->subject }}</p>

      <label>Message:</label>
      <p>{{ $complaint->message }}</p>
    </div>

    <!-- المرحلة 3 -->
    <div class="stage" data-stage="3">
      <h4 class="mb-3">📊 Complaint Status</h4>
      <label>Status:</label>
      <p>
        {{ $complaint->status ?? 'Pending Review' }}
      </p>

      <label>Created At:</label>
      <p>{{ $complaint->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <!-- المرحلة 4 -->
    <div class="stage" data-stage="4">
      <h4 class="mb-4">✅ Review Complete</h4>
      <p>All complaint details have been reviewed successfully.</p>

      <div class="text-center mt-4">
        <a href="{{ route('admin.complaints.index') }}" class="btn-nav">
          <i class="bi bi-arrow-left"></i> Back to Complaints
        </a>
      </div>
    </div>

    <!-- أزرار التنقل -->
    <div class="d-flex justify-content-between mt-4">
      <button class="btn-nav" id="prevBtn" disabled>← Previous</button>
      <button class="btn-nav" id="nextBtn">Next →</button>
    </div>

  </div>
</div>

<!-- سكريبت التفاعل -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const stages = document.querySelectorAll(".stage");
  const steps = document.querySelectorAll(".step");
  let current = 0;

  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");

  function updateSteps() {
    steps.forEach((s, i) => {
      s.classList.toggle("active", i <= current);
    });
    stages.forEach((stg, i) => {
      stg.classList.toggle("active", i === current);
    });
    prevBtn.disabled = current === 0;
    nextBtn.textContent = current === stages.length - 1 ? "Finish" : "Next →";
  }

  nextBtn.addEventListener("click", () => {
    if (current < stages.length - 1) {
      current++;
      updateSteps();
    } else {
      nextBtn.disabled = true;
    }
  });

  prevBtn.addEventListener("click", () => {
    if (current > 0) {
      current--;
      updateSteps();
    }
  });

  updateSteps();
});
</script>

@endsection