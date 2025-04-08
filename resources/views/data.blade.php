<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .header-gradient {
            background: linear-gradient(135deg, #cb1111 0%, #fc2525 100%);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #6c757d;
        }

        .table-container {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>

<body>
    {{-- <div class="header-gradient text-white py-4 mb-4">
        <div class="container">
            <h1><i class="fas fa-users me-2"></i> Gestión de Usuarios</h1>
        </div>
    </div> --}}

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between mb-4">
            {{-- <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nuevo Usuario
            </a> --}}

            <form action="{{ route('users.generateTestUsers') }}" method="POST" class="d-flex">
                @csrf
                {{-- <div class="input-group">
                    <input type="number" name="count" class="form-control" placeholder="Cantidad" min="1" max="100" value="10">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-magic me-2"></i> Generar Datos
                    </button>
                </div> --}}
            </form>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            {{-- <th>Estado</th> --}}
                            <th>Registro</th>
                            {{-- <th>Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>{{ $user->name }} {{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                {{-- <td>
                                    @if ($user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Verificado
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-exclamation-circle me-1"></i> Pendiente
                                        </span>
                                    @endif
                                </td> --}}
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                {{-- <td>
                                    <div class="btn-group">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">No hay usuarios registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- @if ($users->hasPages())
                <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                    <div>
                        Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} registros
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            @endif --}}
            @if ($users->hasPages())
                <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                    <div class="text-muted">
                        Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }}
                        registros
                    </div>

                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            {{-- Botón Anterior --}}
                            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            {{-- Números de página --}}
                            @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Botón Siguiente --}}
                            <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
