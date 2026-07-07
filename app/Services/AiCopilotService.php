<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AiChatHistory;

class AiCopilotService
{
    protected $apiKey;
    protected $model;
    protected $systemPrompt;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.model', 'gemini-2.5-flash');
        $this->systemPrompt = <<<'PROMPT'
You are NOOR AI, the Premium Intelligent Islamic Copilot and brain of the ZakatEase platform.

PERSONALITY:
Calm, warm, respectful, professional, minimal, beautiful, and spiritually uplifting. Never sarcastic or rude. Never overwhelm the user. Do not answer like a generic ChatGPT. You are a dedicated Islamic assistant.

STRUCTURE OF EVERY RESPONSE:
1. 🌿 Greeting (e.g. Assalamu Alaikum!)
2. Short Introduction/Acknowledge query.
3. Main Answer (Formatted beautifully using Markdown).
4. 📖 Islamic Reference (Quran Ayah or Hadith if applicable).
5. Helpful Recommendation or Suggested Next Actions (e.g., 'Would you like to calculate complete Zakat?').

CRITICAL RULES:
- Never fabricate Quran verses or Hadith.
- Remember previous context during the conversation.
- Answer Islamic questions using your knowledge clearly and accurately.
- For Zakat calculations, explain the principles and guide users to the Zakat Calculator.
- For prayer times, explain prayer concepts and guide users to the Prayer Times page.

NAVIGATION:
When the user wants to visit a page on the website, output a navigation command on its own line using this exact format:
[NAVIGATE:/path]

Available pages:
- Zakat Calculator: [NAVIGATE:/calculator]
- Azkar & Tasbeeh: [NAVIGATE:/azkar]
- Prayer Times: [NAVIGATE:/prayer-times]
- Campaigns: [NAVIGATE:/campaigns]

FORMATTING:
- Use bolding, lists, and markdown tables for data (like Zakat summaries).
- Ensure references are clearly separated.
PROMPT;
    }

    public function generateResponse($message, $sessionId, $userId = null)
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Gemini API key is not configured.');
        }

        $history = AiChatHistory::where('session_id', $sessionId)
            ->orderBy('created_at', 'asc')
            ->take(20)
            ->get();

        $contents = [];

        foreach ($history as $chat) {
            $contents[] = ['role' => 'user', 'parts' => [['text' => $chat->message]]];
            $contents[] = ['role' => 'model', 'parts' => [['text' => $chat->response]]];
        }

        $contents[] = ['role' => 'user', 'parts' => [['text' => $message]]];

        $payload = [
            'system_instruction' => ['parts' => [['text' => $this->systemPrompt]]],
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 1500,
            ],
        ];

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

        $response = Http::timeout(30)->post($url, $payload);

        if (!$response->successful()) {
            $data = $response->json();
            $errorMsg = $data['error']['message'] ?? 'Unknown Error';
            Log::error('Gemini API Error', ['status' => $response->status(), 'error' => $errorMsg]);
            throw new \Exception('Gemini API Error: ' . $errorMsg);
        }

        $data = $response->json();
        $candidate = $data['candidates'][0] ?? null;

        if (!$candidate) {
            throw new \Exception('No response from Gemini.');
        }

        $parts = $candidate['content']['parts'] ?? [];
        $aiText = '';

        foreach ($parts as $part) {
            if (isset($part['text'])) {
                $aiText .= $part['text'];
            }
        }

        if (empty(trim($aiText))) {
            $finishReason = $candidate['finishReason'] ?? 'UNKNOWN';
            throw new \Exception("Empty response from Gemini (reason: {$finishReason}).");
        }

        AiChatHistory::create([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'message' => $message,
            'response' => $aiText,
        ]);

        return $aiText;
    }
}
