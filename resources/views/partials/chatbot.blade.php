{{-- ============================================================
     CHATBOT ASSISTANT FLOATING WIDGET
============================================================ --}}
<div id="chatbot-widget-container" class="fixed bottom-6 right-4 sm:right-6 z-[9999] flex flex-col items-end pointer-events-none select-none">

  {{-- CHATBOX MODAL WINDOW --}}
  <div id="chatbot-modal" 
       class="pointer-events-auto hidden w-[92vw] sm:w-[380px] max-w-[400px] h-[calc(100vh-115px)] max-h-[calc(100vh-115px)] sm:max-h-[520px] bg-white rounded-3xl shadow-2xl border border-emerald-100/90 flex flex-col overflow-hidden transition-all duration-300 transform scale-95 opacity-0 origin-bottom-right mb-3">
    
    {{-- Chat Header --}}
    <div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-800 text-white p-4 flex items-center justify-between shadow-md relative overflow-hidden">
      {{-- Shimmer background effect --}}
      <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-yellow-500/10 rounded-full blur-xl pointer-events-none"></div>
      
      <div class="flex items-center gap-3 relative z-10">
        <div class="relative">
          <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center shadow-inner border border-yellow-300/40">
            <span class="text-emerald-950 font-black text-xl leading-none">🌴</span>
          </div>
          <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-emerald-900 rounded-full"></span>
        </div>
        <div>
          <div class="font-extrabold text-sm text-white flex items-center gap-1.5">
            <span>Asisten Pusat Kurma</span>
            <span class="bg-yellow-500/20 text-yellow-300 text-[10px] px-2 py-0.5 rounded-full font-bold border border-yellow-400/30">AI Live</span>
          </div>
          <p class="text-xs text-emerald-200/90 font-medium flex items-center gap-1">
            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
            <span>Online · Siap Membantu</span>
          </p>
        </div>
      </div>

      {{-- Control Actions --}}
      <div class="flex items-center gap-1 relative z-10">
        <button type="button" onclick="resetChatbotMessages()" title="Reset Percakapan" 
                class="p-1.5 text-emerald-200 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
        </button>
        <button type="button" onclick="toggleChatbot()" title="Tutup Chat" 
                class="p-1.5 text-emerald-200 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>

    {{-- Chat Messages Area --}}
    <div id="chatbot-messages" class="flex-grow p-4 overflow-y-auto space-y-3.5 bg-slate-50/60 scrollbar-thin scrollbar-thumb-emerald-200">
      
      {{-- System Date Badge --}}
      <div class="text-center my-1">
        <span class="bg-emerald-100/70 text-emerald-800 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
          Hari ini · Layanan Asisten 24/7
        </span>
      </div>

      {{-- Initial Bot Greeting --}}
      <div class="flex items-start gap-2.5 message-bot">
        <div class="w-7 h-7 bg-emerald-800 text-yellow-400 rounded-xl flex items-center justify-center text-xs font-bold flex-shrink-0 shadow-sm mt-0.5">
          🌴
        </div>
        <div class="bg-white border border-emerald-100/80 rounded-2xl rounded-tl-none p-3.5 shadow-sm text-xs text-gray-700 leading-relaxed max-w-[85%] space-y-2">
          <p class="font-semibold text-emerald-950">
            Assalamu'alaikum! Selamat datang di <strong>Pusat Kurma</strong> 🌙
          </p>
          <p>
            Saya asisten cerdas siap membantu Anda memilih kurma terbaik, info lokasi toko, pengiriman COD, hingga paket oleh-oleh Haji/Umrah.
          </p>
          <div class="pt-1 flex flex-wrap gap-1.5">
            <button type="button" onclick="sendQuickReply('Rekomendasi Kurma')" 
                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
              🌴 Rekomendasi Kurma
            </button>
            <button type="button" onclick="sendQuickReply('Lokasi Toko')" 
                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
              📍 Lokasi Toko
            </button>
            <button type="button" onclick="sendQuickReply('COD & Pengiriman')" 
                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
              🚚 COD & Pengiriman
            </button>
            <button type="button" onclick="sendQuickReply('Oleh-Oleh Haji')" 
                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
              🕋 Oleh-Oleh Haji
            </button>
          </div>
        </div>
      </div>

    </div>

    {{-- Typing Indicator --}}
    <div id="chatbot-typing" class="hidden px-4 py-2 bg-slate-50/80 border-t border-gray-100 flex items-center gap-2">
      <div class="w-6 h-6 bg-emerald-800 text-yellow-400 rounded-lg flex items-center justify-center text-[10px] font-bold">🌴</div>
      <div class="flex items-center gap-1 bg-white border border-gray-200 px-3 py-1.5 rounded-full shadow-xs">
        <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full animate-bounce"></span>
        <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full animate-bounce [animation-delay:0.2s]"></span>
        <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full animate-bounce [animation-delay:0.4s]"></span>
        <span class="text-[11px] text-gray-500 font-medium ml-1">Asisten menulis...</span>
      </div>
    </div>

    {{-- Input Form Area --}}
    <div class="p-3 bg-white border-t border-emerald-100/80 space-y-2">
      <form id="chatbot-form" onsubmit="handleChatbotSubmit(event)" class="flex items-center gap-2">
        <input type="text" id="chatbot-input" placeholder="Ketik pertanyaan Anda..." 
               class="flex-grow bg-slate-50 hover:bg-slate-100/80 focus:bg-white border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-2xl px-4 py-2.5 text-xs text-gray-800 outline-none font-medium transition-all"
               autocomplete="off" required>
        <button type="submit" id="chatbot-send-btn" 
                class="w-9 h-9 bg-emerald-700 hover:bg-emerald-800 text-yellow-400 rounded-2xl flex items-center justify-center shadow-md hover:scale-105 transition-all flex-shrink-0">
          <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
          </svg>
        </button>
      </form>
      <div class="flex items-center justify-between text-[10px] text-gray-400 px-1 pt-0.5">
        <span>Respon instan 24/7</span>
        <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $settings['wa_number'] ?? '6281234567890') }}&text=Halo%20Admin%20Pusat%20Kurma%2C%20saya%20butuh%20bantuan." 
           target="_blank" rel="noopener noreferrer" 
           class="text-emerald-700 font-bold hover:underline flex items-center gap-0.5">
          <span>Chat WA Admin</span>
          <span>&rarr;</span>
        </a>
      </div>
    </div>
  </div>

  {{-- FLOATING TRIGGER BUTTON --}}
  <button type="button" id="chatbot-trigger" onclick="toggleChatbot()" 
          class="pointer-events-auto group relative flex items-center gap-2.5 bg-gradient-to-br from-emerald-800 to-emerald-950 hover:from-emerald-700 hover:to-emerald-900 text-white p-3.5 sm:px-4 sm:py-3.5 rounded-full shadow-2xl border-2 border-yellow-400/80 transition-all duration-300 hover:scale-110 active:scale-95">
    
    {{-- Notification Badge --}}
    <span class="absolute -top-1 -right-1 flex h-4 w-4">
      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
      <span class="relative inline-flex rounded-full h-4 w-4 bg-yellow-500 border-2 border-emerald-900 text-[9px] font-black text-emerald-950 items-center justify-center">!</span>
    </span>

    <div class="w-8 h-8 bg-yellow-400 text-emerald-950 rounded-full flex items-center justify-center font-black text-lg shadow-sm group-hover:rotate-12 transition-transform">
      🌴
    </div>

    <div class="hidden sm:block text-left pr-1">
      <div class="text-[10px] text-yellow-300 font-bold uppercase tracking-wider leading-none">Bantuan Live</div>
      <div class="text-xs font-black text-white leading-tight">Tanya Asisten AI</div>
    </div>
  </button>

</div>

{{-- CHATBOT JAVASCRIPT ENGINE --}}
<script>
  const chatbotState = {
    isOpen: false,
    isProcessing: false,
    csrfToken: '{{ csrf_token() }}',
    waNumberClean: '{{ preg_replace('/[^0-9]/', '', $settings['wa_number'] ?? '6281234567890') }}',
  };

  function toggleChatbot() {
    const modal = document.getElementById('chatbot-modal');
    chatbotState.isOpen = !chatbotState.isOpen;

    if (chatbotState.isOpen) {
      modal.classList.remove('hidden');
      setTimeout(() => {
        modal.classList.remove('scale-95', 'opacity-0');
        modal.classList.add('scale-100', 'opacity-100');
        document.getElementById('chatbot-input').focus();
        scrollChatToBottom();
      }, 10);
    } else {
      modal.classList.remove('scale-100', 'opacity-100');
      modal.classList.add('scale-95', 'opacity-0');
      setTimeout(() => {
        modal.classList.add('hidden');
      }, 200);
    }
  }

  function scrollChatToBottom() {
    const container = document.getElementById('chatbot-messages');
    container.scrollTop = container.scrollHeight;
  }

  function formatMarkdown(text) {
    if (!text) return '';
    let html = text
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
      .replace(/\*(.*?)\*/g, '<em>$1</em>')
      .replace(/`([^`]+)`/g, '<code class="bg-gray-100 text-emerald-800 px-1 py-0.5 rounded text-[11px]">$1</code>')
      .replace(/• (.*?)(?=\n|$)/g, '<li class="ml-3 list-disc">$1</li>')
      .replace(/\n/g, '<br>');
    return html;
  }

  function appendUserMessage(text) {
    const messages = document.getElementById('chatbot-messages');
    const msgDiv = document.createElement('div');
    msgDiv.className = 'flex items-start justify-end gap-2.5 message-user';
    msgDiv.innerHTML = `
      <div class="bg-emerald-800 text-white rounded-2xl rounded-tr-none p-3 shadow-sm text-xs font-medium max-w-[85%] leading-relaxed">
        ${formatMarkdown(text)}
      </div>
      <div class="w-7 h-7 bg-yellow-400 text-emerald-950 rounded-xl flex items-center justify-center text-xs font-bold flex-shrink-0 shadow-sm mt-0.5">
        👤
      </div>
    `;
    messages.appendChild(msgDiv);
    scrollChatToBottom();
  }

  function appendBotMessage(data) {
    const messages = document.getElementById('chatbot-messages');
    const msgDiv = document.createElement('div');
    msgDiv.className = 'flex items-start gap-2.5 message-bot';

    let quickPillsHtml = '';
    if (data.quick_replies && data.quick_replies.length > 0) {
      quickPillsHtml = '<div class="pt-1 flex flex-wrap gap-1.5">';
      data.quick_replies.forEach(reply => {
        quickPillsHtml += `
          <button type="button" onclick="sendQuickReply('${reply}')" 
                  class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
            ${reply}
          </button>`;
      });
      quickPillsHtml += '</div>';
    }

    let actionBtnHtml = '';
    if (data.action && data.action.url) {
      actionBtnHtml = `
        <div class="pt-2">
          <a href="${data.action.url}" target="_blank" rel="noopener noreferrer" 
             class="inline-flex items-center justify-center gap-1.5 bg-green-600 hover:bg-green-700 text-white font-extrabold text-xs px-3.5 py-2 rounded-xl shadow-sm transition-all hover:scale-105 w-full">
            <span>${data.action.label || 'Hubungi WhatsApp'}</span>
          </a>
        </div>`;
    }

    msgDiv.innerHTML = `
      <div class="w-7 h-7 bg-emerald-800 text-yellow-400 rounded-xl flex items-center justify-center text-xs font-bold flex-shrink-0 shadow-sm mt-0.5">
        🌴
      </div>
      <div class="bg-white border border-emerald-100/80 rounded-2xl rounded-tl-none p-3.5 shadow-sm text-xs text-gray-700 leading-relaxed max-w-[85%] space-y-2">
        <div>${formatMarkdown(data.reply)}</div>
        ${actionBtnHtml}
        ${quickPillsHtml}
      </div>
    `;
    messages.appendChild(msgDiv);
    scrollChatToBottom();
  }

  function showTyping(show) {
    const typing = document.getElementById('chatbot-typing');
    if (show) {
      typing.classList.remove('hidden');
      scrollChatToBottom();
    } else {
      typing.classList.add('hidden');
    }
  }

  function sendQuickReply(text) {
    if (chatbotState.isProcessing) return;
    document.getElementById('chatbot-input').value = text;
    handleChatbotSubmit(new Event('submit'));
  }

  async function handleChatbotSubmit(event) {
    if (event) event.preventDefault();
    const input = document.getElementById('chatbot-input');
    const messageText = input.value.trim();

    if (!messageText || chatbotState.isProcessing) return;

    // Set state
    chatbotState.isProcessing = true;
    input.value = '';
    appendUserMessage(messageText);
    showTyping(true);

    try {
      const response = await fetch('{{ url("/chatbot/message") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': chatbotState.csrfToken,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ message: messageText })
      });

      showTyping(false);

      if (response.ok) {
        const data = await response.json();
        appendBotMessage({
          reply: data.reply || 'Ada yang bisa saya bantu terkait produk kurma dan toko kami?',
          quick_replies: data.quick_replies || [],
          action: data.action || null
        });
      } else {
        appendBotMessage({
          reply: 'Terima kasih atas pertanyaan Anda! Untuk informasi lebih cepat & rinci, silakan hubungi tim Admin kami via WhatsApp.',
          action: {
            label: 'Chat Admin WA 💬',
            url: `https://api.whatsapp.com/send?phone=${chatbotState.waNumberClean}&text=${encodeURIComponent('Halo Admin, ' + messageText)}`
          }
        });
      }
    } catch (error) {
      showTyping(false);
      appendBotMessage({
        reply: 'Terima kasih telah menghubungi kami! Anda dapat langsung terhubung dengan Admin via WhatsApp.',
        action: {
          label: 'Chat WA Admin 💬',
          url: `https://api.whatsapp.com/send?phone=${chatbotState.waNumberClean}&text=${encodeURIComponent('Halo Admin, ' + messageText)}`
        }
      });
    } finally {
      chatbotState.isProcessing = false;
    }
  }

  function resetChatbotMessages() {
    const messages = document.getElementById('chatbot-messages');
    messages.innerHTML = `
      <div class="text-center my-1">
        <span class="bg-emerald-100/70 text-emerald-800 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
          Percakapan Dibersihkan
        </span>
      </div>
      <div class="flex items-start gap-2.5 message-bot">
        <div class="w-7 h-7 bg-emerald-800 text-yellow-400 rounded-xl flex items-center justify-center text-xs font-bold flex-shrink-0 shadow-sm mt-0.5">
          🌴
        </div>
        <div class="bg-white border border-emerald-100/80 rounded-2xl rounded-tl-none p-3.5 shadow-sm text-xs text-gray-700 leading-relaxed max-w-[85%] space-y-2">
          <p class="font-semibold text-emerald-950">
            Assalamu'alaikum! Percakapan telah diperbarui 🌙
          </p>
          <p>
            Ada yang bisa saya bantu kembali seputar produk kurma dan layanan Pusat Kurma?
          </p>
          <div class="pt-1 flex flex-wrap gap-1.5">
            <button type="button" onclick="sendQuickReply('Rekomendasi Kurma')" 
                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
              🌴 Rekomendasi Kurma
            </button>
            <button type="button" onclick="sendQuickReply('Lokasi Toko')" 
                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
              📍 Lokasi Toko
            </button>
            <button type="button" onclick="sendQuickReply('COD & Pengiriman')" 
                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200/80 rounded-xl px-2.5 py-1 text-[11px] font-bold transition-all hover:scale-105">
              🚚 COD & Pengiriman
            </button>
          </div>
        </div>
      </div>`;
  }
</script>
