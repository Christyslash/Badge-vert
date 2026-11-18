<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .required {
            color: #e74c3c;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .checkbox-group label {
            margin-bottom: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>

        {{-- Messages de succès --}}
        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Messages d'erreur globaux --}}
        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register.attempt') }}" method="POST">
            @csrf

            {{-- Nom complet --}}
            <div class="form-group">
                <label for="name">
                    Nom complet <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="Entrez votre nom complet"
                    required
                >
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            {{--Prenoms--}}
            <div class="form-group">
                <label for="prenoms">
                    Prenoms <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    id="prenoms" 
                    name="prenoms" 
                    value="{{ old('prenoms') }}"
                    placeholder="Entrez vos prenoms"
                    required
                >
                @error('prenoms')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            {{-- Email --}}
            <div class="form-group">
                <label for="email">
                    Adresse email <span class="required">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="exemple@domaine.com"
                    required
                >
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div class="form-group">
                <label for="password">
                    Mot de passe <span class="required">*</span>
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    placeholder="Minimum 6 caractères"
                    required
                >
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirmation du mot de passe --}}
            <div class="form-group">
                <label for="password_confirmation">
                    Confirmer le mot de passe <span class="required">*</span>
                </label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation"
                    placeholder="Confirmez votre mot de passe"
                    required
                >
            </div>

            {{-- Bouton de soumission --}}
            <button type="submit" class="btn">
                S'inscrire
            </button>
        </form>

        {{-- Lien vers la connexion --}}
        <div class="login-link">
            Vous avez déjà un compte ? 
            <a href="{{ route('login') }}">Se connecter</a>
        </div>
    </div>
</body>
</html>