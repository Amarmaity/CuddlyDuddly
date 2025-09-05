<header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-3 px-4">
        
        {{-- Left: Logo --}}
        <div class="flex items-center space-x-4">
            <a href="/" class="text-2xl font-bold text-blue-600">
                CuddlyDuddly
            </a>
        </div>

        {{-- Center: Search Bar --}}
        <div class="flex-1 max-w-xl mx-6">
            <div class="flex">
                <input type="text" placeholder="Search products..."
                    class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="bg-blue-600 text-white px-4 rounded-r-lg">Search</button>
            </div>
        </div>

        {{-- Right: Options --}}
        <div class="flex items-center space-x-6 text-sm font-medium">
            {{-- Location --}}
            <select class="border rounded px-2 py-1 focus:outline-none">
                <option>Location</option>
                <option>New York</option>
                <option>London</option>
                <option>Tokyo</option>
            </select>   

            {{-- Support --}}
            <a href="#" class="hover:text-blue-600">Support</a>

            {{-- Track Order --}}
            <a href="#" class="hover:text-blue-600">Track Order</a>

           
          {{-- Login/Register --}}
{{-- User Icon with Hover Dropdown --}}
{{-- <div class="relative group">
    <a href="#" class="hover:text-blue-600 text-xl">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" 
             stroke-width="1.5" stroke="currentColor" 
             class="w-6 h-6">
            <path stroke-linecap="round" 
                  stroke-linejoin="round" 
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 
                     3.75 3.75 0 017.5 0zM4.5 20.25a8.25 
                     8.25 0 1115 0v.75H4.5v-.75z" />
        </svg>
    </a>
    <div
        class="absolute right-0 text-center p-2 bg-white border rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200"
    >
        <a href="{{ url('/view-login') }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
            Login
        </a>
        <a href="{{ url('/view-register') }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
            Signup
        </a>
    </div>
</div> --}}
            {{-- User Account Dropdown --}}
<div class="relative group">
    {{-- User Icon --}}
    <a href="#" class="hover:text-blue-600 text-xl flex items-center space-x-1">
        <!-- Heroicon: User -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" 
             stroke-width="1.5" stroke="currentColor" 
             class="w-6 h-6">
            <path stroke-linecap="round" 
                  stroke-linejoin="round" 
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 
                     3.75 3.75 0 017.5 0zM4.5 20.25a8.25 
                     8.25 0 1115 0v.75H4.5v-.75z" />
        </svg>
        <span class="text-sm font-medium">Account & Lists</span>
    </a>

    {{-- Dropdown Menu --}}
    <div class="absolute right-0 w-48 bg-white border rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50">
        <a href="{{ url('/view-login') }}" 
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
            Sign In
        </a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
            Your Account
        </a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
            Your Orders
        </a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
            Your Wish List
        </a>
        <a href="{{route('seller')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
            Your Seller Account
        </a>
    </div>
</div>



            {{-- Shortlist --}}
            <a href="#" class="relative hover:text-blue-600">
                ❤️
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full px-1">2</span>
            </a>

            {{-- Cart --}}
            <a href="#" class="relative hover:text-blue-600">
                🛒
                <span class="absolute -top-2 -right-3 bg-green-500 text-white text-xs rounded-full px-1">3</span>
            </a>
        </div>
    </div>
</header>
