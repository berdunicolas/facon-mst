<x-guest-layout>
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
    </form>
</x-guest-layout>