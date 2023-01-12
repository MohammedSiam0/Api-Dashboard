  

  @extends('cms.parent')

 
@section('sub-name', __('cms.cities'))
@section('large-name', __('cms.cities') )
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
              <h3 class="card-title">{{ __('cms.cities')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('cms.name_en')}}</th>
                    <th>{{ __('cms.name_ar')}}</th>
                    <th>{{ __('cms.created_at')}}</th>
                    <th>{{ __('cms.updated_at' )}}</th>
                      <th>{{ __('cms.active')}}</th>

                    <th style="width: 40px"> Settings</th>
                  </tr>
                </thead>
                <tbody>
              @foreach ($cities as $city)
              <tr>
                <td>{{$city->id}}</td>
                <td>{{$city->name_en}}</td>
                <td>
                  {{$city->name_ar}}
                </td>
               {{-- <td><span class="badge @if($city->active) bg-success @else bg-danger @endif">@if($city->active)Active @else InActive @endif</span></td>   --}}
                                                                                                {{-- اسم الجدول الحقل الاساسي هوا أكتف بس علشان بدي اعمل شرط ف رحت على المودل اعملت فنكشن وبيتم استدعائها بهاي الطريقة المكتوبة  --}}
                <td> {{$city->created_at}} </td>
                <td>  {{$city->updated_at}}</td>
                                <td><span class="badge @if($city->active) bg-success @else bg-danger @endif">{{ $city->active_status}} </span></td>

              <td>
                  <div class="btn-group">
                                          {{--  هاي هي الطريقة لي بنمرر فيها الايدي عن طريق دالة اليديت   --}}
                   {{-- للانتقال بين الصفحات نستخدم a href --}}
                    <a href="{{route('cities.edit',$city->id)}}" class="btn btn-success btn-flat">
                      <i class="fas fa-edit"></i>
                    </a>
                 
                <form method="POST" action="{{route('cities.destroy',$city->id)}}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-flat">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
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

@endsection
