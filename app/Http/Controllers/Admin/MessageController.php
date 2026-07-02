<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Broadcast;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])
            ->where('to_user_id', auth()->id())
            ->latest()
            ->paginate(15, ['*'], 'messages_page');

        $sentMessages = Message::with(['sender', 'receiver'])
            ->where('from_user_id', auth()->id())
            ->latest()
            ->paginate(15, ['*'], 'sent_page');

        $broadcasts = Broadcast::with('creator')->latest()->paginate(10, ['*'], 'broadcasts_page');
        $users = User::all();

        return view('admin.messages.index', compact('messages', 'sentMessages', 'broadcasts', 'users'));
    }

    public function reply(Request $request, Message $message)
    {
        $data = $request->validate([
            'body' => 'required|string',
        ]);

        $reply = Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $message->from_user_id,
            'subject' => 'Re: ' . ($message->subject ?? 'Query'),
            'body' => $data['body'],
            'is_read' => false,
        ]);

        // Mark original message as read
        $message->is_read = true;
        $message->read_at = now();
        $message->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'messages',
            'description' => "Replied to message from {$message->sender->email}.",
        ]);

        return back()->with('success', 'Reply sent successfully.');
    }

    public function storeBroadcast(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,success,prayer,zakat',
            'target' => 'required|in:all,users,organizations,donors',
            'scheduled_at' => 'nullable|date',
        ]);

        $data['created_by'] = auth()->id();
        $data['sent_at'] = empty($data['scheduled_at']) ? now() : null;

        Broadcast::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'broadcasts',
            'description' => "Scheduled broadcast notification: {$data['title']}.",
        ]);

        return back()->with('success', 'Broadcast notification scheduled/sent successfully.');
    }

    public function destroyMessage(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Message deleted.');
    }

    public function destroyBroadcast(Broadcast $broadcast)
    {
        $broadcast->delete();
        return back()->with('success', 'Broadcast deleted.');
    }
}
