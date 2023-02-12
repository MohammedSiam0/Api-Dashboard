@extends('cms.parent')

 
@section('sub-name',__('cms.cities'))
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
            <h3 class="card-title">{{__('cms.create_cities')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="{{route('cities.update',$city->id)}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                 @if(session()->has('message'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                 {{session('message')}}  
              </div>
              @endif    

                    @if($errors->any())
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Errors!</h5>
                  @foreach($errors->all() as $error)
                  <li>
                    {{$error}}
                  </li>
                  @endforeach
              </div>

                   @endif  

              <div class="form-group">
                <label for="{{__('cms.name_en')}}">{{__('cms.name_en')}}</label>
                <input type="text" class="form-control" id="{{__('cms.name_en')}}" placeholder="{{__('cms.enter_name_en')}}" name="name_en"value="{{old('name_en') ?? $city->name_en}}" >
              </div>
              <div class="form-group">
                <label for="{{__('cms.name_ar')}}">{{__('cms.name_ar')}}</label> 
                <input type="text" class="form-control" id="{{__('cms.name_ar')}}" placeholder="{{__('cms.enter_name_ar')}}"name="name_ar"value="{{old('name_ar')?? $city->name_ar}}">
              </div>
              
             
              <div class="form-group">
                <div class="custom-control custom-switch">
                                                                              {{-- value="{{old('active')?? $city->active}}" --}}
                  <input type="checkbox" class="custom-control-input" id="customSwitch1" @if($city->active) checked @endif name="active">
                  <label class="custom-control-label" for="customSwitch1">{{__('cms.active')}}</label>
                </div>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">{{__('cms.save')}}</button>
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

@endsection
