<div id="noor-ai-container" class="noor-ai-closed">
    <!-- Floating Button -->
    <button id="noor-ai-trigger" class="glass-button">
        <div class="glow-effect"></div>
        <img src="{{ asset('images/noor-ai-icon.png') }}" alt="Noor AI" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'white\'><path d=\'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z\'/></svg>'">
    </button>

    <!-- Chat Box -->
    <div id="noor-ai-chatbox" class="glass-panel hidden">
        <div class="chat-header">
            <div class="header-info">
                <div class="ai-avatar"></div>
                <div>
                    <h3>NOOR AI</h3>
                    <span class="subtitle">Islamic Knowledge & Zakat Assistant</span>
                </div>
            </div>
            <div class="header-actions">
                <button id="noor-ai-theme-toggle" title="Toggle Dark/Light Mode">🌓</button>
                <button id="noor-ai-close" title="Close">✖</button>
            </div>
        </div>

        <div id="noor-ai-messages" class="chat-messages">
            <!-- Messages will be appended here -->
            <div class="message ai-message">
                As-salamu alaykum! I am NOOR AI, your intelligent Islamic assistant. How can I help you today?
            </div>
        </div>

        <div class="chat-input-area">
            <button id="noor-ai-mic" class="action-btn" title="Voice Input">🎤</button>
            <input type="text" id="noor-ai-input" placeholder="Ask about Zakat, Hadith, Prayer..." autocomplete="off" />
            <button id="noor-ai-send" class="action-btn send-btn" title="Send">➤</button>
        </div>
        <div class="branding">Powered by Gemini AI</div>
    </div>
</div>

<!-- Marked.js for Markdown parsing -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<!-- DOMPurify to prevent XSS from markdown -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.6/purify.min.js"></script>
<!-- Include Noor AI assets -->
<link rel="stylesheet" href="{{ asset('css/ai-copilot.css') }}">
<script src="{{ asset('js/ai-copilot.js') }}"></script>
<script>
    window.AI_COPILOT_URL = "{{ route('ai.chat') }}";
    window.CSRF_TOKEN = "{{ csrf_token() }}";
</script>
