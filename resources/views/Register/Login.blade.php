@extends('Layouts.MasterLayout')

@php $minimal = true; @endphp

@section('title', 'Login - CuddluDuddly')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
            Login
        </h2>

        <form id="loginForm" class="space-y-4">
            @csrf

            {{-- Email or Phone --}}
            <div>
                <label class="block text-sm font-medium">Email or Phone</label>
                <input id="loginInput" type="text" name="login" placeholder="Enter email or phone"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium">Password</label>
                <input id="passwordInput" type="password" name="password" placeholder="Enter password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Signup</a>
            <span class="mx-1">/</span>
            <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Home</a>
        </p>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const loginInput = document.getElementById('loginInput');
        const passwordInput = document.getElementById('passwordInput');

        const formData = new FormData(this);
        const payload = Object.fromEntries(formData.entries());

        let response, data;
        try {
            response = await fetch("{{ url('api/login') }}", {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(payload)
            });
            data = await response.json();
        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Network Error',
                text: 'Please try again!',
            });
            return;
        }

        if (response.ok && data.token) {
            // Save token
            localStorage.setItem("api_token", data.token);

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message || "Login successful",
                timer: 2000,
                showConfirmButton: false
            });

            this.reset();

            // Redirect based on role
            if (data.role && data.id) {
                if (data.role === 'admin') window.location.href = `/admin/${data.id}/dashboard`;
                if (data.role === 'vendor') window.location.href = `/vendor/${data.id}/dashboard`;
                if (data.role === 'customer') window.location.href = `/customer/${data.id}/dashboard`;
            }
        } else {
            // Field-specific errors
            if (data.errors) {
                if (data.errors.login) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Error',
                        text: data.errors.login[0],
                    });
                    loginInput.focus();
                } else if (data.errors.password) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Error',
                        text: data.errors.password[0],
                    });
                    passwordInput.focus();
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || "Invalid credentials",
                });
            }
        }
    });
</script>
@endsection
