<button id="chatbotToggle" class="chatbot-toggle-btn">
    <i class="fas fa-comments"></i>
</button>

<div id="chatbotWindow" class="chatbot-window d-none">
    <div class="card" id="chat2">
        <div class="card-header d-flex justify-content-between align-items-center p-3"
             style="border-top: 4px solid #1900ff;">
            <h5 class="mb-0">Library Assistant</h5>
            <i class="fas fa-times text-muted" id="chatbotClose" style="cursor:pointer;"></i>
        </div>

        <div class="card-body" id="chatbotBody" style="position: relative; height: 400px; overflow-y: auto;">

            <div class="d-flex flex-row justify-content-start mb-4">
                <img src="{{ asset('images/bot-avatar.png') }}" alt="bot" class="chatbot-avatar">
                <div>
                    <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">
                        👋 Hi! Ask me about any book, author, or genre in our library.
                    </p>
                    <p class="small ms-3 mb-3 rounded-3 text-muted chatbot-time"></p>
                </div>
            </div>

        </div>

        <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
            <img src="{{ asset('images/user-avatar.png') }}" alt="user" class="chatbot-avatar-sm">
            <input type="text" class="form-control form-control-lg" id="chatbotInput"
                   placeholder="Type message">
            <a class="ms-3" href="#!" id="chatbotSend"><i class="fas fa-paper-plane"></i></a>
        </div>
    </div>
</div>

<style>
.chatbot-toggle-btn {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: #ffa900;
    color: #fff;
    border: none;
    font-size: 22px;
    z-index: 1050;
    box-shadow: 0 4px 12px rgba(0,0,0,.2);
}
.chatbot-window {
    position: fixed;
    bottom: 90px;
    right: 25px;
    width: 380px;
    z-index: 1050;
}
.chatbot-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
.chatbot-avatar-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 8px;
}
.chatbot-time {
    font-size: 11px;
}

.chatbot-btn-group {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-left: 52px;
    margin-bottom: 12px;
}
.chatbot-chip {
    background: #fff3d6;
    border: 1px solid #ffa900;
    color: #8a5a00;
    border-radius: 20px;
    padding: 6px 14px;
    font-size: 13px;
    cursor: pointer;
}
.chatbot-chip:hover {
    background: #ffa900;
    color: #fff;
}

.chatbot-book-list {
    margin-left: 52px;
    margin-bottom: 12px;
}
.chatbot-book-card {
    display: flex;
    gap: 10px;
    background: #fff;
    border-radius: 8px;
    padding: 8px;
    margin-bottom: 8px;
    box-shadow: 0 1px 4px rgba(0,0,0,.08);
}
.chatbot-book-card img {
    width: 45px;
    height: 65px;
    object-fit: cover;
    border-radius: 4px;
}
.chatbot-book-info {
    display: flex;
    flex-direction: column;
    font-size: 13px;
}
.chatbot-book-info strong { font-size: 13px; }
.chatbot-book-info span { color: #888; font-size: 12px; }
.chatbot-book-read {
    margin-top: 4px;
    align-self: flex-start;
    background: #ffa900;
    color: #fff;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 12px;
    text-decoration: none;
}

.chatbot-typing {
    margin-left: 52px;
    font-size: 12px;
    color: #999;
    font-style: italic;
}
</style>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('chatbotToggle');
    const closeBtn = document.getElementById('chatbotClose');
    const win = document.getElementById('chatbotWindow');
    const body = document.getElementById('chatbotBody');
    const input = document.getElementById('chatbotInput');
    const sendBtn = document.getElementById('chatbotSend');

    const BOT_AVATAR = "{{ asset('images/bot-avatar.png') }}";
    const USER_AVATAR = "{{ asset('images/user-avatar.png') }}";

    toggleBtn.addEventListener('click', () => win.classList.toggle('d-none'));
    closeBtn.addEventListener('click', () => win.classList.add('d-none'));

    // set initial greeting time
    document.querySelector('.chatbot-time').textContent = currentTime();

    function currentTime() {
        const d = new Date();
        return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function appendMessage(text, sender) {
        const wrap = document.createElement('div');
        const time = currentTime();

        if (sender === 'user') {
            wrap.className = 'd-flex flex-row justify-content-end mb-4';
            wrap.innerHTML = `
                <div>
                    <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-warning">${text}</p>
                    <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">${time}</p>
                </div>
                <img src="${USER_AVATAR}" class="chatbot-avatar" alt="you">
            `;
        } else {
            wrap.className = 'd-flex flex-row justify-content-start mb-4';
            wrap.innerHTML = `
                <img src="${BOT_AVATAR}" class="chatbot-avatar" alt="bot">
                <div>
                    <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">${text}</p>
                    <p class="small ms-3 mb-3 rounded-3 text-muted">${time}</p>
                </div>
            `;
        }

        body.appendChild(wrap);
        body.scrollTop = body.scrollHeight;
    }

    function showTyping() {
        const el = document.createElement('div');
        el.className = 'chatbot-typing mb-2';
        el.id = 'chatbotTypingIndicator';
        el.textContent = 'Assistant is typing...';
        body.appendChild(el);
        body.scrollTop = body.scrollHeight;
    }

    function hideTyping() {
        const el = document.getElementById('chatbotTypingIndicator');
        if (el) el.remove();
    }

    function appendCategoryButtons(categories) {
        const wrap = document.createElement('div');
        wrap.className = 'chatbot-btn-group';

        categories.forEach(cat => {
            const btn = document.createElement('button');
            btn.className = 'chatbot-chip';
            btn.textContent = `${cat.name} (${cat.count})`;
            btn.addEventListener('click', () => sendMessage(cat.name));
            wrap.appendChild(btn);
        });

        body.appendChild(wrap);
        body.scrollTop = body.scrollHeight;
    }

    function appendBookCards(books) {
        const wrap = document.createElement('div');
        wrap.className = 'chatbot-book-list';

        if (books.length === 0) {
            wrap.innerHTML = '<p class="small text-muted">No books found in this category yet.</p>';
        }

        books.forEach(b => {
            const card = document.createElement('div');
            card.className = 'chatbot-book-card';
            card.innerHTML = `
                <img src="${b.image}" alt="${b.name}">
                <div class="chatbot-book-info">
                    <strong>${b.name}</strong>
                    <span>${b.author}</span>
                    <a href="${b.url}" target="_blank" class="chatbot-book-read">Read</a>
                </div>
            `;
            wrap.appendChild(card);
        });

        body.appendChild(wrap);
        body.scrollTop = body.scrollHeight;
    }

    function sendMessage(overrideText) {
        const message = (overrideText ?? input.value).trim();
        if (!message) return;

        appendMessage(message, 'user');
        input.value = '';
        showTyping();

        fetch("{{ route('chatbot.ask') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message })
        })
        .then(res => res.json())
        .then(data => {
            hideTyping();
            appendMessage(data.reply, 'bot');

            if (data.type === 'categories') {
                appendCategoryButtons(data.categories);
            } else if (data.type === 'books') {
                appendBookCards(data.books);
            }
        })
        .catch(() => {
            hideTyping();
            appendMessage('Something went wrong. Try again.', 'bot');
        });
    }

    sendBtn.addEventListener('click', () => sendMessage());
    input.addEventListener('keypress', e => {
        if (e.key === 'Enter') sendMessage();
    });
});
</script>
@endpush