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
            <br>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                </div>
                <form method="POST" action="{{ route('profile_save') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name" name="name"
                                placeholder="Enter name"
                                value="{{ $currentUser->name }}"
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
                                value="{{ $currentUser->username }}" 
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
                                value="{{ $currentUser->email }}" 
                                required
                            />
                        </div>
                        @error('email')
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
                                value="{{ $currentUser->phone }}" 
                            />
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Address (optional)</label>
                            <textarea
                                class="form-control"
                                rows="3"
                                id="address"
                                name="address"
                                placeholder="Enter address"
                            >{{ $currentUser->address }}</textarea>
                        </div>
                        @error('address')
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
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $currentUser->id }}" />
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-16">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <form method="POST" action="{{ route('profile_change_password') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="oldPassword">Old Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="oldPassword"
                                name="oldPassword"
                                placeholder=""
                                required
                            />
                        </div>
                        @error('oldPassword')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="newPassword"
                                name="newPassword"
                                placeholder=""
                                required
                            />
                            <small class="text-muted">
                                New password should have minimum 8 alphanumeric, uppercase, lowercase & symbol (e.g #?!@$%^&*-)
                            </small>
                        </div>
                        @error('newPassword')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="newPasswordConfirm">New Password Confirmation</label>
                            <input
                                type="password"
                                class="form-control"
                                id="newPasswordConfirm"
                                name="newPasswordConfirm"
                                placeholder=""
                                required
                            />
                        </div>
                        @error('newPasswordConfirm')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" value="{{ $currentUser->id }}" />
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection