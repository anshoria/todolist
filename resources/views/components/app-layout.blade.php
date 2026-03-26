<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,
        maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <title>To-Do</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700;800&family=Syne:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    * { -webkit-tap-highlight-color: transparent; touch-action: manipulation; box-sizing: border-box; }
    body { font-family: 'Syne', sans-serif; -webkit-text-size-adjust: 100%; }
  </style>
  @livewireStyles
</head>
<body>
  {{ $slot }}
  @livewireScripts
</body>
</html>