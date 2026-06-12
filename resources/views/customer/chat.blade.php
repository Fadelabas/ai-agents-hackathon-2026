@extends('layouts.app')

@section('content')
<div class="chat-wrapper">
    <div class="chat-box" id="chatBox">
        <div class="message bot-message">
            <div class="bubble">
                👋 Ahla! I'm <strong>Jibli</strong>, your AI delivery assistant.<br><br>
                Tell me what you need in Arabic, English, French, or Franco-Arabic.<br><br>
                <em>Example: "jibli dawa mn saydali" or "جيبلي أكل"</em>
            </div>
        </div>
    </div>

    <div class="typing-indicator" id="typingIndicator" style="display:none;">
        <span></span><span></span><span></span>
    </div>

    <div class="input-area">
        <input
            type="text"
            id="messageInput"
            placeholder="Type your request..."
            autocomplete="off"
            autofocus
        />
        <button id="sendBtn" onclick="sendMessage()">Send</button>
    </div>
</div>

<div class="status-panel" id="statusPanel" style="display:none;">
    <div class="status-card">
        <h3>📦 Order Status</h3>
        <div id="statusContent">Finding a driver...</div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const TOKEN = '{{ session()->getId() }}';
let polling  = null;
let orderToken = null;

async function sendMessage() {
    const input   = document.getElementById('messageInput');
    const message = input.value.trim();
    if (!message) return;

    input.value = '';
    appendMessage(message, 'user');
    showTyping();

    try {
        const res = await fetch('/chat/message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ message, token: TOKEN }),
        });

        const data = await res.json();
        hideTyping();

        if (data.type === 'order_created') {
            appendMessage(data.message, 'bot');
            orderToken = data.token;
            showStatusPanel();
            startPolling(data.token);
            disableInput();
            return;
        }

        if (data.type === 'cancelled') {
            appendMessage(data.message, 'bot');
            hideStatusPanel();
            enableInput();
            return;
        }

        appendMessage(data.message, 'bot');

    } catch (err) {
        hideTyping();
        appendMessage('⏳ Jibli is temporarily busy. Please try again in a few seconds.', 'bot');
    }
}

function appendMessage(text, sender) {
    const box    = document.getElementById('chatBox');
    const div    = document.createElement('div');
    div.className = `message ${sender === 'user' ? 'user-message' : 'bot-message'}`;

    const bubble = document.createElement('div');
    bubble.className = 'bubble';
    bubble.innerHTML = text
        .replace(/\n/g, '<br>')
        .replace(/\*(.*?)\*/g, '<strong>$1</strong>');

    div.appendChild(bubble);
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}

function showTyping() {
    document.getElementById('typingIndicator').style.display = 'flex';
    document.getElementById('chatBox').scrollTop = 99999;
}

function hideTyping() {
    document.getElementById('typingIndicator').style.display = 'none';
}

function showStatusPanel() {
    document.getElementById('statusPanel').style.display = 'flex';
}

function hideStatusPanel() {
    document.getElementById('statusPanel').style.display = 'none';
}

function disableInput() {
    document.getElementById('messageInput').disabled = true;
    document.getElementById('sendBtn').disabled      = true;
}

function enableInput() {
    document.getElementById('messageInput').disabled = false;
    document.getElementById('sendBtn').disabled      = false;
    document.getElementById('messageInput').focus();
}

function startPolling(token) {
    if (polling) clearInterval(polling);

    polling = setInterval(async () => {
        try {
            const res  = await fetch(`/order/status/${token}`);
            const data = await res.json();
            updateStatus(data);

            if (data.status === 'completed' || data.status === 'cancelled') {
                clearInterval(polling);
            }
        } catch (e) {}
    }, 4000);
}

function updateStatus(data) {
    const el = document.getElementById('statusContent');

    const desc    = data.order_description ? `<br><small style="color:#888;">📦 ${data.order_description}</small>` : '';
    const area    = data.area_name    ? `<br><small style="color:#888;">📍 ${data.area_name}</small>` : '';
    const address = data.exact_address ? `<br><small style="color:#888;">🏠 ${data.exact_address}</small>` : '';
    const price   = data.price        ? `<br><small style="color:#888;">💰 $${data.price}</small>` : '';

    if (data.status === 'not_found') {
        el.innerHTML = '🔍 Looking for your order...';
        return;
    }

    if (data.status === 'pending') {
        el.innerHTML = `
            🔍 <strong>Finding a driver for you...</strong>
            ${desc}${area}${address}${price}
        `;
        return;
    }

    if (data.status === 'driver_assigned' || data.status === 'in_progress') {
        el.innerHTML = `
            ✅ <strong>Driver Assigned!</strong>
            ${desc}${area}
            <br><br>
            👤 <strong>${data.driver_name}</strong><br>
            📞 <a href="tel:${data.driver_phone}" style="color:#6c63ff;">${data.driver_phone}</a><br>
            💰 Delivery Fee: <strong>$${data.price}</strong>
        `;
        return;
    }

    if (data.status === 'completed') {
        el.innerHTML = `
            ✅ <strong>Order Delivered!</strong><br>
            Thank you for using Jibli 🎉
            ${desc}
        `;
        clearInterval(polling);
        return;
    }

    if (data.status === 'cancelled') {
        el.innerHTML = '❌ Order cancelled.';
        clearInterval(polling);
        
        return;
    }
}

// Send on Enter
document.getElementById('messageInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') sendMessage();
});
</script>

<style>
.chat-wrapper {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 600px;
    height: 100vh;
    padding-top: 60px;
    padding-bottom: 70px;
}

.chat-box {
    flex: 1;
    overflow-y: auto;
    padding: 20px 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.message { display: flex; }

.user-message { justify-content: flex-end; }
.bot-message  { justify-content: flex-start; }

.bubble {
    max-width: 75%;
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.5;
}

.user-message .bubble {
    background: #6c63ff;
    color: white;
    border-bottom-right-radius: 4px;
}

.bot-message .bubble {
    background: white;
    color: #1a1a2e;
    border-bottom-left-radius: 4px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

.typing-indicator {
    display: flex;
    gap: 5px;
    padding: 8px 20px;
    align-items: center;
}

.typing-indicator span {
    width: 8px;
    height: 8px;
    background: #6c63ff;
    border-radius: 50%;
    animation: bounce 1s infinite;
}

.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-6px); }
}

.input-area {
    position: fixed;
    bottom: 0;
    width: 100%;
    max-width: 600px;
    display: flex;
    padding: 12px 16px;
    background: white;
    border-top: 1px solid #e0e0e0;
    gap: 10px;
}

.input-area input {
    flex: 1;
    padding: 12px 16px;
    border: 2px solid #e0e0e0;
    border-radius: 25px;
    font-size: 14px;
    outline: none;
    transition: border 0.2s;
}

.input-area input:focus { border-color: #6c63ff; }

.input-area button {
    padding: 12px 22px;
    background: #6c63ff;
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.input-area button:hover    { background: #5a52d5; }
.input-area button:disabled { background: #aaa; cursor: not-allowed; }

.status-panel {
    position: fixed;
    top: 60px;
    right: 16px;
    width: 260px;
    z-index: 50;
    display: none;
}

.status-card {
    background: white;
    border-radius: 16px;
    padding: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    width: 100%;
    border-left: 4px solid #6c63ff;
}

.status-card h3 {
    font-size: 14px;
    color: #6c63ff;
    margin-bottom: 10px;
}

#statusContent {
    font-size: 13px;
    line-height: 1.7;
    color: #333;
}

#statusContent a {
    color: #6c63ff;
    text-decoration: none;
}
</style>
@endsection