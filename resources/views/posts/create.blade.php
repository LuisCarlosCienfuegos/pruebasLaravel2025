@extends('layouts.app')

@section('title', 'Crear Post')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Crear nuevo Post</h1>
        </div>
        <div class="card-body">
            <form id="post-form">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('post-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            const id = Date.now(); // ID simple basado en timestamp

            const post = { id, title, content };

            // Guardar en sessionStorage
            const posts = getFromSession('posts') || [];
            posts.push(post);
            saveToSession('posts', posts);

            // Redirigir al listado
            window.location.href = "{{ route('posts.index') }}";
        });
    </script>
@endsection
