<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use App\Models\Quiz; // Import the Quiz model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorialController extends Controller
{
    public function index() { $tutorials = Tutorial::with('preQuiz', 'postQuiz')->orderBy('order')->paginate(10); return view('admin.tutorials.index', compact('tutorials')); }
    public function create() { $quizzes = Quiz::orderBy('title')->get(); return view('admin.tutorials.create', compact('quizzes')); }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'pre_quiz_id' => 'nullable|exists:quizzes,id',
            'post_quiz_id' => 'nullable|exists:quizzes,id',
            'content_type' => 'required|in:text,image,video,mixed',
            'content_text' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_url' => 'nullable|url|max:2048',
            'summary' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_public' => 'boolean', // Checkbox value
        ]);

        $imagePath = null;
        $contentText = null;
        $videoUrl = null;

        switch ($validatedData['content_type']) {
            case 'text':
                $contentText = $validatedData['content_text'];
                break;
            case 'image':
                if ($request->hasFile('image')) { $imagePath = $request->file('image')->store('tutorials/images', 'public'); }
                break;
            case 'video':
                $videoUrl = $validatedData['video_url'];
                break;
            case 'mixed':
                $contentText = $validatedData['content_text'];
                if ($request->hasFile('image')) { $imagePath = $request->file('image')->store('tutorials/images', 'public'); }
                $videoUrl = $validatedData['video_url'];
                break;
        }

        Tutorial::create([
            'title' => $validatedData['title'],
            'content_type' => $validatedData['content_type'],
            'content_text' => $contentText,
            'image_path' => $imagePath,
            'video_url' => $videoUrl,
            'summary' => $validatedData['summary'],
            'order' => $validatedData['order'] ?? 0,
            'is_public' => $request->has('is_public'), // Check if checkbox was ticked
            'pre_quiz_id' => $validatedData['pre_quiz_id'],
            'post_quiz_id' => $validatedData['post_quiz_id'],
        ]);
        return redirect()->route('admin.tutorials.index')->with('success', 'Tutorial created successfully!');
    }
    public function show(Tutorial $tutorial) { $tutorial->load('preQuiz', 'postQuiz'); return view('admin.tutorials.show', compact('tutorial')); }
    public function edit(Tutorial $tutorial) { $quizzes = Quiz::orderBy('title')->get(); $tutorial->load('preQuiz', 'postQuiz'); return view('admin.tutorials.edit', compact('tutorial', 'quizzes')); }
    public function update(Request $request, Tutorial $tutorial)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'pre_quiz_id' => 'nullable|exists:quizzes,id',
            'post_quiz_id' => 'nullable|exists:quizzes,id',
            'content_type' => 'required|in:text,image,video,mixed',
            'content_text' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_url' => 'nullable|url|max:2048',
            'summary' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_public' => 'boolean',
        ]);

        $imagePath = $tutorial->image_path;
        $contentText = $tutorial->content_text;
        $videoUrl = $tutorial->video_url;

        switch ($validatedData['content_type']) {
            case 'text':
                $contentText = $validatedData['content_text'];
                $imagePath = null; $videoUrl = null;
                if ($tutorial->image_path) Storage::disk('public')->delete($tutorial->image_path);
                break;
            case 'image':
                if ($request->hasFile('image')) {
                    if ($tutorial->image_path) Storage::disk('public')->delete($tutorial->image_path);
                    $imagePath = $request->file('image')->store('tutorials/images', 'public');
                }
                $contentText = null; $videoUrl = null;
                break;
            case 'video':
                $videoUrl = $validatedData['video_url'];
                $contentText = null; $imagePath = null;
                if ($tutorial->image_path) Storage::disk('public')->delete($tutorial->image_path);
                break;
            case 'mixed':
                $contentText = $validatedData['content_text'];
                if ($request->hasFile('image')) {
                    if ($tutorial->image_path) Storage::disk('public')->delete($tutorial->image_path);
                    $imagePath = $request->file('image')->store('tutorials/images', 'public');
                }
                $videoUrl = $validatedData['video_url'];
                break;
        }

        $tutorial->update([
            'title' => $validatedData['title'],
            'content_type' => $validatedData['content_type'],
            'content_text' => $contentText,
            'image_path' => $imagePath,
            'video_url' => $videoUrl,
            'summary' => $validatedData['summary'],
            'order' => $validatedData['order'] ?? 0,
            'is_public' => $request->has('is_public'),
            'pre_quiz_id' => $validatedData['pre_quiz_id'],
            'post_quiz_id' => $validatedData['post_quiz_id'],
        ]);
        return redirect()->route('admin.tutorials.index')->with('success', 'Tutorial updated successfully!');
    }
    public function destroy(Tutorial $tutorial)
    {
        if ($tutorial->image_path) { Storage::disk('public')->delete($tutorial->image_path); }
        $tutorial->delete();
        return redirect()->route('admin.tutorials.index')->with('success', 'Tutorial deleted successfully!');
    }
}