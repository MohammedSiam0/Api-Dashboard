@extends('cms.parent')

 
@section('sub-name',__('cms.category'))
@section('large-name',__('cms.create'))
@section('home-name',__('cms.create'))   

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
            <h3 class="card-title">{{__('cms.category')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="{{route('categories.store')}}">
            @csrf
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
                <label for="{{__('cms.title')}}">title</label>
                <input type="text" class="form-control" id="title" placeholder="{{__('cms.title')}}" name="title"value={{old('title')}}>
              </div>
              <div class="form-group">
                <label for="{{__('cms.description')}}">{{__('cms.description')}}</label>
                <input type="text" class="form-control" id="description" placeholder="{{__('cms.description')}}"name="description"value={{old('description')}}>
              </div>
              {{-- <div class="form-group">
                <label for="{{__('cms.price')}}">{{__('cms.price')}}</label>
                <input type="text" class="form-control" id="price" placeholder="{{__('cms.price')}}"name="price"value={{old('price')}}>
              </div>
              <div class="form-group">
                <label for="{{__('cms.stock')}}">{{__('cms.stock')}}</label>
                <input type="text" class="form-control" id="stock" placeholder="{{__('cms.stock')}}"name="stock"value={{old('stock')}}>
              </div> --}}
              {{-- <div class="form-group">
                <label for="sub_category_id">Category</label>
                <select class="custom-select" id="sub_category_id">
                @foreach($Categories as $cateory)
                  <option value="{{$cateory->id}}">{{$cateory->name}}</option>
                  @endforeach
                
                </select>
              </div> --}}
              
             
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox"  checked   value="Visible"  class="custom-control-input" id="customSwitch1" name="status">
                  <label class="custom-control-label" for="customSwitch1">{{__('cms.status')}}</label>
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
 
 
