<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AiCopilotService;
use App\Models\AiChatHistory;
use Illuminate\Support\Str;

class AiCopilotController extends Controller
{
    protected $aiService;

    public function __construct(AiCopilotService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'session_id' => 'required|string'
        ]);

        $message = $request->input('message');
        $sessionId = $request->input('session_id');
        $userId = auth()->check() ? auth()->id() : null;

        try {
            $response = $this->aiService->generateResponse($message, $sessionId, $userId);

            return response()->json([
                'status' => 'success',
                'message' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function history(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return response()->json([]);
        }

        $history = AiChatHistory::where('session_id', $sessionId)
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->map(function ($chat) {
                        return [
                            'message' => $chat->message,
                            'response' => $chat->response,
                            'created_at' => $chat->created_at->toDateTimeString()
                        ];
                    });

        return response()->json($history);
    }
}
