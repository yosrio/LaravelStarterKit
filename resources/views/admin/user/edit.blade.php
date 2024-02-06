@extends('admin.layouts.default')
@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <form method="POST" action="{{ route('users_save') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name" name="name"
                                placeholder="Enter name"
                                value="{{ isset($userSelected) ? $userSelected->name : '' }}"
                                required
                            />
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="username" 
                                name="username" 
                                placeholder="Enter username" 
                                value="{{ isset($userSelected) ? $userSelected->username : '' }}" 
                                required
                            />
                        </div>
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter email"
                                value="{{ isset($userSelected) ? $userSelected->email : '' }}" 
                                required
                            />
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Password"
                                required
                            />
                            <small class="text-muted">
                                New password should have minimum 8 alphanumeric, uppercase, lowercase & symbol (e.g #?!@$%^&*-)
                            </small>
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                name="phone" 
                                placeholder="Enter phone number"
                                value="{{ isset($userSelected) ? $userSelected->phone : '' }}" 
                            />
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select" id="role_id" name="role_id" >
                                        @foreach($roles as $role)
                                            @if (isset($userSelected) && ($userSelected->role_id === $role->id))
                                                <option value="{{ $role->id }}" selected>
                                                    {{ $role->role_name }}
                                                </option>
                                            @else
                                                <option value="{{ $role->id }}">
                                                    {{ $role->role_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address (optional)</label>
                            <textarea
                                class="form-control"
                                rows="3"
                                id="address"
                                name="address"
                                placeholder="Enter address"
                            >{{ isset($userSelected) ? $userSelected->address : '' }}</textarea>
                        </div>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Status</label>
                            <div class="custom-control custom-switch">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="status"
                                name="status"
                                {{ isset($userSelected) && $userSelected->status ?  'checked' : '' }}
                            />
                            <label class="custom-control-label" for="status"></label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                            <input type="hidden" name="id" value="{{isset($userSelected) ? $userSelected->id : ''}}" />
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection