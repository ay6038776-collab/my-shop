<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video; // عشان نتعامل مع جدول الفيديوهات

class VideoController extends Controller
{
    public function videos()
    {
        // دي هتعرض صفحة الفيديوهات العادية
        return view('admin.videos.vido');
    }

    // عرض الفيديوهات من الداتا بيز
    public function video()
    {
        $videos = Video::all();
        return view('admin.videos.vido', compact('videos'));
    }

    // صفحة إضافة فيديو
    public function create()
    {
        return view('admin.videos.create');
    }

    // حفظ الفيديو الجديد
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url'
        ]);

        Video::create([
            'title' => $request->title,
            'youtube_url' => $request->youtube_url
        ]);

        return redirect()->route('videos.vido')->with('success', '✅ تمت إضافة الفيديو بنجاح');
    }
    public function destroy($id)
{
    $video = \App\Models\Video::findOrFail($id);
    $video->delete();

    return redirect()->back()->with('success', '✅ تم حذف الفيديو بنجاح');
}
// صفحة عرض الفيديوهات للعميل
    public function showVideos()
    {
        $videos = Video::all(); // جلب كل الفيديوهات
        return view('show.videos.index', compact('videos')); // توجيه للصفحة الصحيحة
    }

}