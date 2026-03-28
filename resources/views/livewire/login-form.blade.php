
<div class="nb-login-wrap">
    <div class="nb-card">

        {{-- Header --}}
        <div class="nb-card-header">
            <div class="nb-logo">T</div>
            <div>
                <h1>Todo App</h1>
                <p>Masuk ke akun kamu</p>
            </div>
        </div>

        {{-- Body --}}
        <div class="nb-card-body">
            <span class="nb-tag">// Login</span>

            {{-- Email --}}
            <div class="nb-field">
                <label class="nb-label" for="email">Email</label>
                <input
                    wire:model="email"
                    id="email"
                    type="email"
                    placeholder="kamu@email.com"
                    class="nb-input {{ $errors->has('email') ? 'nb-input-error nb-shake' : '' }}"
                    autocomplete="email">
                @error('email')
                    <div class="nb-error-msg">
                        <span>⚠</span> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="nb-field">
                <label class="nb-label" for="password">Password</label>
                <input
                    wire:model="password"
                    id="password"
                    type="password"
                    placeholder="••••••••"
                    class="nb-input {{ $errors->has('password') ? 'nb-input-error nb-shake' : '' }}"
                    autocomplete="current-password">
                @error('password')
                    <div class="nb-error-msg">
                        <span>⚠</span> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="nb-row">
                <label class="nb-check-label">
                    <input wire:model="remember" type="checkbox">
                    Ingat saya
                </label>
            </div>

                @if ($alertMessage)
                    <div class="nb-error-msg" style="margin-bottom: 1rem; {{ $alertType === 'success' ? 'background:#16a34a' : '' }}">
                        <span>{{ $alertType === 'error' ? '⚠' : '✓' }}</span>
                        {{ $alertMessage }}
                    </div>
                @endif

            {{-- Submit --}}
            <button
                wire:click="login"
                wire:loading.attr="disabled"
                class="nb-btn">
                <span wire:loading.remove>MASUK</span>
                <span wire:loading>MEMPROSES...</span>
                <svg wire:loading.remove width="18" height="18" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="3">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>

            <hr class="nb-divider">
            <p class="nb-footer">Belum punya akun? <strong>Hubungi admin</strong></p>
        </div>

    </div>
</div>