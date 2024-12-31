<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container  mx-auto my-auto flex flex-wrap  justify-between px-4">
    <div class="text-2xl sm:text-3xl md:text-5xl font-bold text-yellow-0">BUKU</div>


<nav class="relative bg-black sm:bg-transparent text-white p-4 rounded-lg">
    <div class="flex justify-between items-center">
        <button id="menuButton" class="font-bold text-white hover:text-gray-200 focus:outline-none sm:hidden">
            Menu
        </button>
        <div id="desktopMenu" class="hidden sm:flex space-x-4">

        @if (Auth::user()->role === 'admin')
        <a href="/dashboard" class="font-bold text-yellow-0 hover:text-gray-500 transition-all duration-200">Dashboard</a>
        <a href="/rekap" class="font-bold text-yellow-0 hover:text-gray-500 transition-all duration-200">Rekap</a>
        @endif

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

    <div id="mobileMenu" class="container hidden flex flex-col space-y-2 mt-4 sm:hidden ">
        @if (Auth::user()->role === 'admin')
        <a href="/dashboard" class="font-bold hover:text-gray-300 transition-all duration-200">Home</a>
        <a href="/rekap" class="font-bold hover:text-gray-300 transition-all duration-200">Rekap</a>
        @endif
        {{-- @auth
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="flex items-center">
            @csrf
            <button type="submit" class="logout-button font-bold hover:text-gray-300 transition-all duration-200">
                Logout
            </button>
        </form>
        @endauth --}}
    </div>
</div>
</nav>

<script>


    document.getElementById('menuButton').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    });

    // SweetAlert untuk tombol Logout
    document.querySelectorAll('.logout-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

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
                    document.getElementById('logoutForm').submit();
                }
            });
        });
    });
</script>

