<h1>Login Admin</h1>
<form method="POST" action="{{ route('ProcesarLogin') }}">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
    </div>

    <div>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">Iniciar sesión</button>
</form>