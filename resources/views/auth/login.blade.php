@extends('base')
@section('title', 'Login')

<style>
    .centered-div {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>

<div class="centered-div">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4><strong>Login</strong></h4>
                    </div>

                    @if(session('success'))
                    <script>
                        alert("{{ session('success') }}");
                    </script>
                    @endif

                    @if (session('fail'))
                    <script>
                        alert("{{ session('fail') }}");
                    </script>
                    @endif


                    <div class="card-body">
                        <form method="post" action="{{ route('auth.login')}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="{{ route('auth.register') }}">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>