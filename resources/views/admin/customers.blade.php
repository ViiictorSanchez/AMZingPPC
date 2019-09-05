@extends('layouts.app')

@section('content')


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Manage Customer</h1>
  <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Record</a>

</div>

<!-- Content Row -->
<div class="row">



  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-12 mb-4">



      <!-- Begin Page Content -->
      <div class="container-fluid" id="app">


        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>  --}}     

       {{--  <div id="app"> --}}
          <tableadgroups></tableadgroups>  
       {{--  </div> --}}

      </div>
      <!-- /.container-fluid -->


    </div>

  </div>




</div>
<!-- content row -->



@endsection