<?php
namespace App\Password;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\Capitan;
use App\Models\Reset;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;


class ResetPassword {

    use ResetsPasswords;


    public function __construct() {

    }


    public function strategy(Request $request) 
    {
        $reset = Reset::where('email', $request->email)->first();

        if ($reset && Hash::check($request->token, $reset->token)) {
            
            if( $reset -> type == 'admin') return $this -> reset($request);

            return $this -> resetCapitan($request);
        } 
        
    }
    

      /**
     * Actualiza el password
     *
     * @param Request $request
     * @return void
     */
    private function resetCapitan(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required|string',  
        ]);

        $capitan = Capitan::where('email',$request ->email)->first();
    
        if (!$capitan) {
            return back()->withErrors(['email' => 'No se encuentra un capitán con este correo.']);
        }
    
        // Validar el token con el broker de contraseñas
        $passwordBroker = Password::broker('capitanes');
    
        // Intentar resetear la contraseña con el token y el email
        $response = $passwordBroker->reset(
            $request->only('email', 'password', 'token'),  // Validar el token y realizar el restablecimiento
            function ($capitan, $password) {
                // Actualizar la contraseña en la tabla de capitanes
                $capitan->clave = Hash::make($password);
                $capitan->save();
    
                // Disparar el evento de restablecimiento de contraseña
                event(new PasswordReset($capitan));
            }
        );
    
        return $response;
    }

}