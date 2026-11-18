<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge Vert Project</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('assets/dawn-sky-sunset-163771.jpg');
            background-color: rgba(3, 1, 1, 0.2);
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            color: blue;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .btn-group {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            padding: 15px 30px;
            font-size: 16px;
            border: 2px solid blue;
            background: transparent;
            color: blue;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 600;
        }

        .btn:hover {
            background: white;
            color: #667eea;
        }

        .btn-primary {
            background: white;
            color: #667eea;
        }

        .btn-primary:hover {
            background: transparent;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Création Badge Vert</h1>
        <p>Bienvenue sur notre plateforme</p>

        <div class="btn-group">
            @auth
                {{--<a href="{{ url('/configuration/layout') }}" class="btn btn-primary">
                    Tableau de bord
                </a>--}}
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn">
                        Se déconnecter
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">
                    
                    Se connecter
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary">
                    S'inscrire
                </a>
            @endauth
        </div>
    </div>
</body>
</html>