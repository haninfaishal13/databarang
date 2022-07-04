@extends('_layout.main')
@section('title-public')
    <title>Register</title>
@endsection

@section('content-public')

<div class="row justify-content-center">
    <div class="col-sm-6">
        @if (session('auth_error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            {!! session('auth_error') !!}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Register</h5>
            </div>
            <div class="card-body">
                <form action="{{route('auth.register.process')}}" id="form-register" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section id="page_1">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Nama:
                            </div>
                            <div class="col-md-9">
                                <div class="form-outline">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required />
                                    <span id="warning-name" class="text-danger d-none">Nama belum diisi</span>
                                </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Username:
                            </div>
                            <div class="col-md-9">
                                <div class="form-outline">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required />
                                    <span id="warning-username" class="text-danger d-none">Username belum diisi</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Email:
                            </div>
                            <div class="col-md-9">
                                <div class="form-outline">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required />
                                    <span id="warning-email" class="text-danger d-none">Email belum diisi</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Password:
                            </div>
                            <div class="col-md-9">
                                <div class="form-outline">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                                    <span id="warning-password" class="text-danger d-none">Password belum diisi</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-outline">
                                    Konfirmasi Password:
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required />
                                <span id="warning-konfirmasi-password" class="text-danger d-none">Password tidak sesuai</span>
                            </div>
                        </div>
                    </section>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="return register()">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts-public')
<script>
    $('#confirm_password').keyup(function() {
        if($('#confirm_password').val() != $('#password').val()) {
            $('#warning-konfirmasi-password').removeClass('d-none');
        }
        else {
            $('#warning-konfirmasi-password').addClass('d-none');
        }
    });

    $('#photo_profile').on('change', function() {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
                $('#show-photo-profile').attr("src",this.result);
            }
        }
    });

    $('#religion').on('change', function() {
        if($(this).val() == "Lainnya") {
            $('#other_religion').removeClass('d-none');
        }
        else {
            $('#other_religion').addClass('d-none');
        }
    })

    function register() {
        if($('#name').val() == '' || $('#name').val() == null) {
            $('#warning-name').removeClass('d-none');
            setTimeout(() => {
                $('#warning-name').addClass('d-none');
            }, 3000);
            return false
        }
        if($('#username').val() == '' || $('#username').val() == null) {
            $('#warning-username').removeClass('d-none');
            setTimeout(() => {
                $('#warning-username').addClass('d-none');
            }, 3000);
            return false
        }
        if($('#email').val() == '' || $('#email').val() == null) {
            $('#warning-email').removeClass('d-none');
            setTimeout(() => {
                $('#warning-email').addClass('d-none');
            }, 3000);
            return false
        }
        if($('#password').val() == '' || $('#password').val() == null) {
            $('#warning-password').removeClass('d-none');
            setTimeout(() => {
                $('#warning-password').addClass('d-none');
            }, 3000);
            return false
        }
        if($('#password').val() != $('#confirm_password').val()) {
            return false;
        }
        if($('#photo_profile').val() == '' || $('#photo_profile').val() == '') {
            console.log($('#photo_profile').val());
            $('#warning-foto-profil').removeClass('d-none');
            setTimeout(() => {
                $('#warning-foto-profil').addClass('d-none');
            }, 3000);
            return false
        }
        if($('#religion').val() == '0') {
            $('#warning-agama').removeClass('d-none');
            setTimeout(() => {
                $('#warning-agama').addClass('d-none');
            }, 3000);
            return false
        }
        if($('#gender').val == '0') {
            $('#warning-gender').removeClass('d-none');
            setTimeout(() => {
                $('#warning-gender').addClass('d-none');
            }, 3000);
            return false
        }
    }
</script>
@endsection
