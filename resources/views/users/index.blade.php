
@extends('layout.base')

@section('title', 'Liste des utilisateurs')

@section('content-main')

<div class="container mt-4">
    <h2 class="mb-4">Liste des utilisateurs</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Date création</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }} {{ $user->prenoms ?? '' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>

                    <td>

                        <a href="{{ route('admin.user.password.edit', $user->id) }}"
                           class="btn btn-sm btn-warning">
                            Réinitialiser mot de passe
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Aucun utilisateur trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
