@extends('layout.app')
@section('title', 'Tambah User')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
</div>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('index') }}">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('users.index') }}">Data User</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <a>Tambah User</a>
        </li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Nama User" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control"
                                    name="password" placeholder="Password User" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Email User" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password</label>
                                <input type="password" class="form-control"
                                    name="password_confirmation" placeholder="Password User" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control select2">
                                    <option value="">Pilih Role</option>
                                    <option value="3">User</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection
