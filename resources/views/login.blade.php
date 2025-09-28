<!-- Vista del login -->
<div>
    <h2>Iniciar Sesión</h2>
    <form action="{{route('login.store')}}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" placeholder="Contraseña" required>
        <br>
        <input type="checkbox" name="remember"> Recordarme
        <br>
        <input type="submit" value="Iniciar Sesión"></input>
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
</div>
