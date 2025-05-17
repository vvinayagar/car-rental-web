@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rental Cars') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('rental.update', ['rental' => $rental->id]) }}" class="form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name" required autocomplete="name" value="{{ $rental->name }}"                                        class="form-control" />
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="spec">PC Spec</label>
                                    <textarea type="text" name="spec" placeholder="Spec" required autocomplete="spec" class="form-control" >{{ $rental->spec }}</textarea>
                                    @error('spec')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="count">Number of Cars</label>
                                    <input type="number" name="count" placeholder="Count" required autocomplete="count" class="form-control" min="1" value="{{ $rental->count }}"/>
                                    @error('count')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" placeholder="Thumbnail" class="form-control" />
                                    <img style="display: none;" alt="thumbnail" class="img-responsive" />
                                    @error('thumbnail')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="images">Images</label>
                                    <input id="images" type="file" name="images[]" placeholder="Images" class="form-control" multiple-+ />
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
                                            <option value="{{ $brand->id }}" @if($rental->brand->id == $brand->id) selected @endif>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="images">Categories</label>

                                    @foreach ($categories as $category )

                                    <div class="form-check">
                                        <input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }} @if(count(\App\Models\SelectedCategory::where(['id'=> $category->id , 'rental_model_id'=> $rental->id])->get()) > 0) checked @endif" />
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
                            <div class="col-12 mb-3">
                            <button type="submit" name="save" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
