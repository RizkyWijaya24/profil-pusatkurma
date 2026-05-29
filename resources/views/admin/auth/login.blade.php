<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin — Pusat Kurma Premium</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>* { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="min-h-screen bg-emerald-950 flex items-center justify-center p-4">

  <div class="w-full max-w-md">
    {{-- Logo --}}
    <div class="text-center mb-8">
      <div class="w-16 h-16 bg-yellow-400 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl">
        <span class="text-emerald-900 font-black text-3xl">🌴</span>
      </div>
      <h1 class="text-2xl font-black text-white">Admin Panel</h1>
      <p class="text-white/60 text-sm font-medium mt-1">Pusat Kurma Premium Cianjur</p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-2xl p-8">
      <h2 class="text-xl font-extrabold text-emerald-950 mb-1">Selamat Datang 👋</h2>
      <p class="text-gray-500 text-sm mb-6">Masukkan kredensial admin Anda untuk melanjutkan.</p>

      @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-5">
          <p class="text-red-600 text-sm font-medium">{{ $errors->first() }}</p>
        </div>
      @endif

      <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-gray-700 font-semibold text-sm mb-1.5">Email</label>
          <input
            type="email" name="email" value="{{ old('email') }}" required autofocus
            placeholder="admin@kurma.com"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
          />
        </div>
        <div>
          <label class="block text-gray-700 font-semibold text-sm mb-1.5">Password</label>
          <input
            type="password" name="password" required
            placeholder="••••••••"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
          />
        </div>
        <div class="flex items-center gap-2">
          <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-emerald-600 rounded" />
          <label for="remember" class="text-gray-600 text-sm font-medium">Ingat saya</label>
        </div>
        <button type="submit"
          class="w-full bg-emerald-900 hover:bg-emerald-800 text-white font-extrabold py-3.5 rounded-xl transition-all duration-200 hover:shadow-lg text-sm mt-2">
          Masuk ke Admin Panel
        </button>
      </form>
    </div>

    <p class="text-center text-white/40 text-xs mt-6">© {{ date('Y') }} Pusat Kurma Premium Cianjur</p>
  </div>

</body>
</html>
