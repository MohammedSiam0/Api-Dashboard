  

  @extends('cms.parent')

 
@section('sub-name', __('cms.products'))
@section('large-name', __('cms.products') )
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
              <h3 class="card-title">{{ __('cms.products')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('cms.name')}}</th>
                    <th>{{ __('cms.description')}}</th>
                    <th>{{ __('price')}}</th>
                    <th>{{ __('cms.stock')}}</th>
                    <th>{{ __('cms.status')}}</th>
                    <th>{{ __('subCategory')}}</th>
                    {{-- <th>{{ __('cms.created_at')}}</th>
                    <th>{{ __('cms.updated_at' )}}</th> --}}
                      <th>Image</th>
                      
                    <th style="width: 40px"> Settings</th>
                  </tr>
                </thead>
                <tbody>
              @foreach ( $products as $product )
              <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>
                  {{$product->description}}
                </td>
                <td>
                  {{$product->price}}
                </td>
                <td>
                  {{$product->stock}}
                </td>
                <td>
                  {{$product->status}}
                </td>
                <td>
                  {{-- {{$product->subCategory->title}} --}}
                  {{$product->subCategory->title  ?? ""}}
                </td>
                                                                                                 {{-- اسم الجدول الحقل الاساسي هوا أكتف بس علشان بدي اعمل شرط ف رحت على المودل اعملت فنكشن وبيتم استدعائها بهاي الطريقة المكتوبة  --}}
                {{-- <td> {{$product->created_at}} </td>
                <td>  {{$product->updated_at}}</td> --}}
                                {{-- <td><span class="badge @if($product->active) bg-success @else bg-danger @endif">{{ $city->active_status}} </span></td> --}}
                {{--         
                 <td><img  height="100" src="{{asset('storage/'.$product->images->status)}}" alt="">
                 </td> --}}
                  {{-- @foreach ( $images as $image )
                 <td>
                  <img src="{{$image->url}}" width="150" height="150" alt="Not Found Image" />
                </td>
                @endforeach  --}}
                 {{-- <td>
                  {{-- {{$product->url ?? ""}} 
                  <img src="{{$images->url}}" width="150" height="150"  alt="Not Found Image"/>
                </td>  --}}
                
              <td>
                @foreach ( $images as $image )
                {{-- <img src="{{asset('upload/products/'.$images->url)}}" width="150" height="150"  alt="Not Found Image"/> --}}
                <img src="{{asset('upload/products/'.$image->url)}}" width="150" height="150"  alt="Not Found Image"/>
                {{-- <i class="fas fa-trash">{{$image->url}}</i> --}}
                   @endforeach
              </td>
         
              <td>
                  <div class="btn-group">
                                          {{--  هاي هي الطريقة لي بنمرر فيها الايدي عن طريق دالة اليديت   --}}
                   {{-- للانتقال بين الصفحات نستخدم a href --}}
                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-success btn-flat">
                      <i class="fas fa-edit"></i>
                    </a>
                 
                <form method="POST" action="{{route('products.destroy',$product->id)}}">
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
 
 
 