@extends('admin/layout/master')
@section('title', 'edit user')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">User Account Profile</h3>
                            </div>

                            <hr>
                            <form action="{{ route('admin#updateUser', $userAcc->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row  ">
                                    <div class="col-4 offset-1">
                                        @if ($userAcc->image == null)
                                            @if ($userAcc->gender == 'female')
                                                <img src="{{ asset('image/female_default.png') }} "
                                                    class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/default_user.png') }} "
                                                    class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $userAcc->image) }}"
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
                                            <input name="name" type="text" value='{{ old('name', $userAcc->name) }}'
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter   Name...">

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input name="email" type="text"
                                                value='{{ old('email', $userAcc->email) }}'class="form-control @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter  Email...">
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
                                                <option value="male" @if ($userAcc->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($userAcc->gender == 'female') selected @endif>
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
                                                value='{{ old('phone-number', $userAcc->phone_number) }}'
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter  Phone...">
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" type="text" class="form-control" @error('address') is-invalid @enderror aria-required="true"
                                                aria-invalid="false" placeholder="Enter  Address...">{{ old('address', $userAcc->address) }}
                                            </textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            {{-- <input name="role" type="text" value='{{ old('role', $userAcc->role) }}'
                                                class="form-control " aria-required="true" aria-invalid="false"
                                                placeholder="Enter Role"> --}}
                                            <select class="form-control " name="role">
                                                <option value="user" @if ($userAcc->role == 'user') selected @endif>
                                                    User</option>
                                                <option value="admin" @if ($userAcc->role == 'admin') selected @endif>
                                                    Admin</option>
                                            </select>
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
