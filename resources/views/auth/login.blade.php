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
                            <form action="/loginSubmit" method="post" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="text_email" class="form-label">Email</label>
                                    <input type="email" class="form-control bg-dark text-info" name="text_email"
                                        value="{{ old('text_email') }}" required>
                                    {{-- show error --}}
                                    @error('text_email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <label for="text_password" class="form-label">Senha</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password"
                                        value="{{ old('text_password') }}" required>
                                    {{-- show error --}}
                                    @error('text_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex flex-column align-items-end mb-3">
                                    <a href="#" class="text-secondary mb-1">Recuperar Senha</a>
                                    <a href="{{ route('register') }}" class="text-secondary">Registre-se</a>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100">LOGIN</button>
                                </div>
                            </form>

                            {{-- invalid login --}}
                            @if (session('loginError'))
                                <div class="alert alert-danger text-center">
                                    {{ session('loginError') }}
                                </div>
                            @endif
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
