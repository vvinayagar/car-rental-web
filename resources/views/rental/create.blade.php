@extends('layouts.app')

@section('content')
<div class="container mt-3">
    

        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rental Cars') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('rental.store') }}" class="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name" required autocomplete="name"
                                        class="form-control" />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="spec">Car Spec</label>
                                    <textarea type="text" name="spec" placeholder="Spec" required autocomplete="spec" class="form-control" ></textarea>
                                    @error('spec')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="count">Number of cars</label>
                                    <input type="number" name="count" placeholder="Count" required autocomplete="count" class="form-control" min="1"/>
                                    @error('count')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" placeholder="Thumbnail" required class="form-control" />
                                    <img style="display: none;" alt="thumbnail" class="img-responsive" />
                                    @error('thumbnail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="images">Images</label>
                                    <input id="images" type="file" name="images[]" placeholder="Images" required class="form-control" multiple />
                                    <div id="list_images">

                                    </div>
                                    @error('images')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select id="brand" name="brand" placeholder="Brand" required class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="categories[]">Categories</label>

                                    @foreach ($categories as $category )
                                    <div class="form-check">
                                        <input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }}"  >
                                        <label class="form-check-label" for="categories[]">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                    @endforeach

                                    @error('categories')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> -->

                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="shop">Shop</label>
                                    <select id="shop" name="shop" placeholder="Shop" required class="form-control">
                                        @foreach ($shops as $shop)
                                            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('shop')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                            <button type="submit" name="save" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
