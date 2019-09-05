<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

	public function index()
	{ 
		return view('dashboard');            	

	}


	public function info()
	{ 

		// echo "info";

		
		// verify that the access token belongs to us
		// $c = curl_init('https://api.amazon.com/auth/o2/tokeninfo?access_token=' . urlencode($_REQUEST['access_token']));
		// curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

		// aqui obtienes el token por la url
		$c = curl_init('https://api.amazon.com/auth/o2/tokeninfo?access_token=' . urlencode($_REQUEST['access_token']));
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

		// var_dump($c);

		$r = curl_exec($c);
		var_dump($r);

		curl_close($c);

		$d = json_decode($r);

		// var_dump($d);

		// if ($d->aud != 'amzn1.application-oa2-client.a37888985f7647d8a9bd0dbe9ae80409') {
  // // the access token does not belong to us
		// 	header('HTTP/1.1 404 Not Found');
		// 	echo 'Page not found';
		// 	exit;
		// }

		// if ($d->aud != 'amzn1.application-oa2-client.6530a799097b401683a92863d42d7574') {
  // // the access token does not belong to us
		// 	header('HTTP/1.1 404 Not Found');
		// 	echo 'Page not found';
		// 	exit;
		// }

// exchange the access token for user profile
		$c = curl_init('https://api.amazon.com/user/profile');
		curl_setopt($c, CURLOPT_HTTPHEADER, array('Authorization: bearer ' . $_REQUEST['access_token']));
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

		$r = curl_exec($c);
		curl_close($c);
		$d = json_decode($r);

		// aqui obtienes tu informacion email etc
		echo sprintf('%s %s %s', $d->name, $d->email, $d->user_id);
		
		// var_dump($d);


		// http://127.0.0.1:8000/dashboard/info?access_token=Atza%7CIwEBIOxO4-Y77bco9RfhEX7qvoXnjTAAIaeJXJj9vMheJ3FVVnoL4byReIjqaC0w58UoNeDSd6gEPFnK9P833_FyurAHiKFsBJWGlDgxE-H2WPqlK-Lr4aou8HMqISVEpul0jbWzDBVGfaZLkHPXkVQmZIgmI27d2EshosetmGeSrnh-G-U1zJZVTJwimi-xqNsz6NIM1LbKIPg37UCwFzuCffn_xdyVRV1lH3Yig5gI5VGWeIZ_v_3AZFi343WtxMOt-V3A8tNxtjBXDtbgxpP78i7Qvnt3E4o9uc9Av4KluuG2pFCYpqzUdO2DA_JrP_q80UUyvDewJRPJ1jszjDoKdpVUg5VA9BF0Rpvd5V_icaIIjvimm4I_uhBiqLfNua12uqP4gRivFkDzsusG0_Bxr0Fucl7yMGSYmCbHkLRRRsPHlKc6sUcpXHuvKCYcPTe2guKgjB20iPrdhTQPdXBfNVD5KxTNJZHPtqEf0aulXWqyl1PleswuyFPGJYw92cl1N4aBlUk5lU4KZsdmmCCxBV6kLyc6Zi4tKakvXFOdyF_JVQ&token_type=bearer&expires_in=3600&scope=profile 


// 		curl  \
// 		-X POST \
// 		-H "Content-Type:application/x-www-form-urlencoded;charset=UTF-8" \
// 		--data "grant_type=authorization_code&code=&redirect_uri=http://127.0.0.1:8000/dashboard/info&client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99&client_secret=a515521444ec6d99ddd21d358f74ec4b13607db7e30679f576eef5a3b38d0a55
// " \
//     https://api.amazon.com/auth/o2/token 



    // http://127.0.0.1:8000/dashboard/info?access_token=Atza%7CIwEBIJxJFy-yO2TLUuV6c_qSZEBxldlZTkML7vtKssSWwNIVrX10glOW7OnfPGps1ECyh2Y0oJf3JyLE0djVQQS0uePXDvnZ388tvSgJ2vPpPEI6MKdNrsAu3hQ7chIXq8mxz9G1Jsjq2BaGU8kclS1qeGGWtSoqYevjBEyf8H-7zxXjbjYpf1PZTHSi4LkaL9ZJG745qtIWq3kcnXhFqOKCh8J1gneI_h1PnD2quUgU_NbLJoGgnc0_F6Rwd1CfNmPnl8goXTeERw9uBJEeKvptzNdG8A-zcvbg24bLEBXI1on1lKtEeqbrrKNxhAvykaBimAUgd8cn4VZENmoem7Ke__fW3EHYRcCyJzmuzga6efx3TUNjjBQ8csH6D1Ty7FIMr4GP1VYY9SH5jVOv-TlIT1k08yh0arMyb2CyeWP3GH9DLXgjj2o8jUrOdgwzoLNFVUMzqqKBjPQU2lMnSEwF1uFupCrfbOXUYd_KLEO7ewuz7k7FruF6OO6fuKFfnIjjf8U8IO6t9SiB6HCwGwCYGxewMw7qYKYs1affjRZQNY6DPSWdBr-mQLMURCgqryN1DCd6k3VYoFOkexnLoB0-ZE-V&token_type=bearer&expires_in=3600&scope=profile
  

    // https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99
    // &scope=cpc_advertising:campaign_management&response_type=code
    // &redirect_uri=http://127.0.0.1:8000/dashboard/info

//     curl  \
//     -X POST \
//     -H "Content-Type:application/x-www-form-urlencoded;charset=UTF-8" \
//     --data "grant_type=authorization_code&code=Atza%7CIwEBIOxO4&redirect_uri=http://127.0.0.1:8000/dashboard/info&client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99&client_secret=a515521444ec6d99ddd21d358f74ec4b13607db7e30679f576eef5a3b38d0a55
// " \
//     https://api.amazon.com/auth/o2/token


 // https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99
 //    &scope=cpc_advertising:campaign_management&response_type=amzn1.application-oa2-client.6530a799097b401683a92863d42d7574
 //    &redirect_uri=http://127.0.0.1:8000/dashboard/info


// 		    curl  \
//     -X POST \
//     -H "Content-Type:application/x-www-form-urlencoded;charset=UTF-8" \
//     --data "grant_type=authorization_code&code=amzn1.application-oa2-client.6530a799097b401683a92863d42d7574&redirect_uri=http://127.0.0.1:8000/dashboard/info&client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99&client_secret=a515521444ec6d99ddd21d358f74ec4b13607db7e30679f576eef5a3b38d0a55
// " \
//     https://api.amazon.com/auth/o2/token


		// http://127.0.0.1:8000/dashboard/info?access_token=Atza%7CIwEBIKearRA5UkAWiSTmIJqtW3-NOyNtBGwEpx_UA2M3B4UO07jAwoAyu7MTak_a9sV_hkqOW7EnhfUno8qg-eDK9TMroX1HWD-1j9_zRkv4i72QexmbBVkzwRezqJCZcI9YVfZn3TXzmHs_WiZ3F3ucxaQfzC4F9Gkm9tca2QqTM89KKxHq7FogRb2-rMk3wy2FlWLc3xstXmtLdyajjx_fikOFLtyiWylrDhtZJx-mpSD99NSokiyLUpdjcCKBSfLe8IaioN7_BBVOfwWGpNhdaxINIKsy301MfSyYfN55cyHT4NnJTORKZ-e43XVvUEOxilxvhFXHRyal1L2ScIQKUPuMXP_HFT_kvuCCrndPfIUJYgRV-7jsHGcpB7klwy_H6O59OixYPH-_JnZgeb2yBmwLIawjhu566b-wL0Pjq8eTkMI0sRM-zOkZOtCrrq0VEY7PS3i2BcbdCVw1hclBs9QKWdrXkkSV5qAkTmVWkkJEHZuidI1mPQQEuNrmRVProWwrImb9T5CKA-wsNpAFRDS6LeRNHC7-Xacr3vpSusS8gw&token_type=bearer&expires_in=3600&scope=profile

		// https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99
  //   &scope=cpc_advertising:campaign_management&response_type=code
  //   &redirect_uri=http://127.0.0.1:8000/dashboard/info


		// https://162.243.173.161/dashboard/info?access_token=Atza%7CIwEBIBo6F0vbkdsTKeN2Ff3m55tNPyR9uhRBi7yJPVkJZjsVAQz1ER4YtQkTFlwyQIupa46BBd2DtA5_fFbqRR_xlrpnfFx-Q8tM71DK0xcrv-VpnYYidWOUynvkj8aFgHTo23x3XE7o-d7JQ0Yuoqm6yVe6wGVAHoZIpE2oPGjj2-nRKrtDuQbJVpY1-HunwuMdLDDy8Fl8ALy3usn0LD0BII0AHkcG8JPokv-xp6qZg_5om6joh2xoUVElGlVCuxH7z1kQozM5WV2tyx9woLowPW09H7CXMfbEaGpDhxZBNMcDI191QinkD-l9xn05ahB3r-eM11i5tlf8nkLXqcBzeN_BoBDvfTSihvSw8GOPwQa3xLwT35Z7gf-ZafXSX_0b8TBpzaWwQsP7QkzXOhmFF5AntPqXTDytcAj2687jQVDRM7kEyHVwxxRezkgto5Icg87JWb7ZAU05cWC3kIuOSFP6_SWdS6bWiiSiAcHEszbYOgP8JLuKpu-PiObLxrwIpqjTx-P-a8UWgaF9Lbqq4zrUHkqWGlREecL3c0KGkAl8wA&token_type=bearer&expires_in=3600&scope=profile


		// curl -X PUT \
  //    -H "Authorization: Bearer ACCESS_TOKEN" \
  //    -H "Content-Type: application/json" \
  //    -d '{"countryCode":"IN"}' \
  //    https://advertising-api-test.amazon.com/v1/profiles/register


  //    	curl -X PUT \
  //    -H "Authorization:Atza%7CIwEBIBo6F0vbkdsTKeN2Ff3m55tNPyR9uhRBi7yJPVkJZjsVAQz1ER4YtQkTFlwyQIupa46BBd2DtA5_fFbqRR_xlrpnfFx-Q8tM71DK0xcrv-VpnYYidWOUynvkj8aFgHTo23x3XE7o-d7JQ0Yuoqm6yVe6wGVAHoZIpE2oPGjj2-nRKrtDuQbJVpY1-HunwuMdLDDy8Fl8ALy3usn0LD0BII0AHkcG8JPokv-xp6qZg_5om6joh2xoUVElGlVCuxH7z1kQozM5WV2tyx9woLowPW09H7CXMfbEaGpDhxZBNMcDI191QinkD-l9xn05ahB3r-eM11i5tlf8nkLXqcBzeN_BoBDvfTSihvSw8GOPwQa3xLwT35Z7gf-ZafXSX_0b8TBpzaWwQsP7QkzXOhmFF5AntPqXTDytcAj2687jQVDRM7kEyHVwxxRezkgto5Icg87JWb7ZAU05cWC3kIuOSFP6_SWdS6bWiiSiAcHEszbYOgP8JLuKpu-PiObLxrwIpqjTx-P-a8UWgaF9Lbqq4zrUHkqWGlREecL3c0KGkAl8wA" \
  //    -H "Content-Type: application/json" \
  //    -d '{"countryCode":"IN"}' \
  //    https://advertising-api-test.amazon.com/v1/profiles/register


  //    https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99
  //   &scope=cpc_advertising:campaign_management&response_type= access_token=Atza%7CIwEBIBo6F0vbkdsTKeN2Ff3m55tNPyR9uhRBi7yJPVkJZjsVAQz1ER4YtQkTFlwyQIupa46BBd2DtA5_fFbqRR_xlrpnfFx-Q8tM71DK0xcrv-VpnYYidWOUynvkj8aFgHTo23x3XE7o-d7JQ0Yuoqm6yVe6wGVAHoZIpE2oPGjj2-nRKrtDuQbJVpY1-HunwuMdLDDy8Fl8ALy3usn0LD0BII0AHkcG8JPokv-xp6qZg_5om6joh2xoUVElGlVCuxH7z1kQozM5WV2tyx9woLowPW09H7CXMfbEaGpDhxZBNMcDI191QinkD-l9xn05ahB3r-eM11i5tlf8nkLXqcBzeN_BoBDvfTSihvSw8GOPwQa3xLwT35Z7gf-ZafXSX_0b8TBpzaWwQsP7QkzXOhmFF5AntPqXTDytcAj2687jQVDRM7kEyHVwxxRezkgto5Icg87JWb7ZAU05cWC3kIuOSFP6_SWdS6bWiiSiAcHEszbYOgP8JLuKpu-PiObLxrwIpqjTx-P-a8UWgaF9Lbqq4zrUHkqWGlREecL3c0KGkAl8wA&token_type=bearer&expires_in=3600&redirect_uri=https://162.243.173.161/dashboard/info

  //   https://www.amazon.com/ap/oa?client_id=YOUR_LWA_CLIENT_ID
  //   &scope=cpc_advertising:campaign_management&response_type=code
  //   &redirect_uri=YOUR_RETURN_UR

  //    https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99
  //   &scope=cpc_advertising:campaign_management&response_type=code
  //   &redirect_uri=https://162.243.173.161/dashboard/info


  //   curl  \
  //   -X POST \
  //   -H "Content-Type:application/x-www-form-urlencoded;charset=UTF-8" \
  //   --data "grant_type=authorization_code&code=AUTH_CODE&redirect_uri=YOUR_RETURN_URL&client_id=YOUR_CLIENT_ID&client_secret=YOUR_SECRET_KEY" \
  //   https://api.amazon.com/auth/o2/token


  //   curl  \
  //   -X POST \
  //   -H "Content-Type:application/x-www-form-urlencoded;charset=UTF-8" \
  //   --data "grant_type=authorization_code&code=access_token=Atza%7CIwEBIBo6F0vbkdsTKeN2Ff3m55tNPyR9uhRBi7yJPVkJZjsVAQz1ER4YtQkTFlwyQIupa46BBd2DtA5_fFbqRR_xlrpnfFx-Q8tM71DK0xcrv-VpnYYidWOUynvkj8aFgHTo23x3XE7o-d7JQ0Yuoqm6yVe6wGVAHoZIpE2oPGjj2-nRKrtDuQbJVpY1-HunwuMdLDDy8Fl8ALy3usn0LD0BII0AHkcG8JPokv-xp6qZg_5om6joh2xoUVElGlVCuxH7z1kQozM5WV2tyx9woLowPW09H7CXMfbEaGpDhxZBNMcDI191QinkD-l9xn05ahB3r-eM11i5tlf8nkLXqcBzeN_BoBDvfTSihvSw8GOPwQa3xLwT35Z7gf-ZafXSX_0b8TBpzaWwQsP7QkzXOhmFF5AntPqXTDytcAj2687jQVDRM7kEyHVwxxRezkgto5Icg87JWb7ZAU05cWC3kIuOSFP6_SWdS6bWiiSiAcHEszbYOgP8JLuKpu-PiObLxrwIpqjTx-P-a8UWgaF9Lbqq4zrUHkqWGlREecL3c0KGkAl8wA&token_type=bearer&expires_in=3600&redirect_uri=https://162.243.173.161/dashboard/info&client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99&client_secret=a515521444ec6d99ddd21d358f74ec4b13607db7e30679f576eef5a3b38d0a55" \
  //   https://api.amazon.com/auth/o2/token


  // https://162.243.173.161/dashboard/info?access_token=Atza%7CIwEBIMxDpt_72vC9FYpNhMLZ7I50AS1uIJe_3pJ4Sw9XgrIDZQpOilOoQYH43PvkNEZpbwcquUpCbwoVk__k-onouyuWBgli21Czfz6d0d7vetYQXRQgh0I0RIoMGBORm2tbEG0K4rVhPVBNvBuCmgeYP1ltXrSocU31xW1Jl6SIFYJcDTZkvfUXo5XxF5tt6HBqnxdVfsqgDEXFFopZBhowecEjrmBozsWs4k4CLtL79kjy5qiywIbA_dxDmEhSdhVkqR_eyfnwR9Z8qMUKu8xn9z_mzqR4zE68LyBHiMqcdOCQmtwBxbl5un2P2nrSEpPuwRuWHG6zC79fFhegzw_epu-ffwJArk0Q6DSwVu6wZiNJ7vGG84rqHgMWAF1b3lFzIYNj5XxCCktrtKnMN4NFiger-s19ObNNaSZdttt_NbccUplkjGWCxu4lMKN66laK-hC68_i4V9WRat5YZ8RDlD8cH5MOHTMqTVPcU5Rr7_cNmC5ebp4vqod5sb3OY7s5hVoUClVZSsWBJ9Zv0oFng-_MFmZ2lN7fXnN_iZUo6QZtgEtJXSQe1gI7x86s2pcWD70&token_type=bearer&expires_in=3600&scope=profile

  // https://www.amazon.com/ap/oa?client_id=YOUR_LWA_CLIENT_ID
  //   &scope=cpc_advertising:campaign_management&response_type=code
  //   &redirect_uri=YOUR_RETURN_URL



  //   https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99
  //   &scope=cpc_advertising:campaign_management&response_type=code
  //   &redirect_uri=https://162.243.173.161/dashboard/info   


}

public function token()
{

// 	    curl  \
//     -X POST \
//     -H "Content-Type:application/x-www-form-urlencoded;charset=UTF-8" \
//     --data "grant_type=authorization_code&code=Atza%7CIwEBIOxO4-Y77bco9RfhEX7qvoXnjTAAIaeJXJj9vMheJ3FVVnoL4byReIjqaC0w58UoNeDSd6gEPFnK9P833_FyurAHiKFsBJWGlDgxE-H2WPqlK-Lr4aou8HMqISVEpul0jbWzDBVGfaZLkHPXkVQmZIgmI27d2EshosetmGeSrnh-G-U1zJZVTJwimi-xqNsz6NIM1LbKIPg37UCwFzuCffn_xdyVRV1lH3Yig5gI5VGWeIZ_v_3AZFi343WtxMOt-V3A8tNxtjBXDtbgxpP78i7Qvnt3E4o9uc9Av4KluuG2pFCYpqzUdO2DA_JrP_q80UUyvDewJRPJ1jszjDoKdpVUg5VA9BF0Rpvd5V_icaIIjvimm4I_uhBiqLfNua12uqP4gRivFkDzsusG0_Bxr0Fucl7yMGSYmCbHkLRRRsPHlKc6sUcpXHuvKCYcPTe2guKgjB20iPrdhTQPdXBfNVD5KxTNJZHPtqEf0aulXWqyl1PleswuyFPGJYw92cl1N4aBlUk5lU4KZsdmmCCxBV6kLyc6Zi4tKakvXFOdyF_JVQ&redirect_uri=http://127.0.0.1:8000/dashboard/info&client_id=amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99&client_secret=a515521444ec6d99ddd21d358f74ec4b13607db7e30679f576eef5a3b38d0a55
// " \
//     https://api.amazon.com/auth/o2/token     




		// verify that the access token belongs to us
// 	$c = curl_init('https://api.amazon.com/auth/o2/tokeninfo?access_token=' . urlencode($_REQUEST['access_token']));
// 	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

// 	$r = curl_exec($c);
// 	curl_close($c);
// 	$d = json_decode($r);

// 	if ($d->aud != 'amzn1.application-oa2-client.3672c64e7ede49b2b93e390d94ab2a99') {
//   // the access token does not belong to us
// 		header('HTTP/1.1 404 Not Found');
// 		echo 'Page not found';
// 		exit;
// 	}

// // exchange the access token for user profile
// 	$c = curl_init('https://api.amazon.com/user/profile');
// 	curl_setopt($c, CURLOPT_HTTPHEADER, array('Authorization: bearer ' . $_REQUEST['access_token']));
// 	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

// 	$r = curl_exec($c);
// 	curl_close($c);
// 	$d = json_decode($r);

// 	echo sprintf('%s %s %s', $d->name, $d->email, $d->user_id);




		// http://127.0.0.1:8000/dashboard/info?access_token=Atza%7CIwEBIM6UIFGD2SKYK1MyxCTK9wSKPxITY3VzYtkcDCLrM9HP6f5BBPWQbCVfVSuXbcpqGtd8bvBHtkhbCWBU5mu7sK3HgHJC9Ld6pfywOcTy5m8tpU7Hgq1Uh0Y17Uk55AV0X65CbwISptEfdMj04FFqwBhNsRjNnhiH8nrPqF9NDeRyZqa6W8SwdEd49ZYswhNTKzH4qzmEfOZRHNmdjCaCsrD8DkFz9u_1rd1gqr0W06pvzTQP1_LiYfsvtf5PoScRskmEfS5LSDlCOBHjoMVLkg9puKjxQLljnGNdm0TLrX43HMXb-NcKNpWv48drCz_WFgYKqg30kLtsyxEtCoYKPMaEhWtAQ-LHAiyPxHYOAjHN2978zMTW2NhT3xB-KQmhnyfYeg8rJFuBG9sN3i4Yf9WvZ8lfjDOLp7mH3QxuqQd92blU4kxLXf9Hsim6rbGRj3PdWKFCaQbqfuU4GE6VzIP4Lrtpi_XeS8Baa8m1wVPnpWmtcyweAZ1ZQlOv--G7xj9mNjf9w41m66tsfpLUhl_JwOvxpL_Pi9pSNnPsVQOLWahD-X_MKY8-5E14HfXpvoM&token_type=bearer&expires_in=3600&scope=profile   




	}

}
