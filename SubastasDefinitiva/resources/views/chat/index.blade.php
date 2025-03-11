@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Chat</h1>

    <!-- Lista de usuarios disponibles -->
    <div class="mb-4">
        <h4>Usuarios Disponibles</h4>
        <ul>
            @foreach($usuarios as $usuario)
                @if($usuario->id !== Auth::id()) <!-- Excluye al usuario actual -->
                    <li>
                        <a href="{{ route('chat.index', ['user_id' => $usuario->id]) }}">
                            {{ $usuario->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <!-- Mostrar los mensajes del chat -->
    <div class="card">
        <div class="card-body">
            <!-- Mostrar los mensajes del chat -->
            <div id="chat-messages" style="height: 400px; overflow-y: scroll;">
                @foreach ($messages as $message)
                    <div class="message {{ $message->emisor_id == Auth::id() ? 'sent' : 'received' }}">
                        <p><strong>{{ $message->emisor->name }}:</strong> {{ $message->mensaje }}</p>
                        <small>{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>

            <!-- Formulario para enviar un mensaje -->
            <form action="{{ route('chat.send') }}" method="POST">
                @csrf
                <input type="hidden" name="to_user_id" value="{{ request()->query('user_id') }}">
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection
