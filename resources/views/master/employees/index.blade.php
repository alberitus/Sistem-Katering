@extends('layout.app')
@section('title', 'Data Employees')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Employees</h1>
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
            <a>Data Employees</a>
        </li>
    </ol>
</nav>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Table Employees</h6>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> Add Employees
            </button>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Employment Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($employees as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->position }}</td>
                                <td>Rp {{ number_format($item->salary, 0, ',', '.') }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $item->employment_type)) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cogs"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <form action=""
                                                method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="dropdown-item btn-delete"
                                                    data-id="">
                                                    <i class="fas fa-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('master.employees.modal-tambah')
    @include('master.employees.modal-ubah')
@endsection
@push('scripts')
<script>
    const salaryInput = document.getElementById('salary');
    const employeeForm = document.getElementById('employeeForm');

    salaryInput.addEventListener('keyup', function() {
        let value = this.value.replace(/[^,\d]/g, '');
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        this.value = rupiah ? 'Rp ' + rupiah : '';
    });

    // Hapus format sebelum submit
    employeeForm.addEventListener('submit', function() {
        salaryInput.value = salaryInput.value.replace(/[^0-9]/g, '');
    });
</script>
@endpush
