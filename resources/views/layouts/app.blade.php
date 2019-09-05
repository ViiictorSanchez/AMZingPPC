<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- test jquery ui-->
  {{--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
  <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css">

  {{-- estilos modificados de librerias --}}
  <link href="{{ asset('css/modifid.css') }}" rel="stylesheet" type="text/css">

  {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
 <!--  {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
  {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}  -->

<!-- 
  {{-- sweet alert --}}
 {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
  {{ -- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/> --}} -->
  

  <!-- Custom fonts for this template-->
  <link href="{!! asset('theme/vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
  <!-- {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}} -->

  <!-- Custom styles for this template-->
  {{-- <link href="{!! asset('theme/css/sb-admin-2.min.css') !!}" rel="stylesheet"> --}}

  <link href="{!! asset('theme/css/sb-admin-2.css') !!}" rel="stylesheet">
   

<!-- Bootstrap core JavaScript-->
<script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>


  <!-- DatePicker-->
  <link href="{!! asset ('css/datepicker.min.css')!!}" rel="stylesheet" type="text/css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

  <script type="text/javascript">
    var BASE_URL = {!! json_encode(url('/')) !!};
  </script>
  <style>
    #multi_modal
    {
      text-align : center;
    }
    #multi_modal .modal-dialog
    {
      max-width : 100%;
      width : auto !important;
      display : inline-block;
    }
    
    .dataTables_processing {
      position: relative;
  top: 130px;
        z-index: 11000 !important;
    }


  </style>
</head>

<body id="page-top">


  {{-- <div id="amazon-root"></div>
  <script type="text/javascript">

    window.onAmazonLoginReady = function() {
      amazon.Login.setClientId('amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99');
    };
    (function(d) {
      var a = d.createElement('script'); a.type = 'text/javascript';
      a.async = true; a.id = 'amazon-login-sdk';
      a.src = 'https://assets.loginwithamazon.com/sdk/na/login1.js';
      d.getElementById('amazon-root').appendChild(a);
    })(document);

  </script> --}}


  <!-- Page Wrapper -->
  <div id="wrapper">
   {{--  si el usuario esta logeado muestro la sidebar --}}
   @if(Auth::check())

   

   @endif



   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      {{--  si el usuario esta logeado muestro la navbar --}}
      @if(Auth::check())

      @include('admin.inc.navbar', ['taken2'=> $taken2])

      @endif

      <!-- Begin Page Content -->
      <div class="container-fluid">



         {{--  @include('admin.inc.navbar')


         @include('admin.inc.sidebar') --}}



         @yield('content')



         <!-- Scroll to Top Button-->
         <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="multi_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Adjust Campaign</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              {!! Form::open(['method'=>'POST', 'action'=> 'PpcManagerController@multiEditCampaigns']) !!}                   
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th scope="col">Status</th>
                      <th scope="col">Campaign Name</th>
                      <th scope="col">Daily Budget</th>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>   
                    </tr>
                  </thead>
                  <tbody>                    
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                {{--<button type="button" class="btn btn-primary">Save changes</button> --}}
                {!! Form::submit('Save Changes',['class'=>'btn btn-warning']) !!}
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>

<!--               
        <div class="modal fade bd-example-modal-lg" id="multi_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <table class="table">
                  <thead>
                    <th></th>
                    <th scope="col">Campaign Name</th>
                    <th scope="col">Daily Budget</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Campaign Name</th>
                    <th scope="col">Daily Budget</th>
                  
                  </thead>
                  <tbody>
                    <td></td>
                    <td>My Campaign one</td>
                    <td><input id="budget" type="text"></td>
                    <td><input id="start_date" type="date"></td>
                    <td><input id="end_date" type="date"></td>
                    <td><input id="start_date" type="date"></td>
                    <td><input id="start_date" type="date"></td>
                  </tbody>
                </table>
            </div>
          </div>
        </div> -->


      </div>


      <!-- End of Main Content -->
    </div>




    <!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; AMZING PPC</span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->



    <!-- End of Content Wrapper -->
  </div>

  <!-- End of Page Wrapper -->
</div>



<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
      </div>
    </div>
  </div>
</div>




<!-- Bootstrap core JavaScript>
<script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script-->

<!-- Core plugin JavaScript-->
<script src="{!! asset('theme/vendor/jquery-easing/jquery.easing.min.js') !!}"></script>

<!-- Custom scripts for all pages-->
<script src="{!! asset('theme/js/sb-admin-2.min.js') !!}"></script>

<!-- Scripts -->
<script src="/js/app.js"></script>

<!-- jquery ui -->
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>



<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{!! asset ('js/dataTables.select.min.js')!!}"></script>
<script src="{!! asset ('js/dataTables.checkboxes.min.js')!!}"></script>

<link href="{{ asset('css/dataTables.checkboxes.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/select.dataTables.min.css') }}" rel="stylesheet" type="text/css">

<!-- DatePicker-->
<script src="{!! asset ('js/datepicker.min.js')!!}"></script>
<script src="{!! asset ('js/datepicker.en.js')!!}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.min.js') }}"></script>
<!-- Select 2 selector-->
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('js/select2.min.js') }}"></script>


<link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
<script src="/js/main.js"></script>     

</body>

</html>
