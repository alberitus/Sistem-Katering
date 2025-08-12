@extends('layout.app')
@section('title', 'Edit User')
@section('content')
@php
$roles = auth()->user();
@endphp


<!-- Breadcrumb -->
@if($roles && ($roles->isIT() || $roles->isAdmin()))
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('users.index') }}">User Data</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a>Edit User</a>
        </li>
    </ol>
</nav>
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a>Profile Data</a>
        </li>
    </ol>
</nav>
@endif
<!-- Content Row -->
<div class="row">
    <div class="col-lg-4">
        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
            </div>
            <div class="card-body text-center">
                <img class="img-profile rounded-circle mb-3" src="{{ asset('import/assets/img/undraw_profile.svg') }}"
                    width="120">

                <h5 class="card-title">{{ ucwords($user->name) }}</h5>
                <p class="card-text">{{ $user->email }}</p>

                <p class="card-text">
                    <span class="badge badge-info">
                        @if($user->isIT())
                        IT
                        @elseif($user->isAdmin())
                        Admin
                        @elseif($user->isUser())
                        User
                        @else
                        Unknown
                        @endif
                    </span>
                </p>

                <small class="text-muted">
                    Added on: {{ $user->created_at->translatedFormat('F d, Y') }}
                </small>
            </div>
        </div>
        @if($roles && ($roles->isIT() || $roles->isAdmin()))
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reset Password</h6>
            </div>
            <div class="card-body text-center">
                <section class="space-y-2">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Reset User Password
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            The password will be reset to the default:
                            <code>Catering{{ date('my') }}</code>.
                        </p>
                    </header>
                    <form action="{{ route('users.reset', Crypt::encrypt($user->id)) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            Reset Password
                        </button>
                    </form>
                </section>
            </div>
        </div>
        @endif
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit User Data Form</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', Crypt::encrypt($user->id)) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required autofocus>
                            </div>
                            @if($roles && ($roles->isIT() || $roles->isAdmin()))
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control select2">
                                    <option value="">Select Role</option>
                                    <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>User</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
                                    @if($user->isIT())
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>IT</option>
                                    @endif
                                </select>
                            </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Password Form</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.password', Crypt::encrypt($user->id)) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" autocomplete="current-password">
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
