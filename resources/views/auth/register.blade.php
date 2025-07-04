@extends('layouts.theme')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <!-- logo -->
                    <div class="text-center p-3">
                        <img src="assets/images/logo.png" alt="Notes logo">
                    </div>

                    <!-- form -->
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <form action="/store" id="formCadastro" method="post" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control bg-dark text-info" name="name"
                                        value="{{ old('name') }}" required>
                                    {{-- show error --}}
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control bg-dark text-info" name="email"
                                        value="{{ old('email') }}" required>
                                    {{-- show error --}}
                                    @if (session('erro'))
                                        <div class="text-danger">
                                            {{ session('erro') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <label for="password_pri" class="form-label">Senha</label>
                                    <input type="password" class="form-control bg-dark text-info" name="password_pri"
                                        value="{{ old('password_pri') }}" required>
                                    {{-- show error --}}
                                    @error('password_pri')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password_sec" class="form-label">Confirme senha</label>
                                    <input type="password" class="form-control bg-dark text-info" name="password_sec"
                                        value="{{ old('password_sec') }}" required>
                                    {{-- show error --}}
                                    @error('password_sec')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <p id="alerta" class="text-danger d-none"> As senhas precisam ser iguais!! </p>
                                </div>


                                <div class="mb-3">
                                    <button id="btn-register" type="button" onclick="enviaCadastro()"
                                        class="btn btn-secondary w-100">
                                        LOGIN
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- copy -->
                    <div class="text-center text-secondary mt-3">
                        <small>&copy; <?= date('Y') ?> Notes</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
