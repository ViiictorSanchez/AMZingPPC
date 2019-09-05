<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\User;
use App\Seller;
use App\Profile;
use App\Campaign;
use App\Metric;
use App\Mp;
use App\keywordMetric;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Client
{
    public function __construct()
    {

      parent::__construct($this->getConfig());
      $user = User::firstOrFail();
     
      
     $this->profileId = (int)$user->profile_default;
       
      $this->doRefreshToken();

      $this->middleware('auth');
    }

    public function getConfig()
    {     
      $access = "Atza|IwEBIJ2V4xmzVzI2B9aiaX63-U5xxqT4jtCUl6vsfJ6_qf1Cn76dGlmnhexYd6p3AwdORZdfHOl4E1qMoQDTle-mMCNr3ubWgmIOs9QJYhAVlmQl1RFlIZqLXSUx4FJT4WKFo1CCi8h9aYwtV4OmBCKTSKW59ktpxrW-iR8BBZJOFlBX9Hijjf9Aqdfonpx6gzqgeb7qdWBLWhQHDKCjSYwwWYO6GiJ3ZbQi3y65wThU0CZ__8V2hzI7zdzbncer-cbHETwjhY3U_FxiZRCvDYe9Xmo6jYryGhZs3uGx-kqtwK5kdRZ1uU5eAHAUYpBrvXB3tqYda9rp1-Aefm8Bl7fCuqT2qT1JeVgbc1PjCCODcEM-6Bnc9nN2oqbInaQC-65wT5Fx9cHDn2Lm-h72felPGXlcCo8itO8wvdN6TGkZPqPP5gRWCzd_FkVRNKZaog-KU9LWiZSvQU8Z92Tsfoyr5NT8B7Eup5dgahdPNKmQVpXqxN9nCJV3XBDtiz7_trRIbBiOEwGXTp1Xw4uHRbulSWeQuU7IYaQBTs7wqy2bgjC9oP0DpesEpFJ6RAMJmB5fSNeUx4G9UBYZUR13R4n4-ks6";
      $refresh = "Atzr|IwEBIEdiw-fwluKw5_M6v4zfxRdyScrnfbKUQyUxgLbIjJCqU0vUBHKMdZRcV5si_hkiQbyyV8LO4MS-HxY9bBlK_1hmj933qZngJw_5ZTNMgKfcBJkbvczFvlcKhFUmaxsQYGQp-e9Z9FBSalEH6H8lE0x50Z08nO0Fbh42Mu-FXv97ZVeyO3jUPZGhotXRvDAmiYOUpzvxb3k1iVw726HGpvxqogteY4DSE0JQmK9J9thSoTerNte1NlylP2xL8XTi137cgPgmic4f3c4qwVNsNx03W9KIo3yuDB-AJJr_7BWn7_IM1nrwZq8QQYLjCqozjCC7vybdkqAaVSMjlQfDT2tf8RDs9tHRenL2Dsaq-01u-q49fbTlQmTI3Q5mS5pezLQz_BDTjhY4BGcDeLAcpkdyUsCe_niId6zDKNyWB_6qp2q0se3IXkxsWDtrBTt18OuDfSyTHdCI0k8bcCIWsx9s-iF_0Jp2fD3y_02sx4viBC5eLL3JbLxQNKF8K8DGN0Auaqi3BpnMV6P2mSVQSN8bj2R5G_lbVp1jIVyltTcL9_VZlCb_ddmQntae1Wdgoo5A7bAQdIrZJZ5OemcfVZqi";
      return $this->config = array(
        "clientId" => "amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3",
        "clientSecret" => "3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9",
        "region" => "na",
        "accessToken" => $access,
        "refreshToken" => $refresh,
        "sandbox" => false
      );  
    }
   
    public function index()
    {
        $taken2 = array();
        $taken2 = Seller::select('seller_id','name')->distinct()->get();
        $nameTagSeller = User::find(Auth::user()->id);
        $profile = Mp::find($nameTagSeller->profile_default);
        $seller = Seller::where('mp_id','=',$nameTagSeller->profile_default)->first();
        return view('admin.products',['taken2' => $taken2, 'profile'=>$profile, 'seller'=>$seller]);

    }
    public function reports(Request $request)
    {
      $dates = $request->dates;
      //get days from server
      if(!empty($dates)){
        $dateIni = reset($dates);
        $dateEnd = end($dates);
        $nameTagSeller = User::find(Auth::user()->id);
        $profile = Mp::find($nameTagSeller->profile_default);
        $dbData = keywordMetric::obtainData(Auth::user()->id,$dateIni,$dateEnd,$profile->profile_id,$profile->seller_id);
      }
      
      return response()->json([
        'data' => $dbData,
      ]) ;

    }
}
