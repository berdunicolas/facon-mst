<x-guest-layout>

    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
          <label for="emailImput" class="form-label">Nombre</label>
          <input class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mb-3">
          <label for="emailImput" class="form-label">Correo</label>
          <input class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" >
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-3">
          <label for="passwordImput" class="form-label">Contraseña</label>
          <input class="form-control" type="password" name="password" required autocomplete="new-password" >
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mb-3">
          <label for="passwordImput" class="form-label">Confirmar contraseña</label>
          <input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <button type="submit" class="mt-3 mb-1 btn bg-cus-primary w-100">Registrarse</button>
        <div class="text-end">
            <a class="link-dark" href="{{ route('login') }}">
                Ya tengo una cuenta
            </a>
        </div>
        
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
          <div class="mt-4">
              <x-label for="terms">
                  <div class="">
                      <x-checkbox name="terms" id="terms" required />

                      <span class="ms-2">
                          {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                  'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="">'.__('Terms of Service').'</a>',
                                  'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="">'.__('Privacy Policy').'</a>',
                          ]) !!}
                      </span>
                  </div>
              </x-label>
          </div>
        @endif
    </form>
</x-guest-layout>