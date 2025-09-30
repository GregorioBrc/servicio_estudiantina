<x-mail::message>    
# Recuperar password

<x-mail::panel>
Se ha creado un nuevo correo para recuperar la password
</x-mail::panel>


<x-mail::button :url="route('password.reset')"
    color="success">
Click aca para recuperar la  password
</x-mail::button>    

{{-- <a href="{{ route('usuario.perfil') }}"></a>  --}}
    {{-- Le hace falta el id del usuario ^ pasarlo al mail --}}
</x-mail::message>
