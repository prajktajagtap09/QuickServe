<!DOCTYPE html>
<html>
  <head> 
    <base href="/public">
    <style>
        .div_deg
        {
            padding: 10px
        }
        label{
            display: inline-block;
            width: 200px
        }
    </style>
    @include('admin.css')
  </head>
  <body>
     @include('admin.header')

     @include('admin.sidebar')

     
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

           <h1>Modify Food Details:</h1>

          <form action="{{ url('edit_food',$food->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="div_deg">
                <label for="">Food Title :</label>
                <input type="text" name="title" value="{{ $food->title }}">
            </div>

            <div class="div_deg">
                <label for="">Food Details:</label>
                <textarea name="detail" id="">{{ $food->detail }}</textarea>
            </div>


             <div class="div_deg">
                <label for="">Food Price :</label>
                <input type="text" name="price" value="{{ $food->price }}">
            </div>

             <div class="div_deg">
                <label for=""> Current Food Image :</label>
               <img width="150px" src="food_img/{{ $food->image }}" alt="">
            </div>

             <div class="div_deg">
                <label for=""> Change Food Image :</label>
              <input type="file" name="image">
            </div>

             <div class="div_deg">
                
              <input class="btn btn-warning" type="Submit" value="Update Food" >
            </div>


          </form>
      </div>
    </div>
  @include('admin.js')
  </body>
</html>