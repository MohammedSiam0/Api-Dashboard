@extends('cms.parent')

 
@section('sub-name',__('cms.users'))
@section('large-name',__('cms.update'))
@section('home-name',__('cms.update'))   

@section('style')

@endsection


@section('main-content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{__('cms.update_users')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form >
            @csrf
            <div class="card-body">

            <div class="form-group">
              <label for="city_id">{{__('cms.users')}}</label>
              <select class="custom-select" id="city_id">
              @foreach($cities as $city)
           <option value="{{$city->id}}" @if ($city->cityid == $city->id) selected
               
           @endif>{{$city->name_en}}</option>  
               
                @endforeach
              
              </select>
            </div>

            <div class="form-group">
              <label for="{{__('cms.name')}}">{{__('cms.name')}}</label>
              <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"  value="{{$user->email}}"   >
            </div>
            <div class="form-group">
              <label for="{{__('cms.email')}}">{{__('cms.email')}}</label>
              <input type="email" class="form-control" id="email" placeholder="{{__('cms.enter_email')}}" value="{{$user->email}}" >
            </div>
            </div>
          
 
            <div class="card-footer">
              {{-- <button type="button" onclick="performStore()" class="btn btn-primary">{{__('cms.save')}}</button> --}}
              <button type="button" onclick="performUpdate()"
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
  function performUpdate() {
    // طريق ثانية لتمرير الايدي بس كل وحدة حسب واصل او لاء 
  axios.put('/cms/admin/users/{{$user->id}}', {
      name: document.getElementById('name').value,
      email_address: document.getElementById('email').value,
      city_id: document.getElementById('city_id').value,
     
  })
      .then(function (response) {
          //2xx
           console.log(response);
          toastr.success(response.data.message);
          // بعد الحفظ يرجعنى على صفحة معينة 
          window.location.href = '/cms/admin/users'
      })
      .catch(function (error) {
          //4xx - 5xx
          console.log(error.response.data.message);
          toastr.error(error.response.data.message);
      });
}
</script>
@endsection
