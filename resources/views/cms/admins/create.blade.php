@extends('cms.parent')

 
@section('sub-name',__('cms.cities'))
@section('large-name',__('cms.create'))
@section('home-name',__('cms.create'))   

@section('style')

@endsection


@section('main-content')
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{__('cms.create_cities')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="role_id">{{__('cms.roles')}}</label>
              <select class="custom-select" id="role_id">
              @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
              
              </select>
            </div>

            <div class="form-group">
              <label for="{{__('cms.name')}}">{{__('cms.name')}}</label>
              <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"  >
            </div>
            <div class="form-group">
              <label for="{{__('cms.email')}}">{{__('cms.email')}}</label>
              <input type="email" class="form-control" id="email" placeholder="{{__('cms.enter_email')}}"  >
            </div>
            
         
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            {{-- <button type="button" onclick="performStore()" class="btn btn-primary">{{__('cms.save')}}</button> --}}
            <button type="button" onclick="performStore()"
            class="btn btn-primary">{{__('cms.save')}}</button>
          </div>
        </form>
      </div>
      <!-- /.card -->


    </div>
 
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
 
@section('scripts')


<script>
  function performStore() {
       axios.post('/cms/admin/admins', {
           name: document.getElementById('name').value,
           email_address: document.getElementById('email').value,
          role_id: document.getElementById('role_id').value,
          
       })
           .then(function (response) {
               //2xx
                console.log(response);
               toastr.success(response.data.message);
               // هاي علشان تخليني اعمل تفريغ للحقول عند نجاح العملية 
              document.getElementById('create-form').reset();
           })
           .catch(function (error) {
               //4xx - 5xx
               console.log(error.response.data.message);
               toastr.error(error.response.data.message);
           });
   }
</script>

@endsection
