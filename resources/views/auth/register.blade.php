@extends('layouts.app')


<main>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
        <section class="section register d-flex flex-column align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="">
                            <span class="d-none d-lg-block">NiceAdmin</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                <p class="text-center small">Enter your personal details to create an account</p>
                            </div>

                            <form method="POST" action="{{ route('register.post') }}" class="row g-3 needs-validation" novalidate>
                                @csrf

                                <div class="col-12">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                </div>

                                <div class="col-12">
    <label for="user_type" class="form-label">User Type</label>
    <select name="user_type" class="form-select @error('user_type') is-invalid @enderror" id="user_type" required>
        <option value="" disabled selected>Select User Type</option>
        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="customer" {{ old('user_type') == 'customer' ? 'selected' : '' }}>Customer</option>
    </select>
    @error('user_type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="credits text-center mt-4">
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>

                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
