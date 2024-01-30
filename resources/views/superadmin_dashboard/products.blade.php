@extends('layouts.app')




@section('content')

<div class="page-content">

    <div class="bu">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            Add New Product
          </button>
    </div>


<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create a new product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form method="post"  action="/create-product" enctype="multipart/form-data">

                @csrf

            <div class="form-group">
                <label for="">Product Category</label>
                <select name="product_category_id" id="" class="form-control">

                    @foreach ($productCategories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>

                    @endforeach

                </select>
            </div>

            <div class="form-group py-2">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="name">
            </div>

            <div class="form-group py-2">
                <label for="">Description</label>
                <input type="text" class="form-control" name="description" placeholder="description">
            </div>

            <div class="form-group py-2">
                <label for="">Price</label>
                <input type="number" class="form-control" name="price" placeholder="price">
            </div>

            <div class="form-group py-2">
                <label for="">Type</label>
                <input type="text" class="form-control" name="type" placeholder="type">
            </div>

            <div class="form-group py-2">
                <label for="">Color</label>
                <input type="text" class="form-control" name="color" placeholder="color">
            </div>

            <div class="form-group py-2">
                <label for="">Dimension</label>
                <input type="text" class="form-control" name="dimension" placeholder="dimension">
            </div>

            <div class="form-group py-2">
                <label for="">Other description</label>
                <input type="text" class="form-control" name="other_description" placeholder="other_description">
            </div>

            <div class="form-group py-2">
                <label for="">Model</label>
                <input type="text" class="form-control" name="model" placeholder="model">
            </div>

            <div class="form-group py-2">
                <label for="">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" placeholder="serial_number">
            </div>

            <div class="form-group py-3">
                <label for="one">Product Image:</label> <br>
                <input type="file" name="product_image" class="form-control-file" id="one">
            </div>
            <div class="form-group py-3">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>

        </form>
        </div>

      </div>
    </div>
  </div>



</div>


    <products-component  appurl="{{config('app.url')}}" userid="{{Auth::user()->id}}"  ></products-component>
</div>

@endsection
