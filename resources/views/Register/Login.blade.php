@extends('Layouts.MasterLayout')

@section('title', 'Login - CuddluDuddly')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
            Login
        </h2>

        {{-- Error / Success Message --}}
        <div id="alert-box" class="hidden p-3 mb-4 rounded"></div>

        <form id="loginForm" class="space-y-4">
            @csrf

            {{-- Email or Phone --}}
            <div>
                <label class="block text-sm font-medium">Email or Phone</label>
                <input type="text" name="login" placeholder="Enter email or phone"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" placeholder="Enter password"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Signup</a>
        </p>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const payload = Object.fromEntries(formData.entries());

    const response = await fetch("{{ url('api/login') }}", {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(payload)
    });

    const data = await response.json();
    const alertBox = document.getElementById('alert-box');

    if (response.ok) {
        alertBox.className = "bg-green-100 text-green-700 p-3 mb-4 rounded";
        alertBox.textContent = data.message;
        alertBox.classList.remove("hidden");
        this.reset();
        // redirect if needed: window.location.href = "/";
    } else {
        alertBox.className = "bg-red-100 text-red-700 p-3 mb-4 rounded";
        alertBox.innerHTML = data.message || "Invalid credentials";
        alertBox.classList.remove("hidden");
    }
});
</script>
@endsection
