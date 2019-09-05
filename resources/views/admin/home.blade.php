@extends('layouts.app')

@section('title','Dashboard')

@section('content')



<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>


  @if(Session::has('signin_message'))

  <h2 class="text-success"> {{session('signin_message')}}{{ Auth::user()->name }}</h2>


  @endif

</div>


<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-12 mb-4">



{{-- <div class="row-fluid">
  <div class="span12">

    <div class="box">
      <div class="box-title">
        <h3>
          <i class="icon-link"></i>
          Help keep Amazon Product Advertising API Alive!
        </h3>
      </div>
      <div class="box-content">
        <blockquote>
          <p>
            Amazon require associate account to make purchase to proof valid usage of their Product Advertising API.  We need your help.  Before you buy something from Amazon, please click on the Buy It button from the link below.
          </p>
          <small>Andrew</small>
        </blockquote>
        <a href="https://deeplink-bh.datafeedfile.com/amazon/" target="_blank" class="btn-primary btn-large">Buy from Amazon</a>
      </div>
    </div>

    <h3></h3>


  </div>
</div>
--}}



<!-- Content Row -->
<div class="row">

  <!-- Content Column -->



  




</div>
<!-- content row -->

</div>

</div>




<script type="text/javascript">
  function deletedCampaign(evt){

    var confirms;

    confirms=confirm("Are you sure to delete this campaign?");
    if (confirms) {        

    } else {

      event.preventDefault();

    }
  }
</script>




@endsection
