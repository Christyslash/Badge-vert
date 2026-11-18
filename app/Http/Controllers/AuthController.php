<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     */
    public function showRegisterForm()
    {
        if (auth()->check()) {
        // Seul un administrateur peut accéder au formulaire
        if (auth()->user()->role !== 'Administrateur') {
            return redirect()->back()->with('error', "Vous n'avez pas l'autorisation d'accéder à l'inscription.");
        }
    }

    // Si non connecté → accès normal
    return view('auth.register');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function register(Request $request)
    {

         if (auth()->check() && auth()->user()->role !== 'Administrateur') {
        return redirect()->back()->with('error', "Action non autorisée.");
        }
        //dd($request->all());
        // Validation des données
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenoms'=>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'=>['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8',
                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/',
                        'confirmed'],

        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule,
                un chiffre et un caractère spécial (@$!%*?&#).',
        ]);

        try {
            DB::beginTransaction();
            //dd($validated);
            // Créer l'utilisateur
            $user = User::create([
                'name' => $validated['name'],
                'prenoms'=>$validated['prenoms'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                //'password' => $validated['password']
                'password' => Hash::make($validated['password']),
            ]);
            //dd($user);
            // Connexion automatique après l'inscription
            Auth::login($user);

            DB::commit();

            // Redirection avec message de succès
            return redirect()
                ->route('login')
                ->with('success', 'Votre compte a été créé avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log de l'erreur
            Log::error('Erreur lors de l\'enregistrement : ' . $e->getMessage());

            // Redirection avec message d'erreur
            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de la création du compte. Veuillez réessayer.')
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Afficher le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Connexion de l'utilisateur
     */
    public function login(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()
                ->intended('configuration');
               // ->with('success', 'Bienvenue ' . Auth::user()->name);

            /*elseif($request){
                return view ('register');
            }*/
        }


        // Échec de la connexion
        return back()
            ->withErrors([
                'email' => 'Les identifiants fournis sont incorrects.',
            ])
            ->withInput($request->except('password'));
    }


    public function showConfirmPasswordForm()
{
    return view('auth.confirm-password');
}

public function confirmPassword(Request $request)
{
    $request->validate([
        'password' => 'required',
    ]);

    if (!Hash::check($request->password, $request->user()->password)) {
        return back()->withErrors([
            'password' => 'Mot de passe incorrect.',
        ]);
    }

    $request->session()->passwordConfirmed();

    return redirect()->intended();
}


    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
