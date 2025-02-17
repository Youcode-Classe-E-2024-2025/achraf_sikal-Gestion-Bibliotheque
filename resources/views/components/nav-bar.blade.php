<nav class="bg-gray-800 text-white p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="/" class="hover:text-gray-300">Library Manager</a>
        </div>

        <div class="flex space-x-4">
            <!-- Navigation Links -->
            <x-nav-link href="/" label="Home"/>
            <x-nav-link href="/contact" label="Contact"/>
            <x-nav-link href="/about" label="About"/>

            <!-- Authentication Links -->
            @auth
                <x-nav-link href="/profile" label="Profile"/>
                <form action="/logout" method="POST">
                    @csrf
                    <button>Logout</button>
                </form>
            @else
                <x-nav-link href="/login" label="Login"/>
                <x-nav-link href="/signup" label="Signup"/>
            @endauth
        </div>
    </div>
</nav>
