@extends('layouts.app')  <!-- Hereda de la plantilla base (creo de resources\views\layouts\app.blade.php )-->

@section('title', 'Posts') <!-- Define el título -->

@section('content')  <!-- Define el contenido para @yield('content') -->
    <div class="card">
            <!-- Contenido HTML con Bootstrap -->
        <div class="card-header">
            <h1>Posts</h1>
        </div>
        <div class="card-body">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Crear nuevo post</a>  <!-- Genera la URL -->

            <div id="posts-list" class="mt-4">
                <!-- Aquí se mostrarán los posts desde sessionStorage -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const posts = getFromSession('posts') || [];
            const postsList = document.getElementById('posts-list');

            if (posts.length === 0) {
                postsList.innerHTML = '<p>No hay posts aún.</p>';
            } else {
                let html = '<ul class="list-group">';
                posts.forEach(post => {
                    html += `
                        <li class="list-group-item">
                            <h5>${post.title}</h5>
                            <p>${post.content}</p>
                            <a href="/posts/${post.id}" class="btn btn-sm btn-info">Ver</a>
                        </li>
                    `;
                });
                html += '</ul>';
                postsList.innerHTML = html;
            }
        });
    </script>
@endsection
