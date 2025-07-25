@extends('admin/layout/master')
@section('title', 'category list')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="row">
            <div class="col-9 offset-3">
                @if (session('updateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i>{{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'female')
                                            <img src="{{ asset('image/female_default.png') }} "
                                                class="img-thumbnail shadow-sm">
                                        @else
                                            <img src="{{ asset('image/default_user.png') }} "
                                                class="img-thumbnail shadow-sm">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="img-thumbnail shadow-sm" />
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-3"> <i
                                            class="fa-solid fa-file-signature me-2"></i>{{ Auth::user()->name }}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}
                                    </h4>
                                    <h4 class="my-3"><i
                                            class="fa-solid fa-person-half-dress me-2"></i>{{ Auth::user()->gender }}</h4>
                                    <h4 class="my-2"><i
                                            class="fa-solid fa-square-phone-flip me-2"></i>{{ Auth::user()->phone_number }}
                                    </h4>
                                    <h4 class="my-2"><i
                                            class="fa-solid fa-address-book me-2"></i>{{ Auth::user()->address }}</h4>
                                    <h4 class="my-2"><i
                                            class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                    </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 offset-2 mt-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark text-white"><i
                                                class="fa-solid fa-pen-to-square"></i>Edit
                                            Profile</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
