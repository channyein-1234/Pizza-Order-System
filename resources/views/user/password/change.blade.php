@extends('user.layout.master')
@section('content')
    <div class="col-6 offset-3">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change password</h3>
                                </div>
                                {{-- information status  --}}
                                @if (session('changeSuccess'))
                                    <div class="col-12 ">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-check me-2"></i>{{ session('changeSuccess') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                                @if (session('notMatch'))
                                    <div class="col-12 ">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('notMatch') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <form action="{{ route('user#changePassword') }}" method="POST" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password"
                                            class="form-control  @error('oldPassword') is-invalid @enderror "
                                            aria-required="true" aria-invalid="false" placeholder="Enter old password...">

                                        @error('oldPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }};
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password"
                                            class="form-control @error('newPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter new password...">
                                        @error('newPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }};
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password"
                                            class="form-control @error('confirmPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Confirm password...">
                                        @error('confirmPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }};
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <a href="{{ route('user#changePassword') }}">
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-dark text-white btn-block">
                                                <i class="fa-solid fa-lock"></i><span class="ms-2"
                                                    id="payment-button-amount">Change Password</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>
@endsection
