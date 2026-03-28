<div>
  {{-- Background presets --}}
  <style>
    /* ── Reset agar scroll container bisa kerja ── */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    /* ── Scroll container utama ── */
    .nb-scroll-area {
      height: 100dvh; /* menyusut otomatis saat keyboard muncul */
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      display: flex;
      flex-direction: column;
    }

    /* ── Area konten mengisi sisa ruang ── */
    .nb-content {
      flex: 1;
      padding: 1rem;
      padding-bottom: 0.5rem;
    }

    /* ── Background presets ── */
    .bg-1 { background-color: #FFF176; }
    .bg-2 { background-color: #fff; background-image: repeating-linear-gradient(45deg,#000 0,#000 1px,transparent 0,transparent 50%); background-size: 12px 12px; }
    .bg-3 { background-color: #fff; background-image: radial-gradient(#000 1.5px,transparent 1.5px); background-size: 14px 14px; }
    .bg-4 { background-color: #FF3C00; background-image: repeating-linear-gradient(0deg,transparent,transparent 18px,rgba(0,0,0,.12) 18px,rgba(0,0,0,.12) 20px),repeating-linear-gradient(90deg,transparent,transparent 18px,rgba(0,0,0,.12) 18px,rgba(0,0,0,.12) 20px); }
    .bg-5 { background-color: #E3F2FD; background-image: repeating-linear-gradient(90deg,rgba(0,0,0,.08) 0,rgba(0,0,0,.08) 1px,transparent 1px,transparent 20px),repeating-linear-gradient(0deg,rgba(0,0,0,.08) 0,rgba(0,0,0,.08) 1px,transparent 1px,transparent 20px); }
    .bg-6 { background-color: #1a1a1a; background-image: repeating-linear-gradient(45deg,#FFF176 0,#FFF176 1px,transparent 0,transparent 50%); background-size: 10px 10px; }

    /* ── Dark theme overrides (bg-6) ── */
    .bg-6 .nb-title        { color: #FFF176; }
    .bg-6 .nb-subtitle     { color: #FFF176; opacity: 0.5; }
    .bg-6 .nb-fixed-bar    { border-top-color: #FFF176; background: #1a1a1a; }
    .bg-6 .nb-input        { border-color: #FFF176; box-shadow: 3px 3px 0 #FFF176; background: #2a2a2a; color: #FFF176; }
    .bg-6 .nb-btn-add      { border-color: #FFF176; box-shadow: 3px 3px 0 #FFF176; }
    .bg-6 .nb-counter-box  { border-color: #FFF176; box-shadow: 3px 3px 0 #FFF176; }
    .bg-6 .nb-picker-item  { border-color: #FFF176 !important; box-shadow: 3px 3px 0 #FFF176 !important; }
    .bg-6 .nb-todo-item    { border-color: #FFF176; box-shadow: 4px 4px 0 #FFF176; }
    .bg-6 .nb-checkbox     { border-color: #FFF176; }

    /* ── Neobrutalism helpers ── */
    .nb-border    { border: 2.5px solid #000; }
    .nb-shadow    { box-shadow: 4px 4px 0 #000; }
    .nb-shadow-sm { box-shadow: 3px 3px 0 #000; }

    /* ── Form bar — sticky bukan fixed ── */
    .nb-fixed-bar {
      position: sticky;
      bottom: 0;
      left: 0;
      right: 0;
      border-top: 2.5px solid #000;
      background: #FFF176;
      padding: 0.75rem;
      /* ruang aman bawah untuk notch iPhone */
      padding-bottom: calc(0.75rem + env(safe-area-inset-bottom));
      z-index: 50;
    }
  </style>

  {{-- ── Scroll container utama ── --}}
  <div class="nb-scroll-area bg-{{ $bg }}" id="nb-scroll-area">

    {{-- ── Area konten ── --}}
    <div class="nb-content">

      {{-- Header --}}
<div class="flex items-start justify-between mb-1">
    <div>
        <h1 class="nb-title text-3xl font-black uppercase tracking-tight leading-none mb-1"
            style="font-family:'Space Grotesk',sans-serif">To-Do List</h1>
        <p class="nb-subtitle text-xs font-bold uppercase tracking-widest opacity-40 mb-0.5">My Tasks</p>
        <p class="nb-subtitle text-xs font-bold uppercase tracking-widest opacity-30 mb-4">Made by Anshoria</p>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="nb-border nb-shadow-sm bg-black text-[#FFF176] font-black text-xs uppercase tracking-widest px-3 py-2 mt-1
                   active:translate-x-0.5 active:translate-y-0.5 active:shadow-none">
            Logout
        </button>
    </form>
</div>

      {{-- Background picker --}}
      <div class="flex gap-2 mb-5">
        @foreach ([1,2,3,4,5,6] as $i)
        <button
          wire:click="changeBg('{{ $i }}')"
          class="nb-picker-item nb-border nb-shadow-sm w-9 h-9 cursor-pointer
                 {{ $bg == $i ? 'ring-2 ring-offset-1 ring-black' : '' }}"
          style="
            @if($i == 1) background:#FFF176;
            @elseif($i == 2) background:repeating-linear-gradient(45deg,#000 0,#000 1px,#fff 0,#fff 50%);background-size:8px 8px;
            @elseif($i == 3) background:radial-gradient(#000 1.5px,#fff 1.5px);background-size:8px 8px;
            @elseif($i == 4) background:#FF3C00;
            @elseif($i == 5) background:#E3F2FD;
            @elseif($i == 6) background:#1a1a1a;
            @endif
          ">
        </button>
        @endforeach
      </div>

      {{-- Counter --}}
      @if($todos->count())
      <div class="flex items-center gap-3 mb-5">
        <div class="nb-counter-box nb-border nb-shadow-sm bg-[#FF3C00] text-white
                    px-4 py-1.5 font-black text-2xl inline-block"
             style="font-family:'Space Grotesk',sans-serif">
          {{ $todos->where('done', false)->count() }}
        </div>
        <span class="nb-subtitle text-xs font-bold uppercase tracking-widest opacity-60">Tugas tersisa</span>
      </div>
      @endif

    <div wire:poll.3s> {{-- refresh setiap 3 detik --}}
      {{-- Todo list --}}
      @forelse ($todos as $todo)
      <div class="nb-todo-item nb-border nb-shadow flex items-center gap-3 bg-white px-3 py-3 mb-3
                  {{ $todo->done ? 'opacity-60 !bg-green-50' : '' }}">

        {{-- Toggle --}}
        <button
          wire:click="toggle({{ $todo->id }})"
          class="nb-checkbox nb-border w-7 h-7 flex items-center justify-center font-black text-sm flex-shrink-0
                 {{ $todo->done ? 'bg-black text-[#FFF176]' : 'bg-white' }}">
          {{ $todo->done ? '✓' : '' }}
        </button>

        {{-- Title --}}
        <span class="flex-1 font-bold text-sm leading-snug
                     {{ $todo->done ? 'line-through opacity-50' : '' }}">
          {{ $todo->title }}
        </span>

        {{-- Hapus --}}
        <button
          wire:click="delete({{ $todo->id }})"
          class="font-black text-xl opacity-20 active:opacity-100 px-1">✕</button>

      </div>
      @empty
      <div class="nb-border nb-shadow bg-white px-4 py-8 text-center font-bold text-sm opacity-50">
        Belum ada tugas! 🎉
      </div>
      @endforelse

      </div>
    </div>
    {{-- ── End nb-content ── --}}

    {{-- ── Form input — sticky di bawah scroll container ── --}}
    <div class="nb-fixed-bar" id="nb-form-bar">
      <form wire:submit="addTodo" class="flex gap-2">
        <input
          wire:model="title"
          id="nb-input"
          placeholder="Tambah tugas baru..."
          class="nb-input nb-border nb-shadow-sm flex-1 bg-white px-3 py-3 font-bold text-sm outline-none"
          required>
        <button type="submit"
          class="nb-btn-add nb-border nb-shadow-sm bg-[#FF3C00] text-white
                 w-12 font-black text-2xl flex items-center justify-center flex-shrink-0
                 active:translate-x-0.5 active:translate-y-0.5">+</button>
      </form>
      @error('title')
        <p class="text-red-600 font-bold text-xs mt-1">{{ $message }}</p>
      @enderror
    </div>

  </div>
  {{-- ── End nb-scroll-area ── --}}

  {{-- ── JS: scroll form ke atas saat keyboard muncul ── --}}
  <script>
(function () {
  /* ── Audio Context (Web Audio API — no external file needed) ── */
  function createCtx() {
    return new (window.AudioContext || window.webkitAudioContext)();
  }

  /* Suara "pop" manis untuk tambah tugas */
  function soundAdd() {
    try {
      const ctx = createCtx();
      const o = ctx.createOscillator();
      const g = ctx.createGain();
      o.connect(g); g.connect(ctx.destination);
      o.type = 'sine';
      o.frequency.setValueAtTime(440, ctx.currentTime);
      o.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.08);
      o.frequency.exponentialRampToValueAtTime(660, ctx.currentTime + 0.18);
      g.gain.setValueAtTime(0.4, ctx.currentTime);
      g.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.25);
      o.start(); o.stop(ctx.currentTime + 0.25);
    } catch(e){}
  }

  /* Suara "check" satisfying untuk toggle done */
  function soundCheck() {
    try {
      const ctx = createCtx();
      [0, 0.06, 0.12].forEach((delay, i) => {
        const o = ctx.createOscillator();
        const g = ctx.createGain();
        o.connect(g); g.connect(ctx.destination);
        o.type = 'triangle';
        o.frequency.value = [523, 659, 784][i];
        g.gain.setValueAtTime(0.3, ctx.currentTime + delay);
        g.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + delay + 0.18);
        o.start(ctx.currentTime + delay);
        o.stop(ctx.currentTime + delay + 0.18);
      });
    } catch(e){}
  }

  /* Suara "uncheck" — nada turun untuk toggle undone */
  function soundUncheck() {
    try {
      const ctx = createCtx();
      const o = ctx.createOscillator();
      const g = ctx.createGain();
      o.connect(g); g.connect(ctx.destination);
      o.type = 'sine';
      o.frequency.setValueAtTime(600, ctx.currentTime);
      o.frequency.exponentialRampToValueAtTime(300, ctx.currentTime + 0.15);
      g.gain.setValueAtTime(0.25, ctx.currentTime);
      g.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.15);
      o.start(); o.stop(ctx.currentTime + 0.15);
    } catch(e){}
  }

  /* Suara "swoosh" singkat untuk delete */
  function soundDelete() {
    try {
      const ctx = createCtx();
      const bufferSize = ctx.sampleRate * 0.15;
      const buffer = ctx.createBuffer(1, bufferSize, ctx.sampleRate);
      const data = buffer.getChannelData(0);
      for (let i = 0; i < bufferSize; i++) data[i] = (Math.random() * 2 - 1) * (1 - i / bufferSize);
      const source = ctx.createBufferSource();
      source.buffer = buffer;
      const filter = ctx.createBiquadFilter();
      filter.type = 'highpass'; filter.frequency.value = 1000;
      const g = ctx.createGain();
      g.gain.setValueAtTime(0.3, ctx.currentTime);
      g.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.15);
      source.connect(filter); filter.connect(g); g.connect(ctx.destination);
      source.start(); source.stop(ctx.currentTime + 0.15);
    } catch(e){}
  }

  /* Suara "click" ringan untuk ganti background */
  function soundBg() {
    try {
      const ctx = createCtx();
      const o = ctx.createOscillator();
      const g = ctx.createGain();
      o.connect(g); g.connect(ctx.destination);
      o.type = 'square';
      o.frequency.setValueAtTime(220, ctx.currentTime);
      o.frequency.exponentialRampToValueAtTime(110, ctx.currentTime + 0.06);
      g.gain.setValueAtTime(0.15, ctx.currentTime);
      g.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.06);
      o.start(); o.stop(ctx.currentTime + 0.06);
    } catch(e){}
  }

  /* ── Livewire event listeners ── */
  document.addEventListener('todo-added',   function (e) {
    soundAdd();
    // Scroll ke item terbaru setelah DOM diupdate
    setTimeout(function () {
     var items = document.querySelectorAll('.nb-todo-item');
if (items.length) {
    var newest = items[0]; // ← item pertama = terbaru
    newest.scrollIntoView({ behavior: 'smooth', block: 'center' });
    newest.style.outline = '3px solid #FF3C00';
    setTimeout(function () { newest.style.outline = ''; }, 800);
}
    }, 80);
  });

  document.addEventListener('todo-toggled', function (e) {
    e.detail.done ? soundCheck() : soundUncheck();
  });

  document.addEventListener('todo-deleted', function () { soundDelete(); });
  document.addEventListener('bg-changed',   function () { soundBg(); });

  /* ── Keyboard scroll handling (existing) ── */
  var input      = document.getElementById('nb-input');
  var formBar    = document.getElementById('nb-form-bar');
  var scrollArea = document.getElementById('nb-scroll-area');
  if (!input || !formBar || !scrollArea) return;

  function scrollFormIntoView() {
    setTimeout(function () {
      formBar.scrollIntoView({ behavior: 'smooth', block: 'end' });
    }, 350);
  }

  input.addEventListener('focus', scrollFormIntoView);

  if (window.visualViewport) {
    window.visualViewport.addEventListener('resize', function () {
      if (window.visualViewport.height < window.innerHeight * 0.85) {
        setTimeout(function () {
          formBar.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }, 100);
      }
    });
  }

  document.addEventListener('livewire:update', function () {
    if (document.activeElement === input) {
      scrollArea.scrollTop = scrollArea.scrollHeight;
    }
  });
})();
</script>

</div>