<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Capitan;
use App\Notifications\ResetPasswordCapitan;
use App\Password\ResetPassword;
use Exception;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordController extends Controller
{

    public function reset(Request $request) {

       try{
           
           $reset = new ResetPassword();
           $response = $reset -> strategy($request);
    
           switch ($response) {
               case Password::PASSWORD_RESET:
                   return back()->with('success', 'Contraseña restablecida correctamente.');
               case Password::INVALID_TOKEN:
                   return back()->withErrors(['token' => 'El token de restablecimiento es inválido o ha expirado.']);
               case Password::INVALID_USER:
                   return back()->withErrors(['email' => 'No se encuentra un capitán con este correo.']);
               default:
                   return back()->withErrors(['email' => 'Hubo un error al intentar restablecer la contraseña.']);
           }
       }
       catch(Exception $e) {
          return back()->withErrors($e -> getMessage());
       }


    }

    public function resetCapitan(Request $request) {

       // Buscar el capitán por el email
       $capitan = Capitan::where('email', $request->usuario)->first();

       if (!$capitan) {
           return response()->json(['message' => 'Capitán no encontrado.'], 404);
       }
   
       // Usar el broker para el capitán
       $passwordBroker = Password::broker('capitanes');
   
       $response = $passwordBroker->sendResetLink(
           ['email' => $capitan->email]
       );
       
       // Verificar la respuesta del broker
       if ($response == Password::RESET_LINK_SENT) {
           return response()->json(['message' => 'Enlace de restablecimiento enviado correctamente.']);

       } else {
           return response()->json(['message' => 'Hubo un error al enviar el enlace de restablecimiento.'], 400);
       }

    }

    
}
