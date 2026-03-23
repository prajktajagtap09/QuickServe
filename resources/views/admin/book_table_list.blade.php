<!DOCTYPE html>
<html>
  <head> 
    
    @include('admin.css')

    
  <style>
        table{
            border: 1px solid white;
            margin: auto;
            width: 1000px;
        }

        th{
            color: white;
            font-weight: white;
            font-size:22px;
            text-align: center;
            background-color: blue;
            padding: 10px;

        }
        td{
            color: black;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background-color: white;
        }
    </style>
  </head>
  <body>
     @include('admin.header')

     @include('admin.sidebar')

     
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
<table>
    <tr>
        <th> Mobile Number</th>
        <th>No of Guests</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
    
    @foreach ($data as $data)
        
  
    <tr>
       <td>{{ $data->phone }}</td>
       <td>{{ $data->guest }}</td>
       <td>{{ $data->date }}</td>
       <td>{{ $data->time }}</td>
    </tr>

      @endforeach
</table>
      </div>
    </div>
  @include('admin.js')
  </body>
</html>