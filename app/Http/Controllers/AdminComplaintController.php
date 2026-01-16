<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminComplaintController extends Controller
{
    // عرض كل الشكاوى
    public function index()
    {
        // نجيب كل الشكاوى من قاعدة البيانات
        $complaints = Complaint::latest()->paginate(10);

        // نبعته للصفحة
        return view('admin.complaints.index', compact('complaints'));
    }

    // عرض تفاصيل شكوى واحدة
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('admin.complaints.show', compact('complaint'));
    }

    // حذف شكوى
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('admin.complaints.index')->with('success', '✅ تم حذف الشكوى بنجاح!');
    }
}