@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">
        Réinitialisation du mot de passe de : {{ $user->name }}
    </h2>

    <form method="POST" action="{{ route('admin.user.password.update', $user) }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nouveau mot de passe</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
            @error('password')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
        </div>

        <button class="bg-blue-600 text-white px-6 py-2 rounded">
            Mettre à jour
        </button>

        <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 underline">
            Retour
        </a>
    </form>

</div>
@endsection
