  

@extends('cms.parent')

 
@section('sub-name', __('cms.users'))
@section('large-name', __('cms.users') )
@section('home-name', __('cms.index'))   

@section('style')

@endsection


@section('main-content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ __('cms.users')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('cms.name')}}</th>
                    <th>{{ __('cms.email')}}</th>
                    <th>{{ __('cms.cities')}}</th>
                    <th>{{ __('cms.created_at')}}</th>
                    <th>{{ __('cms.updated_at' )}}</th>
                

                    <th style="width: 40px"> Settings</th>
                  </tr>
                </thead>
                <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>
                  {{$user->email}}
                </td>
                <td> {{$user->city->name_en}} </td>
                 <td> {{$user->created_at}} </td>
                <td>  {{$user->updated_at}}</td>
       
 
              <td>
                  <div class="btn-group">
                                          {{--  هاي هي الطريقة لي بنمرر فيها الايدي عن طريق دالة اليديت   --}}
                   {{-- للانتقال بين الصفحات نستخدم a href --}}
                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-success btn-flat">
                      <i class="fas fa-edit"></i>
                    </a>
                                    {{-- تعود كلمة ذس الي تحديد مكان الصف علشان حنحدف بناءا على اقرب اشي الها فهوا ال التي ار تبع الصف   --}}
                    <a  onclick="confermDelete('{{$user->id}}',this)" class="btn btn-danger btn-flat">
                      <i class="fas fa-trash"></i>
                    </a>
                  </div>
                </td>  
              </tr>
              @endforeach
          
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.card -->
 
          <!-- /.card -->
        </div>
    
      </div>
    </div>
@endsection
 
@section('scripts')
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confermDelete(id,reference) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          performDelete(id,reference);
        }
      });
  }
</script>

<script>
  function performDelete(id,reference) {
       axios.delete('/cms/admin/users/'+id )
           .then(function (response) {
               //2xx
                console.log(response);
               toastr.success(response.data.message);
              //  بناءا على الذس الي مستخدمها فوق ف انا بحدف على اقرب اشي منها هوا التي ار 
              reference.closest('tr').remove();
           })
           .catch(function (error) {
               //4xx - 5xx
               console.log(error.response.data.message);
               toastr.error(error.response.data.message);
              });
   }
</script>
@endsection
