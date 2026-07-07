// ai-copilot.js

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('noor-ai-container');
    const trigger = document.getElementById('noor-ai-trigger');
    const closeBtn = document.getElementById('noor-ai-close');
    const themeBtn = document.getElementById('noor-ai-theme-toggle');
    const messagesBox = document.getElementById('noor-ai-messages');
    const inputField = document.getElementById('noor-ai-input');
    const sendBtn = document.getElementById('noor-ai-send');
    const micBtn = document.getElementById('noor-ai-mic');

    // Generate Session ID
    let sessionId = localStorage.getItem('noor_ai_session');
    if (!sessionId) {
        sessionId = 'session_' + Math.random().toString(36).substr(2, 9);
        localStorage.setItem('noor_ai_session', sessionId);
    }

    // Toggle Chatbox
    trigger.addEventListener('click', () => {
        container.classList.toggle('noor-ai-closed');
        if (!container.classList.contains('noor-ai-closed')) {
            inputField.focus();
        }
    });

    closeBtn.addEventListener('click', () => {
        container.classList.add('noor-ai-closed');
    });

    // Theme Toggle
    themeBtn.addEventListener('click', () => {
        container.classList.toggle('noor-dark-mode');
    });

    // Send Message on Enter
    inputField.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    sendBtn.addEventListener('click', sendMessage);

    async function sendMessage() {
        const text = inputField.value.trim();
        if (!text) return;

        // Add user message to UI
        appendMessage(text, 'user-message');
        inputField.value = '';

        // Add typing indicator
        const typingId = showTypingIndicator();

        try {
            const response = await fetch(window.AI_COPILOT_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: text,
                    session_id: sessionId
                })
            });

            const data = await response.json();
            removeTypingIndicator(typingId);

            if (data.status === 'success') {
                handleNavigationCommands(data.message);
                const cleanMessage = data.message.replace(/NAVIGATE_TO_[A-Z]+/g, '').trim();
                appendMessage(cleanMessage, 'ai-message', true);
            } else {
                appendMessage("Sorry, I encountered an error.", 'ai-message');
            }
        } catch (error) {
            console.error('AI Error:', error);
            removeTypingIndicator(typingId);
            appendMessage("Sorry, I could not connect to the server.", 'ai-message');
        }
    }

    function appendMessage(text, className, isMarkdown = false) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `message ${className}`;
        
        // Detect RTL (Arabic/Urdu)
        const arabicRegex = /[\u0600-\u06FF]/;
        if (arabicRegex.test(text)) {
            msgDiv.classList.add('rtl-text');
        }

        // Intercept UI Actions for RAG Results
        const actionRegex = /\[ACTION:\s*(.+?)\]/g;
        let actionMatches = [];
        let amatch;
        while ((amatch = actionRegex.exec(text)) !== null) {
            actionMatches.push(amatch[1]);
            text = text.replace(amatch[0], '');
        }

        // Intercept [DONATION_OPTIONS]
        let hasDonationOptions = false;
        if (text.includes('[DONATION_OPTIONS]')) {
            hasDonationOptions = true;
            text = text.replace('[DONATION_OPTIONS]', '');
        }

        // Intercept [NAVIGATE: /path]
        const navRegex = /\[NAVIGATE:\s*(.+?)\]/g;
        let match;
        while ((match = navRegex.exec(text)) !== null) {
            const path = match[1];
            setTimeout(() => window.location.href = path, 2000);
            text = text.replace(match[0], '');
        }

        if (isMarkdown && typeof marked !== 'undefined') {
            const rawHtml = marked.parse(text);
            msgDiv.innerHTML = typeof DOMPurify !== 'undefined' ? DOMPurify.sanitize(rawHtml) : rawHtml;
        } else {
            msgDiv.textContent = text;
        }

        // Add RAG Action Buttons if applicable
        if (actionMatches.length > 0) {
            const actionsDiv = document.createElement('div');
            actionsDiv.className = 'rag-actions';
            actionsDiv.style.marginTop = '10px';
            actionsDiv.style.display = 'flex';
            actionsDiv.style.gap = '10px';
            
            actionMatches.forEach(action => {
                const btn = document.createElement('button');
                btn.className = 'btn btn-secondary btn-sm';
                btn.style.padding = '5px 10px';
                btn.style.fontSize = '12px';
                if (action === 'BOOKMARK') btn.innerHTML = '🔖 Bookmark';
                if (action === 'SHARE') btn.innerHTML = '🔗 Share';
                if (action === 'PLAY_AUDIO') btn.innerHTML = '▶️ Play Audio';
                actionsDiv.appendChild(btn);
            });
            msgDiv.appendChild(actionsDiv);
        }

        // Add Donation Cards if applicable
        if (hasDonationOptions) {
            const donationDiv = document.createElement('div');
            donationDiv.className = 'donation-cards';
            donationDiv.innerHTML = `
                <div class="donation-card" onclick="window.location.href='/campaigns'">
                    <span class="icon">🏢</span>
                    <div class="info">
                        <h4>Donate to Verified NGO</h4>
                        <p>Support registered organizations</p>
                    </div>
                </div>
                <div class="donation-card" onclick="window.location.href='/apply'">
                    <span class="icon">👤</span>
                    <div class="info">
                        <h4>Donate to Individual</h4>
                        <p>Help a verified family in need</p>
                    </div>
                </div>
            `;
            msgDiv.appendChild(donationDiv);
        }

        // Add Speech synthesis button if AI message
        if (className === 'ai-message') {
            const speakBtn = document.createElement('button');
            speakBtn.innerHTML = '🔊';
            speakBtn.className = 'speak-btn';
            speakBtn.onclick = () => speakText(text);
            msgDiv.prepend(speakBtn);
        }

        messagesBox.appendChild(msgDiv);
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }

    function showTypingIndicator() {
        const id = 'typing-' + Date.now();
        const msgDiv = document.createElement('div');
        msgDiv.className = `message ai-message`;
        msgDiv.id = id;
        msgDiv.innerHTML = `<div class="typing-indicator"><span></span><span></span><span></span></div>`;
        messagesBox.appendChild(msgDiv);
        messagesBox.scrollTop = messagesBox.scrollHeight;
        return id;
    }

    function removeTypingIndicator(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    // Smart Website Integration (Navigation)
    function handleNavigationCommands(message) {
        if (message.includes('NAVIGATE_TO_CALCULATOR')) {
            setTimeout(() => window.location.href = '/calculator', 2000);
        } else if (message.includes('NAVIGATE_TO_AZKAR')) {
            setTimeout(() => window.location.href = '/azkar', 2000);
        } else if (message.includes('NAVIGATE_TO_PRAYERS')) {
            setTimeout(() => window.location.href = '/prayer', 2000);
        } else if (message.includes('NAVIGATE_TO_CAMPAIGNS')) {
            setTimeout(() => window.location.href = '/campaigns', 2000);
        }
    }

    // Voice Features (Web Speech API)
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (SpeechRecognition) {
        const recognition = new SpeechRecognition();
        recognition.continuous = false;
        recognition.lang = 'en-US'; // Can be dynamically changed
        
        recognition.onstart = () => {
            micBtn.classList.add('recording');
        };
        
        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            inputField.value = transcript;
            sendMessage();
        };
        
        recognition.onerror = (event) => {
            console.error('Speech recognition error', event.error);
            micBtn.classList.remove('recording');
        };
        
        recognition.onend = () => {
            micBtn.classList.remove('recording');
        };

        micBtn.addEventListener('click', () => {
            if (micBtn.classList.contains('recording')) {
                recognition.stop();
            } else {
                recognition.start();
            }
        });
    } else {
        micBtn.style.display = 'none'; // Hide if not supported
    }

    function speakText(text) {
        // Strip markdown and html
        const cleanText = text.replace(/<[^>]*>?/gm, '').replace(/\*/g, '').replace(/#/g, '');
        const utterance = new SpeechSynthesisUtterance(cleanText);
        window.speechSynthesis.speak(utterance);
    }
});
