<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Client
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct($this->getConfig());

           // id sandbox
      $this->profileId = "3985390143818633";

    // actualizar tokens nulos automaticamente
      $this->doRefreshToken();

      $this->middleware('auth');
    }

    public function getConfig()
    {     

      $access = "Atza|IwEBIMPqWsXc8Gs8qWk0ebuEWe1wtMdmQMe1KG9I2U70ocMlzGR0gOQzcrFh9duNVRNxhnBXg6iEi79zcw45KrTYzZLZH6n0EBh08G69MVT5QxGBEqTKs3XJek9vRJhqQWGEM0-CoZNYgyxvMKn7aX1csn1QT7UfmpYNS3Hh_vIi0666yeB2bZ5WbbgoTksFLMWBsfjWT11mIGPfvVGbp2XhU5SNZbaa48WEJTiqKcYO-uIf6oKCXtVeDZ6chBFMa0xlP3mPjfgkJV15CMn99uAfaiMblHiEI5JlE8ffVTQ2QXZj9ebvG1nORkhpXK4KSX9sNS2kRa3hIQEXAnRF1Q9kAKSxc6sRrY3oLlhfDEzxCJ_IJ8zqqqXuHRn9b9lO8_BUhBNEReLVc3HiqM5jVfuH4NzEFZBxlSei4tXKpYl8chocv3niATikVgeERGbwAk2Jx8SEwEmUXXH2yKno0PbWepcIqnub9rhoSBDHUbD2A_CVw5bRe43aqSmG1x9TOMCmIMcZUl8q_S_HusaiasFDOcWLfCQJuW_K4UZs32RaYm1NAMB8UgunpOw0DxSSaw_vpz-8EIUWbD3qAtzPKjXr7hR-";

      $refresh = "Atzr|IwEBIESXqc8Ln2sZKcS4Dlu99tcvpsXvHF68RGqWb8r8w6m-gGwBrC_1S2_bOO2D5kH9-fvnov0xlGDupq51ESRH-Wil2gbJzuOeXBlqMh87h6rrGEfC49iE5Db051O88-LHcaBjrhjClUwnBW1KFbqRPvKt2LIOQ0zLIzTlNamEt-MJH1hTuCZEKXxAnNDxChZktH11QHDNGaWQoHLWrcThKuSshzVosiY8XQnssB0Nh5yubGGSYH08O7AnwmtciTEpDKX12uCVSCNFMgK4fFMhLxvgLWO-UJfRrcFRBoNUW0AUirOMCBXU3lZYpZ7FwSQWHNp6RtQTpvQd-8EeggbBSuIvDwnYwsDCTW_MO03qFsl-TM7h8Dmn4OPTv087ECf3eoOrB8-5AB-rmiaj0_imm9hF4Z1wU62EpPwatRy3LnyPEZgNnlmI2TEWa4LzVXUWuEHu5mE-h7hqnv0Wb4PBQZZ4Ntp85N6pcxuaxlEZVmTg8zHTqp3L137zehoiyqKNLO7_ei_L7EC6a1ulHJWIFABc2bo5DDeAt9wOTG1kMV50f5PjusVF0umx1sr5Ikjy5_k";


      return $this->config = array(
        "clientId" => "amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3",
        "clientSecret" => "3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9",
        "region" => "na",
        "accessToken" => $access,
        "refreshToken" => $refresh,
        "sandbox" => true);  


    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $request->session()->flash('signin_message', 'Welcome back:
        ');     

      return view('admin.home');

    }

   


}
