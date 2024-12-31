<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container  mx-auto my-auto flex flex-wrap  justify-between px-4">
    <div class="text-2xl sm:text-3xl md:text-5xl font-bold text-yellow-0">Buku</div>


<nav class="relative bg-black sm:bg-transparent text-white p-4 rounded-lg">
    <div class="flex justify-between items-center">
        <!-- Tombol Dropdown -->
        <button id="menuButton" class="font-bold text-white hover:text-gray-200 focus:outline-none sm:hidden">
            Menu
        </button>

        <!-- Navigasi Desktop -->
        <div id="desktopMenu" class="hidden sm:flex space-x-4">
        <a href="/dashboard" class="font-bold text-black hover:text-gray-500 transition-all duration-200">Dashboard</a>
        <a href="/rekap" class="font-bold text-black hover:text-gray-500 transition-all duration-200">Rekap</a>


            <!-- Tombol Logout -->
            @auth
            <form id="logoutForm" action="{{ route('logout.post') }}" method="POST" class="flex items-center">
                @csrf
                <button type="submit" class="logout-button text-black font-bold hover:text-gray-300 transition-all duration-200">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </div>


    <!-- Navigasi Dropdown Mobile -->
    <div id="mobileMenu" class="container hidden flex flex-col space-y-2 mt-4 sm:hidden ">
        <a href="/dashboard" class="font-bold hover:text-gray-300 transition-all duration-200">Home</a>
        <a href="/rekap" class="font-bold hover:text-gray-300 transition-all duration-200">Rekap</a>

        <!-- Tombol Logout -->
        @auth
        <form id="logoutForm" action="{{ route('logout.post') }}" method="POST" class="flex items-center">
            @csrf
            <button type="submit" class="logout-button font-bold hover:text-gray-300 transition-all duration-200">
                Logout
            </button>
        </form>
        @endauth
    </div>
</div>
</nav>

<script>

    // Script untuk mengatur dropdown
    document.getElementById('menuButton').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    });

    // SweetAlert untuk tombol Logout
    document.querySelectorAll('.logout-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form untuk submit secara langsung

            // Menampilkan konfirmasi SweetAlert
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Anda akan keluar dari akun ini!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Logout',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, submit form logout
                    document.getElementById('logoutForm').submit();
                }
            });
        });
    });
</script>

