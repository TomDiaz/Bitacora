<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
          <div class="login-logo">
               <img src="vendor/adminlte/dist/img/logo.png" alt="">
               <h2>Bitacora Electrónica de Pesca </h2>
            </div>
        </x-slot>

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
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
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
</style>