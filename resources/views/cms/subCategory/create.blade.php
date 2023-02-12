@extends('cms.parent')

 
@section('sub-name',__('cms.subCategory'))
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
            <h3 class="card-title">{{__('cms.subCategory')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="{{route('subcategories.store')}}">
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
                <label for="{{__('cms.name')}}">{{__('cms.name')}}</label>
                <input type="text" class="form-control"  placeholder="{{__('cms.name')}}" name="title"value={{old('title')}}>
              </div>
              <div class="form-group">
                <label for="{{__('cms.description')}}">{{__('cms.description')}}</label>
                <input type="text" class="form-control"   placeholder="{{__('cms.description')}}"name="description"value={{old('description')}}>
              </div>
        
              {{-- <div class="form-group">
                <label for="{{__('cms.status')}}">{{__('cms.status')}}</label>
                <input type="text" class="form-control" id="status" placeholder="status"name="status"value={{old('status')}}>
              </div> --}}
               {{-- <div class="form-group">
                <label for="category_id">Category</label>
                <select class="custom-select" id="category_id">
                @foreach($Categories as $Category)
                  <option value="{{$Category->id}}">{{$Category->title}}</option>
                  @endforeach
                
                </select>
              </div>  --}}
              {{-- $subCategory->Category->title --}}
              <div class="form-group">
                <label for="category_id">Category</label>
                <select class="custom-select"   name="category_id">
                @foreach($category as $categores)
                  <option value="{{$categores->id}}" >{{$categores->title}}</option>
                  @endforeach
                
                </select>
              </div>
              
              {{--              
              <div class="form-group">
                  <div class="custom-control custom-switch">
                  {{-- <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status"> --}}
                  {{-- <input type="checkbox" id="customSwitch1"name="status"  @checked($Category->status)/>

                  <label class="custom-control-label" for="customSwitch1">{{__('cms.status')}}</label>
                </div>  
 
               </div>   --}}
               {{-- <div class="form-group">
                <label for="{{__('cms.description')}}">{{__('cms.description')}}</label>
                <input type="text" class="form-control" id="status" placeholder="{{__('cms.status')}}"name="status"value={{old('status')}}>
              </div> --}}
              <div class="form-group">
              <label for="{{__('cms.description')}}">{{__('cms.description')}}</label>

              <select class="custom-select" name="status">
          
                <option value="Visible">Visible</option>
                <option value="InVisible">InVisible</option>
             
              </select>
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
 
 
