@extends('cms.parent')

 
@section('sub-name',__('cms.products'))
@section('large-name',__('cms.create'))
@section('home-name',__('cms.create'))   

@section('style')
<style>
  img{
  max-width:180px;
}
input[type=file]{
padding:10px;
background:#2d2d2d;}

</style>
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
            <h3 class="card-title">{{__('cms.create_products')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->


       
          {{-- {!! $generator->getBarcode('0001245259636', $generator::TYPE_CODE_128) !!} --}}
          <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
            @csrf
            {{-- {{ csrf_field() }} --}}
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
                <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}" name="name"value={{old('name')}}>
              </div>

              
              <div class="form-group">
                <label for="{{__('cms.description')}}">{{__('cms.description')}}</label>
                <textarea  rows="4"  type="text" class="form-control" id="description" placeholder="{{__('cms.description')}}"name="description"value={{old('description')}}>
                </textarea>
                </div>


              <div class="form-group">
                <label for="{{__('cms.price')}}">{{__('cms.price')}}</label>
                <input type="text" class="form-control" id="price" placeholder="{{__('cms.price')}}"name="price"value={{old('price')}}>
              </div>
              <div class="form-group">
                <label for="{{__('cms.stock')}}">{{__('cms.stock')}}</label>
                <input type="text" class="form-control" id="stock" placeholder="{{__('cms.stock')}}"name="stock"value={{old('stock')}}>
              </div>
               <div class="form-group">
                <label for="sub_category_id">Sub Category</label>
                <select class="custom-select" id="sub_category_id" name="sub_category_id">
                @foreach($products as $product)
                  <option value="{{$product->id}}">{{$product->title}}</option>
                  @endforeach
                
                </select>
              </div> 
              
              {{-- <div >
                <label>Choose Images</label>
                <input type="file"  name="images" multiple>
                
                </div> --}}
            {{-- <div>
                <label>Choose Images</label>
                <input  multiple type='file' style="background-color: aliceblue" onchange="readURL(this);" />
                <img id="blah" name="images"   src="https://via.placeholder.com/50" alt="your image" />
            </div> --}}
            {{-- <div>
                
                <input  multiple type='file' style="background-color: aliceblue" onchange="readURL(this);" />
                <img id="blah" name="images"   src="https://via.placeholder.com/50" alt="your image" />
            </div> --}}
            <input 
            type="file" 
            name="images" 
             
            multiple
            class="form-control @error('image') is-invalid @enderror">

        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
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
  @yield('scripts')
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
 
 
