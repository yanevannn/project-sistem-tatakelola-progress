@extends('layout.layout')
@section('page-title', 'Profile')

@section('content')

    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png" class="bg-white rounded-circle" alt="profile_image">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $user->anggota->nama }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ $user->role }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6">
                                <h6>INFORMATION</h6>
                            </div>
                            <div class="col-6 d-none d-md-block">
                                <h6 class="text-uppercase">Reset Password</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2 mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-right" style="width: 30%;"><strong>Name:</strong></th>
                                            <td>{{ $user->anggota->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-right"><strong>Jabatan:</strong></th>
                                            <td>{{ $user->role }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-right"><strong>Nim:</strong></th>
                                            <td>{{ $user->anggota->nim }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-right"><strong>Email:</strong></th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-right"><strong>Phone:</strong></th>
                                            <td>{{ $user->anggota->no_hp }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="d-block d-md-none">
                                    <h6 class="text-uppercase">Reset Password</h6>
                                </div>
                            <form action="{{ route('resetPassword') }}" method="POST">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-white">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <button type="submit" class="btn btn-warning mt-3">Reset Password</button>
                            </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
