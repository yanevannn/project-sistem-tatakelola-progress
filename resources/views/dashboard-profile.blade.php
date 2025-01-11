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
                    <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $user->nama }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ $user->jabatan }}
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
                            <div class="col-6">
                                <h6 class="text-uppercase">Reset Password</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2 mb-4">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group list-group-flush ml-4">
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <strong>Name:</strong> {{ $user->nama }}
                                    </li>
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <strong>Email:</strong> {{ $user->email }}
                                    </li>
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <strong>Role:</strong> {{ $user->role }}
                                    </li>
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <strong>Gender:</strong> {{ $user->jenis_kelamin }}
                                    </li>
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <strong>Phone:</strong> {{ $user->no_hp }}
                                    </li>
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <strong>Address:</strong> {{ $user->alamat }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
                            </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
