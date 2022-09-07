<x-guest-layout>
    <x-jet-authentication-card>

       
        <x-slot name="logo">
            <div class="login-logo">
               <img src="vendor/adminlte/dist/img/logo.png" alt="">
               <h2>Bitácora Electrónica de Pesca </h2>
            </div>
            
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

               
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Recuperar contraseña') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
             <br>   
            <div class="regitrarse">
                <span class="ml-2 text-sm text-gray-600"> <a  href="{{ env('APP_URL')}}register"> ¿No tienes una cuenta? Registrate</a> </span>
            </div>
        </form>
    </x-jet-authentication-card>
 

</x-guest-layout>


<style>
    .login-logo img{
  width: 50%;
  display: block;
  margin: auto;
  margin-top: -100px;
  padding: 20px;
}

.login-logo{
  text-align: center;
}

.login-logo h2{
  font-size: 25px;
  font-weight: 900;
  color: #4484c5;
}
.regitrarse a{
    transition: .5s;
}
.regitrarse a:hover{
  font-weight: 900;
}
</style>