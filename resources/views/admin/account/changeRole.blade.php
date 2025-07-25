@extends('admin/layout/master')
@section('title', 'category list')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin#list') }}">
                                <i class="fa-solid fa-arrow-left text-dar" onclick="history.back()"></i>
                            </a>

                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>

                            <hr>
                            <form action="{{ route('admin#change', $account->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row  ">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'female')
                                                <img src="{{ asset('image/female_default.png') }} "
                                                    class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/default_user.png') }} "
                                                    class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}"
                                                class="col-6 offset-3 img-thumbnail shadow-sm " />
                                        @endif

                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">Change <i
                                                    class="fa-solid fa-arrow-up-from-bracket m-2"></i></button>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="name" disabled type="text"
                                                value='{{ old('name', $account->name) }}'
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
                                            <input name="emadil" disabled type="text"
                                                value='{{ old('email', $account->email) }}'class="form-control @error('email') is-invalid @enderror"
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
                                            <select name="gender" disabled
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="choose gender">Choose Gender</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
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
                                            <input name="phone_number" disabled type="number"
                                                value='{{ old('phone-number', $account->phone_number) }}'
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
                                            <textarea name="address" disabled type="text" class="form-control" @error('address') is-invalid @enderror
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Address...">{{ old('address', $account->address) }}
                                            </textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>
                                                    Admin
                                                </option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>
                                                    User
                                                </option>
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
