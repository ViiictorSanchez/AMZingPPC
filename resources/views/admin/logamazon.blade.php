@extends('layouts.app')

@section('content')


<!-- Content Row -->
<div class="row">

  <div>
  
    <div id="amazon-root"></div>
    <script type="text/javascript">
      window.onAmazonLoginReady = function() {
        amazon.Login.setClientId('amzn1.application-oa2-client.a37888985f7647d8a9bd0dbe9ae80409'); //Aqui tu id de cliente(YOUR-CLIENT-ID)
      };
      (function(d) {
        var a = d.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.id = 'amazon-login-sdk';
        a.src = 'https://api-cdn.amazon.com/sdk/login1.js';
        d.getElementById('amazon-root').appendChild(a);
      })(document);
    </script>

      {{--   cuenta cliente --}}
   {{--    <div id="amazon-root"></div>
    <script type="text/javascript">
      window.onAmazonLoginReady = function() {
        amazon.Login.setClientId('amzn1.application-oa2-client.a37888985f7647d8a9bd0dbe9ae80409'); //Aqui tu id de cliente(YOUR-CLIENT-ID)        
      };
      (function(d) {
        var a = d.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.id = 'amazon-login-sdk';
        a.src = 'https://api-cdn.amazon.com/sdk/login1.js';
        d.getElementById('amazon-root').appendChild(a);
      })(document);
    </script> --}}
    
  </div>




  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-12 mb-4">


     


      <!-- Begin Page Content -->
      <div class="container-fluid">

        <br>
        <br>
        <br>
        <br>
        
        <a href="#" id="LoginWithAmazon">
          <img border="0" alt="Login with Amazon"
          src="https://images-na.ssl-images-amazon.com/images/G/01/lwa/btnLWA_gold_156x32.png"
          width="156" height="32" />
        </a>

        <a id="Logout">Logout</a>

        

        

      </div>
      <!-- /.container-fluid -->


    </div>
    <!-- content row -->




  </div>

  {{-- <div class="col-lg-6 mb-4">     

  </div> --}}

  <div>
   {{--  <button id="LoginWithAmazon" class="btn btn-secondary" type="button">Test auth amazon</button> --}}

 {{--   <a href="#" id="LoginWithAmazon">
    <img border="0" alt="Login with Amazon"
    src="https://images-na.ssl-images-amazon.com/images/G/01/lwa/btnLWA_gold_156x32.png"
    width="156" height="32" />
  </a>

  <a id="Logout">Logout</a> --}}

</div>



</div>

{{--  retorna serial --}}
{{-- <script type="text/javascript">
  document.getElementById('LoginWithAmazon').onclick = function() {
    var deviceModel = 'senpai1989';
    var serialNo = 'senpai1989';
    var drsScope = 'dash:replenish';
    var scopeData = new Object();
    scopeData[drsScope] = {
      device_model: deviceModel,
      serial: serialNo
    };
    var options = {
      scope: drsScope,
      scope_data: scopeData,
      response_type: 'code'
    };
    amazon.Login.authorize(options, 'http://127.0.0.1:8000');
    return false;
  };
</script> --}}



{{-- retorna el codigo --}}
{{-- <script type="text/javascript">
  document.getElementById('LoginWithAmazon').onclick = function() {
    var deviceModel = 'senpai1989';
    var serialNo = 'senpai1989';
    var drsScope = 'dash:replenish';
    var scopeData = new Object();
    scopeData[drsScope] = {
      device_model: deviceModel,
      serial: serialNo
    };
    var options = {
      scope: drsScope,
      scope_data: scopeData,
      response_type: 'code'
    };
    amazon.Login.authorize(options, 'http://127.0.0.1:8000/dashboard');
    return false;
  };
</script> --}}


{{-- <script type="text/javascript">
  document.getElementById('LoginWithAmazon').onclick = function() {
    var deviceModel = 'senpai1989';
    var serialNo = 'senpai1989';
    var drsScope = 'dash:replenish';
    var scopeData = new Object();
    scopeData[drsScope] = {
      device_model: deviceModel,
      serial: serialNo,
      should_include_non_live: true,
      is_test_device: true
    };
    var options = {
      scope: drsScope,
      scope_data: scopeData,
      response_type: 'code'
    };
    amazon.Login.authorize(options, 'http://127.0.0.1:8000/dashboard');
    return false;
  };
</script>
--}}

{{-- testing en local --}}
{{-- <script type="text/javascript">

  document.getElementById('LoginWithAmazon').onclick = function() {
    options = { scope : 'profile' };
    amazon.Login.authorize(options, 'http://127.0.0.1:8000/dashboard/info');
    return false;
  };

</script>

<script type="text/javascript">
  document.getElementById('Logout').onclick = function() {
    amazon.Login.logout();
  };
</script> --}}



<script type="text/javascript">

  document.getElementById('LoginWithAmazon').onclick = function() {
    options = { scope : 'profile' };

    amazon.Login.authorize(options, 'https://138.197.152.129/code'); //Aqui tu url de retorno)
    return false;
  };

</script>

<script type="text/javascript">
  document.getElementById('Logout').onclick = function() {
    amazon.Login.logout();
  };
</script>







@endsection
