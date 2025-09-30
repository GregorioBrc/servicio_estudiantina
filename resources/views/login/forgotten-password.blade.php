<form action="{{ route("password.email" )}}" method="POST">
    @csrf
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <button type="submit">Enviar enlace de recuperación</button>

</form>