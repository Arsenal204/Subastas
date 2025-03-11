<form action="{{ route('categorias.eliminar', $categoria->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
