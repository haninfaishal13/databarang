@extends('_layout.main')
@section('title-user')
<title>Welcome</title>
@endsection
@section('content-user')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Database Barang</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <img src="{{asset('assets/png/product.png')}}" class="img-fluid mx-auto d-block"
            alt="Sample image">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="py-5 pt-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Login</h5>
                    </div>
                    <form id="logform">
                        <div class="card-body justify-content-center">
                            <div class="form-outline mb-4">
                                <input type="text" name="email" id="email" class="form-control"
                                placeholder="Enter email" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter password" />
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
                                    <a href="javascript:void(0);" class="link-danger" data-toggle="modal" data-target="#modal-register" id="register">Register</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register</h5>
                <button type="button" class="close cancel-edit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="registerform">
                <div class="modal-body">
                    <div class="form-group">
                        Email:
                        <input type="text" name="email" class="form-control" id="register-email" style="width:100%;">
                    </div>
                    <div class="form-group">
                        Name:
                        <input type="text" name="name" class="form-control py-2" id="register-name" style="width:100%;">
                    </div>
                    <div class="form-group">
                        Password:
                        <input type="password" name="password" class="form-control select2 py-2" id="register-password" style="width:100%;">
                    </div>
                    <div class="form-group">
                        Confirm Password:
                        <input type="password" name="confirm_password" class="form-control py-2" id="register-confirm-password" style="width:100%;">
                        <p class="text-danger d-none" id="warning-confirm-password">Confirm Password not match</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts-user')
<script src = "{{asset('assets/js/auth.js')}}"></script>
@endsection
