<x-guest-layout>
    @session('status')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ $value }}
        </div>
    @endsession

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="emailImput" class="form-label">Correo</label>
          <input type="email" name="email" class="form-control" id="emailImput" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="passwordImput" class="form-label">Contraseña</label>
          <input type="password" name="password" class="form-control" id="passwordImput">
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" name="remember" class="form-check-input" id="check">
          <label class="form-check-label" for="check">Recordar sesión</label>
        </div>
        <button type="submit" class="mb-1 btn bg-cus-primary w-100">Iniciar sesión</button>
        <div class="text-end">
            <a class="link-dark" href="{{ route('password.request') }}">
                Olvide mi contraseña
            </a>
        </div>
    </form>
</x-guest-layout>