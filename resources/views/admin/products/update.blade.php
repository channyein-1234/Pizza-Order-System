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
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>

                            <hr>
                            <form action="{{ route('products#update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row  ">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">

                                        <img src="{{ asset('storage/' . $pizza->image) }}"
                                            class="col-6 offset-3 img-thumbnail shadow-sm " />
                                        {{-- file btn  --}}
                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage"
                                                class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
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
                                            <input name="pizzaName" type="text" value='{{ old('name', $pizza->name) }}'
                                                class="form-control @error('pizzaName') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">

                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <input name="pizzaDescription" type="text"
                                                value='{{ old('description', $pizza->description) }}'class="form-control @error('pizzaDescription') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Pizza Description...">
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="">Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="choose pizzaCategory">Choose category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($pizza->category_id == $c->id) selected @endif>
                                                        {{ $c->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input name="pizzaPrice" type="number"
                                                value='{{ old('phone-number', $pizza->price) }}'
                                                class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Pizza Price...">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">View Count</label>
                                            <textarea name="view_count" type="text" class="form-control" @error('view_count') is-invalid @enderror
                                                aria-required="true" aria-invalid="false">{{ old('view_count', $pizza->view_count) }}
                                            </textarea>
                                            @error('view_count')
                                                <div class="invalid-feedback">
                                                    {{ $message }};
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Created At</label>
                                            <input name="role" type="text"
                                                value='{{ old('created_at', $pizza->created_at->format('j-F-Y')) }}'
                                                class="form-control " aria-required="true" aria-invalid="false">
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
