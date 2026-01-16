<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint; // نضيف الموديل

class ContactController extends Controller
{
    public function index()
    {
        return view('show.contact');
    }

    public function send(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // حفظ البيانات في قاعدة البيانات
        Complaint::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // رسالة نجاح
        return redirect()->route('contact.index')->with('success', '✅ تم إرسال رسالتك بنجاح!');
    }
}