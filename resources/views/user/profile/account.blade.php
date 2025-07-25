@extends('user.layout.master')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>

                            @if (session('updateSuccess'))
                                <div class="col-3 offset-8">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check me-2"></i>{{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <hr>
                            <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row  ">
                                    <div class="col-4 offset-1">
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
                                                class="col-6 offset-3 img-thumbnail shadow-sm " />
                                        @endif
                                        {{-- file btn  --}}
                                        <div class="mt-3">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">Update <i
                                                    class="fa-solid fa-arrow-up-from-bracket m-2"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="name" type="text"
                                                value='{{ old('name', Auth::user()->name) }}'
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter  Admin Name...">

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input name="email" type="text"
                                                value='{{ old('email', Auth::user()->email) }}'class="form-control @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Admin Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="">Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="choose gender">Choose Gender</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>

                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone_number" type="number"
                                                value='{{ old('phone-number', Auth::user()->phone_number) }}'
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Admin Phone...">
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" type="text" class="form-control" @error('address') is-invalid @enderror aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Address...">{{ old('address', Auth::user()->address) }}
                                            </textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input name="role" type="text"
                                                value='{{ old('role', Auth::user()->role) }}' class="form-control "
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Role...">
                                        </div>

                                    </div>
                            </form>


                        </div>
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
