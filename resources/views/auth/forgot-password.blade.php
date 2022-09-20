<x-guest-layout>

    <div class="container-fluid">
        <div class="row">
           <div class="col-7">
              <x-slide></x-slide>
           </div>
           <div class="col ">

               <div class="login container">
             
                     <div class="login-logo">
                          <img src="vendor/adminlte/dist/img/logo.png" alt="">
                          <h2>Bitacora Electrónica de Pesca </h2>
                       </div>
           
                   <div class="mb-4 text-sm text-gray-600">
                       {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace de restablecimiento de contraseña que le permitirá elegir una nueva.') }}
                   </div>
           
                   @if (session('status'))
                       <div class="mb-4 font-medium text-sm text-green-600">
                           {{ session('status') }}
                       </div>
                   @endif
           
                   <x-jet-validation-errors class="mb-4" />
           
                   <form method="POST" action="{{ route('password.email') }}">
                       @csrf
           
                       <div class="block">
                           <x-jet-label class="form-label" for="email" value="{{ __('Email') }}" />
                           <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                       </div>
           
                       <div class="flex items-center justify-end mt-4">
                           <x-jet-button class="btn btn-primary">
                               {{ __('Recuperar contraseña') }}
                           </x-jet-button>
                       </div>
                   </form>
               </div>
            </div>
        </div>
    </div>  
</x-guest-layout>

