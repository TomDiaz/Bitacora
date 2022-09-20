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
                         <h2>Bitácora Electrónica de Pesca </h2>
                    </div>
               
                   <x-jet-validation-errors class="mb-4" />
               
                   <form method="POST" action="{{ route('register') }}">
                       @csrf
                       
                       <div class="row">
                           <div class="col">
                               <x-jet-label class="form-label" for="name" value="{{ __('Nombres') }}" />
                               <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                           </div>
                           <div class="col">
                               <x-jet-label class="form-label" for="last_name" value="{{ __('Apellidos') }}" />
                               <x-jet-input id="last_name" class="form-control" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                           </div>
                       </div>
                       <br>
                       <div class="row">
                           <div class="col">
                               <x-jet-label class="form-label" for="empresa" value="{{ __('Empresa') }}" />
                               <x-jet-input id="empresa" class="form-control" type="text" name="empresa" :value="old('empresa')" required autofocus autocomplete="empresa" />
                           </div>
                           
                           <div class="col">
                               <x-jet-label class="form-label" for="email" value="{{ __('Email') }}" />
                               <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                           </div>
                       </div>
                       
                       
                       <div class="mt-4">
                           <x-jet-label class="form-label" for="password" value="{{ __('Password') }}" />
                           <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                       </div>
               
                       <div class="mt-4">
                           <x-jet-label class="form-label" for="password_confirmation" value="{{ __('Confirmar Password') }}" />
                           <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                       </div>
               
               
                      
               
                       <div class="flex items-center justify-end mt-4">
                          
               
                           <x-jet-button class="btn btn-primary">
                               {{ __('Registrarse') }}
                           </x-jet-button>
                       </div>

                       <div class="regitrarse">
                        <br>
                       <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                               {{ __('¿Ya estas registrado?') }}
                           </a>
                       @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                           <div class="mt-4">
                               <x-jet-label for="terms">
                                   <div class="flex items-center">
                                       <x-jet-checkbox name="terms" id="terms"/>
               
                                       <div class="ml-2">
                                           {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                   'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                   'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                           ]) !!}
                                       </div>
                                   </div>
                               </x-jet-label>
                           </div>
                       @endif

                       </div>
                   </form>
               </div>
           </div>
        </div>
    </div>

</x-guest-layout>

