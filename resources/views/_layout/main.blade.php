<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-free/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @yield('title-user')
    @yield('styles-user')
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark pt-3" style="background: -webkit-linear-gradient(0deg, #014282 30%, #014282 30%);">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}">Data Barang</a>
                <div id="logout-button">

                </div>
            </div>
        </nav>
    </header>
    <section class="mt-5">
        @yield('content-user')
    </section>
    <!-- Footer -->
    <footer class="fdb-block footer-large" style="padding-bottom: 0px!important; border-top: 1px solid #dee2e6;margin-top: 100px;">
        <div class="container">
          <div class="row align-items-top text-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-sm-left">
              <nav class="nav flex-column">
              </nav>
            </div>
          </div>
        </div>
        <div class="row mt-3" style="background-color: #f0f0f0; border-top: 1px solid #dee2e6!important; padding: 20px; margin-bottom: 0px;">
          <div class="col text-center" style="color: #3d3d3d;">
            Faishal Hanin creation
          </div>
        </div>
</footer>
</body>

<script src="{{asset('assets/js/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/dist/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    var base_url = "{{url('/')}}"
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });

    $.post({
        url: base_url+'/api/auth/check_token',
        dataType: 'json',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            
            let html = `<button href="javascript:void(0);" class="btn btn-sm ml-auto" id="logout">Logut</button>`
            $('#logout-button').html(html);

            $('#logout').on('click', function() {
                logout();
            })
        },
        errror: function() {
            $('#logout-button').html('');
        }
    })

    function logout() {
        $.post({
            url: base_url+'/api/auth/logout',
            dataType: 'json',
            headers: {
                "Authorization" : "Bearer "+localStorage.getItem('token')
            },
            success: function(resp) {
                alert('Logout Success');
                localStorage.removeItem('token');
                $('#logout-button').html('');
                window.location.replace(base_url+'/');
            }
        })
    }
</script>
    @yield('scripts-user')
</html>
