<div class="min-h-screen bg-slate-950 flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-teal-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
    </div>

    <!-- Brand / Header -->
    <div class="sm:mx-auto sm:w-full sm:max-w-md z-10 text-center">
        <div class="flex justify-center mb-4">
            <span class="p-3.5 bg-gradient-to-tr from-emerald-500 to-teal-400 rounded-2xl text-slate-950 font-bold shadow-xl shadow-emerald-500/10">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </span>
        </div>
        <h2 class="text-3xl font-extrabold text-white tracking-tight">DigiSign Admin</h2>
        <p class="mt-2 text-sm text-slate-400">Silakan login untuk mengelola dokumen dan tanda tangan digital.</p>
    </div>

    <!-- Login Form Card -->
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md z-10">
        <div class="bg-slate-900/60 border border-slate-800/80 p-8 shadow-2xl rounded-3xl backdrop-blur-md">
            
            <!-- Default Credentials Notice -->
            @if($autoSeeded)
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs leading-relaxed">
                    <div class="font-bold flex items-center mb-1">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Sistem Pertama Kali Dijalankan
                    </div>
                    Database kosong. Akun default admin telah dibuat secara otomatis:
                    <div class="font-mono mt-1 text-slate-200">
                        Email: <span class="underline">admin@digisign.com</span><br>
                        Password: <span class="underline">password</span>
                    </div>
                </div>
            @endif

            <form wire:submit="login" class="space-y-6">
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input wire:model="email" id="email" type="email" placeholder="Contoh: admin@digisign.com" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
                    @error('email') <span class="text-xs text-rose-450 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <input wire:model="password" id="password" type="password" placeholder="••••••••" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-150">
                    @error('password') <span class="text-xs text-rose-450 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input wire:model="remember" id="remember_me" type="checkbox" class="h-4 w-4 rounded bg-slate-950 border-slate-800 text-emerald-500 focus:ring-emerald-500 focus:ring-offset-slate-900">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-350 select-none">Ingat saya</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-semibold rounded-xl text-slate-950 bg-gradient-to-r from-emerald-400 to-teal-300 hover:from-emerald-300 hover:to-teal-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 focus:ring-offset-slate-900 transition-all duration-150 shadow-lg shadow-emerald-500/10 cursor-pointer disabled:opacity-50">
                        <span wire:loading wire:target="login" class="animate-spin h-4 w-4 border-2 border-slate-950 border-t-transparent rounded-full mr-2"></span>
                        <span>Masuk Aplikasi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
