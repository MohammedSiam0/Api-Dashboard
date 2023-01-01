@extends('cms.parent')

 
@section('sub-name',__('cms.roles'))
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
          <h3 class="card-title">{{__('cms.create_roles')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
          @csrf
          <div class="card-body">
             <div class="form-group">
              <label for="guard_name">{{__('cms.guard')}}</label>
              <select class="custom-select" id="guard_name">
          
                <option value="web">Web</option>
                <option value="admin">Admin</option>
             
              </select>
            </div>  

            <div class="form-group">
              <label for="{{__('cms.name')}}">{{__('cms.name')}}</label>
              <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"  >
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
       axios.post('/cms/admin/permissions', {
           name: document.getElementById('name').value,
           guard_name: document.getElementById('guard_name').value,
          
       })
           .then(function (response) {
               //2xx
                console.log(response);
               toastr.success(response.data.message);
              //  // هاي علشان تخليني اعمل تفريغ للحقول عند نجاح العملية 
               document.getElementById('create-form').reset();
             // window.location.href='/cms/admin/permissions';


           })
           .catch(function (error) {
               //4xx - 5xx
               console.log(error.response.data.message);
               toastr.error(error.response.data.message);
           });
   }
</script>

@endsection
