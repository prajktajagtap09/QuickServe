<!DOCTYPE html>
<html lang="en">
<head>
	@include('home.css')

    <style>
        body{
            padding-top: 110px;
        }
        table
        {
            border: 1px solid whitesmoke;
            margin:40px;
            padding: 40px;
        }
        th
        {
         padding: 10px;
         text-align: center;
         background-color: blue;
         color: white;
         font-weight: bold;
        }
        td
        {
            padding: 10px;
            color: white;
        }
        .div_center
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 200px;
        }
        label
        {
            display: inline-block;
            width: 200px;
        }
        .div_deg
        {
            padding: 20px;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    


     <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#gallary">Gallary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#book-table">Book-Table</a>
            </li>
        </ul>
        <a class="navbar-brand m-auto" href="#">
            <img src="assets/imgs/logo.svg" class="brand-img" alt="">
            <span class="brand-txt">Food Hut</span>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#blog">Blog<span class="sr-only">(current)</span></a>
            </li>

                     @if(Route::has('login'))

                     @auth

                      <li class="nav-item">    
                <a class="nav-link" href="{{ url('my_cart') }}">Cart</a>
            </li>


                         <form  action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input class=" btn btn-primary ml-xl-4 " type="submit" value="logout">
                         </form>
                   @else
            <li class="nav-item">    
                <a class="nav-link" href="{{route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('register') }}">Register</a>
            </li>
            @endauth
          @endif

          
        </ul>
    </div>

</nav>

<div  id="gallary" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <table>
            <tr>
                <th>Food Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Food Image</th>
                <th>Remove</th>
            </tr>
            <?php
            $total_price = 0;
            ?>

              @foreach($data as $data)
            <tr>
                <td>{{ $data->title }}</td>
                <td>{{ $data->price }}</td>
                <td>{{ $data->quantity }}</td>
                 <td>
                    <img  width="150" src="food_img/{{ $data->image }}" alt="">
                 </td>
                 <td>
                    <a  onclick="return confirm('Are you sure to delete this ?')" class="btn btn-danger" href="{{ url('delete_cart',$data->id) }}">Remove item</a>
                 </td>
            </tr>

                     <?php
                     $total_price = $total_price + $data->price;
                     ?>


            @endforeach
        </table>

        <h1>Total Price : {{ $total_price }}</h1>
    </div>
    

    @if(session('message'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
Swal.fire({
    title: 'Deleted!',
    text: "{{ session('message') }}",
    icon: 'success',
    timer: 2000,
    showConfirmButton: false
});
</script>

@endif

{{-- Orders Place --}}

<div class="div_center">
    <form action="{{ url('order_confirm') }}" method="post">
        @csrf
<div class="div_deg">
    <label for="">Name</label>
    <input type="text" name="name" value="{{ Auth()->user()->name }}">
</div>
<div class="div_deg">
    <label for="">Email</label>
    <input type="email" name="email" value="{{ Auth()->user()->email }}">
</div>
<div class="div_deg">
    <label for="">Phone</label>
    <input type="text" name="phone" value="{{ Auth()->user()->phone }}">
</div>
<div class="div_deg">
    <label for="">Address</label>
    <input type="text" name="address" value="{{ Auth()->user()->address }}">
</div>

 <div>
    <input class="btn btn-info" type="submit" value="Confirm">
</div>
</form>

    @if(session('msg'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
Swal.fire({
    title: 'Order Confirm!',
    text: "{{ session('msg') }}",
    icon: 'success',
    timer: 2000,
    showConfirmButton: false
});
</script>

@endif
</div>
  </body>
</html>
