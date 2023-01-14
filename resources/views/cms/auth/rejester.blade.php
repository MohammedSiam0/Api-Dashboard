<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Api | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Register</b></a>
    </div>
    <div class="card-body">
 
      <form  >
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="custom-select" id="city_id">
            @foreach($cities as $city)
              <option value="{{$city->id}}">{{$city->name_en}}</option>
              @endforeach
            
            </select>          
            <div class="input-group-append">
          
          </div>
        </div>
      
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="name" id="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <button type="button" onclick="performRegister()" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

 

       
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.j')}}s"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
   
{{-- <script src="{{asset('js/axios.js')}}"></script>   --}}
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
 
<script>
  function performRegister() {
       axios.post('/cms/register', {
           name: document.getElementById('name').value,
           email_address: document.getElementById('email').value,
           city_id: document.getElementById('city_id').value,
           password: document.getElementById('password').value,
           
       })
           .then(function (response) {
               //2xx
                console.log(response);
               toastr.success(response.data.message);
               // هاي علشان تخليني اعمل تفريغ للحقول عند نجاح العملية 
               window.location.href = '/cms/web/login'
           })
           .catch(function (error) {
               //4xx - 5xx
               console.log(error.response.data.message);
               toastr.error(error.response.data.message);
           });
   }
</script>
</body>

</html>
