@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User details') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"
                                required autocomplete="name" autofocus disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                            }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}"
                                required autocomplete="email" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="LoginType" class="col-md-4 col-form-label text-md-right">{{ __('Privilege')
                            }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="privilege" id="privilege" disabled>
                                <option value="admin" @if($privilege->name == 'admin') selected @endif>Admin</option>
                                <option value="user" @if($privilege->name == 'user') selected @endif>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}"
                                autocomplete="phone" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <textarea id="" type="text" class="form-control" name="address"
                                autocomplete="address" disabled> {{ $user->address }} </textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn btn-primary" onclick="window.location = '/admin/user'">
                                {{ __('Back') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection