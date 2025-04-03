@extends('layouts.app')

@section('title', 'Ver Post')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Ver Post</h1>
        </div>
        <div class="card-body" id="post-details">
            <!-- Aquí se mostrará el post -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postId = window.location.pathname.split('/').pop();
            const posts = getFromSession('posts') || [];
            const post = posts.find(p => p.id == postId);

            const postDetails = document.getElementById('post-details');

            if (post) {
                postDetails.innerHTML = `
                    <h2>${post.title}</h2>
                    <p>${post.content}</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver</a>
                `;
            } else {
                postDetails.innerHTML = '<p>Post no encontrado</p>';
            }
        });
    </script>
@endsection
