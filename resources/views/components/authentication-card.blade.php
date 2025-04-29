<!-- authentication-card.blade.php -->
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-900 via-green-700 to-gray-300"></div>

    
    <!-- Gambar-background -->
    <div class="absolute inset-0">
        <img src="images/login-register.jpg" alt="Gambar Anda" class="object-cover w-full h-full opacity-25" />
    </div>

     <!-- Logo -->
    <div class="absolute top-30 right-20">
        {{ $logo }}
    </div>

    <!-- title dan Konten Utama -->
    <div class="relative z-10" style="right: 28%;">
        <!-- title -->
        <div>
            {{ $title }}
        </div>

        <!-- Content -->
        <div style="width: 100%;"> <!-- Mengisi lebar penuh -->
            <!-- Slot for Content (e.g., Form) -->
            {{ $slot }}
        </div>
    </div>
</div>
