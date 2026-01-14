@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-teal-custom">Settings</h2>
    </div>

    <div class="bg-white p-8 rounded-[15px] shadow-md max-w-2xl">
        <h3 class="font-bold text-lg mb-6 text-gray-700 border-b pb-2">Admin Profile</h3>
        
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">New Password (Optional)</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50" placeholder="Minimum 6 characters">
            </div> <!-- Close Password Div -->

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Change Profile Picture</label>
                <div class="flex items-center gap-4">
                    @if($user->avatar)
                        <div class="flex flex-col gap-2">
                             <img src="{{ $user->avatar }}" alt="Current Avatar" class="w-16 h-16 rounded-full object-cover shadow-sm bg-white">
                             <button type="submit" form="remove-avatar-form" class="text-xs text-red-500 hover:text-red-700 font-bold underline">Hapus Foto</button>
                        </div>
                    @endif
                    <input type="file" name="avatar" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" id="save-btn" disabled class="bg-teal-custom text-white py-2 px-6 rounded-lg font-bold shadow-md opacity-50 cursor-not-allowed transition-all">
                    Save Changes
                </button>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form[action="{{ route('settings.update') }}"]');
                const inputs = form.querySelectorAll('input');
                const saveBtn = document.getElementById('save-btn');
                const initialValues = {};

                // Store initial values
                inputs.forEach(input => {
                    if (input.type === 'file') return; // Skip file input for initial value
                    initialValues[input.name] = input.value;
                });

                function checkChanges() {
                    let hasChanges = false;
                    inputs.forEach(input => {
                        if (input.type === 'file') {
                            if (input.value) hasChanges = true;
                        } else {
                            if (input.value !== initialValues[input.name]) hasChanges = true;
                        }
                    });

                    if (hasChanges) {
                        saveBtn.disabled = false;
                        saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        saveBtn.classList.add('hover:bg-teal-dark');
                    } else {
                        saveBtn.disabled = true;
                        saveBtn.classList.add('opacity-50', 'cursor-not-allowed');
                        saveBtn.classList.remove('hover:bg-teal-dark');
                    }
                }

                inputs.forEach(input => {
                    input.addEventListener('input', checkChanges);
                    input.addEventListener('change', checkChanges);
                });
            });
        </script>

        <form id="remove-avatar-form" action="{{ route('settings.remove_avatar') }}" method="POST" class="hidden" onsubmit="return confirm('Hapus foto profil?');">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
