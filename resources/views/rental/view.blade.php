@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rental Cars') }}</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Name" required autocomplete="name" value="{{ $rental->name }}" class="form-control" disabled />
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="spec">Car Specs</label>
                                <textarea type="text" name="spec" placeholder="Spec" required autocomplete="spec" class="form-control" disabled>{{ $rental->spec }}</textarea>
                                @error('spec')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="count">Number of cars</label>
                                <input type="number" name="count" placeholder="Count" required autocomplete="count" class="form-control" min="1" value="{{ $rental->count }}" disabled />
                                @error('count')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" id="thumbnail" name="thumbnail" placeholder="Thumbnail" class="form-control" disabled />
                                <img style="display: none;" alt="thumbnail" class="img-responsive" />
                                @error('thumbnail')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input id="images" type="file" name="images[]" placeholder="Images" class="form-control" multiple disabled />
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
                                <select id="brand" name="brand" placeholder="Brand" required class="form-control" disabled>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @if($rental->brand == $brand) selected @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="transmission">Transmission</label>
                                <select id="transmission" name="transmission" placeholder="Transmission" required class="form-control" disabled>
                                    @foreach ($transmissions as $transmission)
                                    <option value="{{ $transmission->id }}" @if( $rental->transmission_id != null && $rental->transmission_id == $transmission->id) selected @endif >{{ $transmission->name }}</option>
                                    @endforeach
                                </select>
                                @error('transmission')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select id="type" name="type" placeholder="Type" required class="form-control" disabled>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @if( $rental->type_id != null && $rental->type_id == $type->id) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="shop">Shop</label>
                                <input type="text" value="{{ $rental->shop->name}}" class="form-control" disabled/>
                                 <!-- <select id="shop" name="shop" placeholder="Shop" required class="form-control" disabled>
                                    @foreach ($shops as $shop)
                                    <option value="{{ $shop->id }}" @if( $shop->shop_id != null && $rental->shop_id == $shop->id) selected @endif>{{ $shop->name }}</option>
                                    @endforeach
                                </select> -->
                                @error('shop')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
<!--
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="images">Categories</label>

                                @foreach ($categories as $category )

                                <div class="form-check">
                                    <input name="categories[]" class="form-check-input" type="checkbox"
                                        value="{{ $category->id }}"
                                        @if(\App\Models\SelectedCategory::where('category_id', $category->id)->where('rental_model_id', $rental->id)->exists()) checked @endif
                                    disabled />
                                    <label class="form-check-label" for="categories[]">
                                        {{ $category->name }}
                                    </label>
                                </div>
                                @endforeach

                                @error('categories')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection