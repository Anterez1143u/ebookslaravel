@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-center rounded-top-4" style="background: #1B365D;">
                    <h3 class="mb-0" style="color: #F4C95D;">Panel de inicio</h3>
                </div>
                <div class="card-body text-center" style="background: #fff;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-titulo mb-2" style="font-size: 1.2rem;">
                        ¡Has iniciado sesión correctamente!
                    </p>
                    <p class="text-muted">
                        Bienvenido/a a la plataforma de Editorial Moderna.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
