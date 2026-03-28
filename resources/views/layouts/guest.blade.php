<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Todo App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Bebas+Neue&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    html, body {
        height: 100%; margin: 0; padding: 0;
        font-family: 'DM Mono', monospace;
    }
    .nb-login-wrap {
        min-height: 100dvh;
        background: #F5F0E8;
        background-image: radial-gradient(#00000018 1.5px, transparent 1.5px);
        background-size: 18px 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }
    .nb-card {
        background: #FFF176;
        border: 3px solid #000;
        box-shadow: 8px 8px 0 #000;
        width: 100%;
        max-width: 420px;
        overflow: hidden;
    }
    .nb-card-header {
        background: #000;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .nb-logo {
        width: 40px; height: 40px;
        background: #FFF176;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 24px;
        color: #000;
        flex-shrink: 0;
        border: 2px solid #FFF176;
    }
    .nb-card-header h1 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 28px;
        color: #FFF176;
        margin: 0;
        letter-spacing: 2px;
        line-height: 1;
    }
    .nb-card-header p {
        font-size: 10px;
        color: #ffffff66;
        margin: 4px 0 0;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .nb-card-body { padding: 1.75rem 1.5rem; }

    .nb-tag {
        display: inline-block;
        background: #000;
        color: #FFF176;
        font-size: 10px;
        padding: 3px 10px;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }
    .nb-label {
        display: block;
        font-size: 11px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #000;
        margin-bottom: 6px;
    }
    .nb-input-wrap { position: relative; }
    .nb-input {
        width: 100%;
        border: 2.5px solid #000;
        box-shadow: 3px 3px 0 #000;
        background: #fff;
        padding: 11px 14px;
        font-family: 'DM Mono', monospace;
        font-size: 14px;
        outline: none;
        transition: box-shadow 0.1s, border-color 0.1s;
        display: block;
    }
    .nb-input:focus {
        box-shadow: 5px 5px 0 #FF3C00;
        border-color: #FF3C00;
    }
    .nb-input-error {
        border-color: #FF3C00 !important;
        box-shadow: 3px 3px 0 #FF3C00 !important;
    }
    .nb-field { margin-bottom: 1.25rem; }
    .nb-error-msg {
        background: #FF3C00;
        color: #fff;
        font-size: 11px;
        padding: 5px 10px;
        margin-top: 6px;
        border: 1.5px solid #000;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .nb-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    /* Checkbox custom */
    .nb-check-label {
        display: flex; align-items: center; gap: 8px;
        font-size: 12px; color: #000; cursor: pointer;
        user-select: none;
    }
    .nb-check-label input[type="checkbox"] {
        width: 18px; height: 18px;
        border: 2.5px solid #000;
        background: #fff;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        flex-shrink: 0;
        position: relative;
        margin: 0;
    }
    .nb-check-label input[type="checkbox"]:checked {
        background: #000;
    }
    .nb-check-label input[type="checkbox"]:checked::after {
        content: '✓';
        position: absolute;
        color: #FFF176;
        font-size: 13px;
        font-weight: 900;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        line-height: 1;
    }

    .nb-btn {
        width: 100%;
        background: #FF3C00;
        border: 2.5px solid #000;
        box-shadow: 4px 4px 0 #000;
        color: #fff;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 22px;
        letter-spacing: 3px;
        padding: 13px;
        cursor: pointer;
        transition: transform 0.08s, box-shadow 0.08s;
        display: flex; align-items: center; justify-content: center; gap: 10px;
    }
    .nb-btn:hover:not(:disabled)  { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 #000; }
    .nb-btn:active:not(:disabled) { transform: translate(3px,3px);   box-shadow: 1px 1px 0 #000; }
    .nb-btn:disabled { opacity: 0.55; cursor: not-allowed; }

    .nb-divider {
        border: none;
        border-top: 2px dashed #00000025;
        margin: 1.5rem 0 1.1rem;
    }
    .nb-footer {
        text-align: center;
        font-size: 11px;
        color: #00000055;
        letter-spacing: 1px;
    }

    /* shake animation on error */
    @keyframes nb-shake {
        0%,100% { transform: translateX(0); }
        20%      { transform: translateX(-6px); }
        40%      { transform: translateX(6px); }
        60%      { transform: translateX(-4px); }
        80%      { transform: translateX(4px); }
    }
    .nb-shake { animation: nb-shake 0.35s ease; }
</style>
    @livewireStyles
</head>
<body>
    {{ $slot }}
    @livewireScripts
</body>
</html>