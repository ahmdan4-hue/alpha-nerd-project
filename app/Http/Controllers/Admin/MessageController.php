<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::oldest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message moved to deleted messages ✅');
    }

    public function deleted()
    {
        $messages = ContactMessage::onlyTrashed()->oldest('deleted_at')->paginate(10);
        return view('admin.messages.deleted', compact('messages'));
    }

    public function showDeleted($id)
    {
        $message = ContactMessage::onlyTrashed()->findOrFail($id);
        return view('admin.messages.deleted-show', compact('message'));
    }

    public function restore($id)
    {
        $message = ContactMessage::onlyTrashed()->findOrFail($id);
        $message->restore();

        return redirect()->route('admin.messages.deleted')->with('success', 'Message restored ✅');
    }

    public function forceDelete($id)
    {
        $message = ContactMessage::onlyTrashed()->findOrFail($id);
        $message->forceDelete();

        return redirect()->route('admin.messages.deleted')->with('success', 'Message permanently deleted ✅');
    }
}
