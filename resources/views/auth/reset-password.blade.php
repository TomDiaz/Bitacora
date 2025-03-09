<x-guest-layout>

   <!-- Registration 13 - Bootstrap Brain Component -->
   <section class="bg-light py-3 py-md-5 min-vh-100 d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border border-light-subtle rounded-3 shadow-sm">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="text-center mb-3">
                  <a href="index.html">
                    <img src="/vendor/adminlte/dist/img/logo.png" alt="BootstrapBrain Logo" width="175" height="57">
                  </a>
                </div>
                <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Bitácora Electrónica de Pesca</h2>

                <x-jet-validation-errors class="mb-4" />

                @if(session('success'))
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
  {{ session('success') }}
  </div>
</div>


                @else
                <form method="POST" action="{{ route('password.update') }}">
                         @csrf

                         <input type="hidden" name="token" value="{{ $request->route('token') }}">

                         <hr>

                         <div>
                             <x-jet-label class="form-label" for="email" value="{{ __('Email') }}" />
                             <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                         </div>

                         <div class="mt-4">
                             <x-jet-label for="password" value="{{ __('Password') }}" />
                             <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                         </div>

                         <div class="mt-4">
                             <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                             <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                         </div>

                         <br>
                         
                        <div class="flex items-center justify-end mt-">
                            <x-jet-button class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </x-jet-button>
                        </div>

                   </form>
@endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

 

</x-guest-layout>


<style>

    img {
        width: 100px;
        margin: auto;
    }

</style>