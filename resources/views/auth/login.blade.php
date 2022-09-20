<x-guest-layout>

   <div class="container-fluid">
        <div class="row">
           <div class="col-7">
              <x-slide></x-slide>
           </div>
           <div class="col">
             <div class="login container">
          
                      <div class="login-logo">
                         <img src="vendor/adminlte/dist/img/logo.png" alt="">
                         <h2>Bitácora Electrónica de Pesca </h2>
                      </div>
              
                     <x-jet-validation-errors class="mb-4 " />
              
                     @if (session('status'))
                         <div class="mb-4 font-medium text-sm text-green-600">
                             {{ session('status') }}
                         </div>
                     @endif
              
                     <form method="POST" action="{{ route('login') }}">
                         @csrf
              
                         <div>
                             <x-jet-label class="form-label" for="email" value="{{ __('Email') }}" />
                             <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                         </div>
              
                         <div class="mt-4">
                             <x-jet-label class="form-label" for="password" value="{{ __('Password') }}" />
                             <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                         </div>
              
                         <div class="block mt-4">
                             <label for="remember_me" class="flex items-center">
                                 <x-jet-checkbox id="remember_me" name="remember" />
                                 <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                             </label>
              
                            
                         </div>
              
                         <div class="flex items-center justify-end mt-4">
                           
              
                             <x-jet-button class="btn btn-primary">
                                 {{ __('Log in') }}
                             </x-jet-button>
                         </div>
                          <br>   
                         <div class="regitrarse">
                         @if (Route::has('password.request'))
                                 <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                     {{ __('Recuperar contraseña') }}
                                 </a>
                             @endif
                             <span class="ml-2 text-sm text-gray-600"> <a  href="{{ env('APP_URL')}}register"> ¿No tienes una cuenta? Registrate</a> </span>
                         </div>
                     </form>
          
             </div>
           </div>
       </div>
   </div>


 

</x-guest-layout>


<style>



</style>