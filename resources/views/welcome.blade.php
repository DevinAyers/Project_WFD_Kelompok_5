<!--Bagian dari Halaman Utama Sebelum Login -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Athletix | Sistem Booking Lapangan Olahraga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-30 bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <h1 class="text-3xl font-extrabold text-blue-700 tracking-wide hover:text-blue-800 transition cursor-pointer select-none">
      Athletix
    </h1>
    <nav class="space-x-4">
      <a href="{{ route('login') }}" 
         class="inline-block px-5 py-2 rounded-md bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
        Login
      </a>
      <a href="{{ route('register') }}" 
         class="inline-block px-5 py-2 rounded-md bg-gray-200 text-gray-800 font-semibold shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
        Register
      </a>
    </nav>
  </div>
</header>

    <div class="h-20"></div>

    <!-- Hero Section -->
    <section class="relative w-full h-[500px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/lapanganAwal.jpg') }}" alt="Background" class="w-full h-full object-cover filter blur-sm scale-110">
            <div class="absolute inset-0 bg-black opacity-30"></div> <!-- dark overlay -->
        </div>

        <!-- Foreground content -->
        <div class="relative z-10 text-white px-4">
            <h2 class="text-4xl font-extrabold mb-4 drop-shadow-lg">Selamat Datang di Athletix</h2>
            <p class="text-lg max-w-2xl mx-auto drop-shadow">
                Sistem Booking Lapangan Olahraga yang Modern, Cepat, dan Mudah Digunakan.
            </p>
        </div>
    </section>

    <div class="h-20"></div>

        <!-- Info Cards Section -->
<section class="bg-green-950 py-20">
    <div class="text-center text-black mb-14 px-4">
        <h2 class="text-2xl md:text-3xl font-semibold tracking-wide">Kesehatan itu Penting</h2>
        <h1 class="text-4xl md:text-5xl font-bold mt-3 mb-6">Semuanya penting</h1>
        <p class="max-w-2xl mx-auto text-lg md:text-xl leading-relaxed">
            Kami percaya bahwa olahraga bukan hanya soal aktivitas, tapi juga soal pengalaman.
            Melalui layanan sewa lapangan yang cepat dan andal, kami bantu Anda mendapatkan tempat terbaik untuk berolahraga, berkumpul, dan berkembang bersama tim Anda.
        </p>
    </div>

    <div class="h-20"></div>


    <div class="overflow-x-auto px-6">
        <div class="flex space-x-1 w-max md:w-auto">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg min-w-[280px] md:min-w-[300px] max-w-sm">
                <img src="{{ asset('images/card1.jpg') }}"
                     alt="Label penting"
                     class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Temukan lapangan terbaik di dekatmu dengan fasilitas lengkap dan lokasi strategis.</h3>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg min-w-[280px] md:min-w-[300px] max-w-sm">
                <img src="{{ asset('images/card2.jpg') }}"
                     alt="Berbuat lebih baik itu penting"
                     class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Proses pemesanan hanya butuh beberapa klik. Tanpa ribet, tanpa antre.</h3>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg min-w-[280px] md:min-w-[300px] max-w-sm">
                <img src="{{ asset('images/card3.jpg') }}"
                     alt="Bekerja sama itu penting"
                     class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Pastikan kegiatan olahragamu berjalan lancar, nyaman, dan menyenangkan.</h3>
                </div>
            </div>
        </div>
    </div>
</section>




    <!-- About Section -->
    <section id="about" class="max-w-4xl mx-auto p-4 mt-16">
    <h3 class="text-3xl font-semibold mb-4 text-center text-gray-800">About</h3>
    <p class="text-gray-700 text-lg leading-relaxed">
        Athletix adalah platform booking lapangan olahraga modern yang dirancang untuk memudahkan pengguna dalam menemukan dan memesan lapangan dengan cepat dan efisien. Kami berkomitmen untuk memberikan pengalaman terbaik dengan fitur lengkap, sistem pembayaran yang aman, dan layanan pelanggan responsif.
    </p>
    <p class="text-gray-700 text-lg leading-relaxed mt-4">
        Bergabunglah dengan komunitas kami dan nikmati kemudahan akses lapangan olahraga favorit Anda kapan saja dan di mana saja!
    </p>
</section>


    <!-- Footer -->
<footer class="mt-16 py-6 text-white text-center" style="background-color: #1e3a8a;">
    <div class="mb-2">
        <a href="https://wa.me/628123456789" target="_blank" class="text-green-600 hover:underline mx-2">WhatsApp</a>
        <a href="https://instagram.com/athletix.id" target="_blank" class="text-pink-600 hover:underline mx-2">Instagram</a>
        <a href="https://facebook.com/athletix" target="_blank" class="text-blue-600 hover:underline mx-2">Facebook</a>
    </div>
    <div class="mb-2 text-sm text-gray-200">
        <span>Hubungi kami: </span><a href="tel:+628123456789" class="hover:underline text-white">+62 812-3456-789</a>
    </div>
    <p class="text-sm text-gray-300">&copy; 2025 Athletix. All rights reserved.</p>
</footer>
</body>
</html> 

</body>
</html>
