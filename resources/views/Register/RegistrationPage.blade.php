@extends('Layouts.MasterLayout')

@section('title', 'Register - CuddluDuddly')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
                Registration Form
            </h2>

            {{-- Server-side success message --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Server-side errors --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Registration Form --}}
            <form id="registrationForm" class="space-y-4">
                @csrf

                {{-- Full Name --}}
                <div>
                    <label class="block text-sm font-medium">Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- User Type --}}



                <input type="hidden" name="role" value="{{$role}}">


                {{-- Phone --}}
                <div>
                    <label class="block text-sm font-medium">Phone</label>
                    <input type="text" name="phone" placeholder="Enter 10-digit phone number"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" placeholder="Enter password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-sm font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Re-enter password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Register
                </button>
            </form>

            {{-- Already have an account --}}
            <p class="text-sm text-gray-600 mt-4 text-center">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
            </p>
        </div>
    </div>

    {{-- AJAX + SweetAlert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registrationForm');
            if (!form) return;

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const payload = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch("{{ url('api/register') }}", {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            timer: 2500,
                            showConfirmButton: false
                        });
                        this.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: data.message || (data.errors ? Object.values(data.errors).flat().join('<br>') : "Something went wrong")
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unexpected error occurred!'
                    });
                }
            });
        });
    </script>
@endsection