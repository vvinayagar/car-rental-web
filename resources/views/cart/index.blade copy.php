@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="https://via.placeholder.com/400x400" class="img-fluid rounded-start" alt="Product Image">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h4 class="card-title">Product Name</h4>
                            <p class="card-text text-muted">Short description about the product goes here. Mention highlights, features, or usage.</p>

                            <form>
                                <div class="mb-3">
                                    <label for="size" class="form-label">Size</label>
                                    <select class="form-select" id="size" name="size">
                                        <option selected>Select size</option>
                                        <option value="S">Small</option>
                                        <option value="M">Medium</option>
                                        <option value="L">Large</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <select class="form-select" id="color" name="color">
                                        <option selected>Select color</option>
                                        <option value="red">Red</option>
                                        <option value="blue">Blue</option>
                                        <option value="green">Green</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fs-5 fw-bold text-success">$49.99</span>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
