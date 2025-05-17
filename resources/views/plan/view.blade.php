@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Plan Details') }}</div>

                <div class="card-body">
                
                      
                        <div class="row mt-3">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name" required autocomplete="name"
                                        class="form-control" value="{{$plan->name}}" />
                                    
                                </div>
                                <div class="form-group">
                                    <label for="name">Days</label>
                                    <input type="number" name="days" placeholder="Days" required autocomplete="days"
                                        class="form-control" value="{{$plan->days}}" />
                                       
                                </div>

                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="number" name="price" placeholder="Price" required autocomplete="price" class="form-control" value="{{$plan->price}}" />
                                  
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="spec">Rental Type</label>
                                   <input id="rental" name="rental" placeholder="rental" required class="form-control" value="{{$plan->rental->name}}"/>
                                     
                                 
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                            <a href="{{ route('plan.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection