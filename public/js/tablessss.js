// alert("test");


// $('#test').click(function(event) {
	
// 	alert();
// });

// console.log(BASE_URL);

// console.log(typeof(BASE_URL));



// tabla de campanas
$.ajax({
	url: BASE_URL+'/view/campaigns',	 
	dataType: 'json',	
})
.done(function(result) {
	// console.log("success" + result);

 //    console.log(typeof(result));

	// console.log(result);

	// result.unshift("Lemon");

	// console.log(result);



	// console.log(result.response);	

	// console.log(result[0].response);

	// console.log(result[1].response);

	// var data = JSON.parse(result[1].response);

	// var data = JSON.parse([result[0].response,result[1].response]);


	// var data = JSON.parse(result[0].response);

	// var datas = JSON.parse(result[1].response);

	// var data = JSON.parse(result.response);

	// console.log(data);

	// console.log(datas);

	// typeof(data);
	// console.log(typeof(data));

	// var data.unshift(datas);

	// console.log(data);





	// console.log(data[0].campaignId);	

	// var obj = { campaig: data, metrics: datas };


	// obj.push("test");

	// console.log(obj);

	

	// $.each(obj, function(index, val) {

		// console.log(val);

			// console.log(val[0].name);

		// console.log(val[0].campaignId);
		// console.log(val[0].cost);
	 	// console.log(val.campaignId + val.name + val.campaignType + val.targetingType + val.state + val.dailyBudget + val.startDate);




// $("#campaign").html('<table id="tableUsers"class="table table-responsive table-hover table-striped" > '
// 	+ '<thead><tr><th >Actions</th><th >Campaign</th><th >Campaign Type</th><th >Targeting Type</th><th >Budget</th><th>Start Date</th><th>End Date</th><th>State</th><th>Cost</th><th>Clicks</th><th>Impressions</th></thead>'
// 	+ '<tbody id="tablet"></tbody></table>'
// 	);

$.each(result, function(index, val) {

// console.log(val);

console.log(val.response);

var json = JSON.stringify(val);

// JSON.parse(val.reponse);

console.log(json);

console.log(typeof(json.reponse));

// console.log(val.response.reponse);

	// $("#tablet").append(
	// 	'<tr>'
	// 	+ '<td>' + '<div class="dropdown">'
	// 	+ '<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">'
	// 	+ '<span class="fas fa-fw fa-cogs"></span></button>'
	// 	+ '<ul class="dropdown-menu">'
	// 	+ '<li><a  class="btn btn-success btn-sm fas fa-plus-square" onclick="editButget( ' + val[0].campaignId + ',' + val[0].dailyBudget + ')"></a>Increase budget</li>'
	// 	+ '<li><a  class="btn btn-warning btn-sm fas fa-edit" onclick="editButgetDe( ' + val[0].campaignId + ',' + val[0].dailyBudget + ')"></a>Decrease budget</li>'
	// 	+ '<li><a  class="btn btn-danger btn-sm fas fa-plus-square" onclick="pauseCamp( ' + val[0].campaignId + ')"></a>Pause Campaign</li>'
	// 	+ '<li><a  class="btn btn-primary btn-sm fas fa-edit"></a>Enable Campaign</li>'
	// 	+ '</ul>'
	// 	+ '</div> '
	// 	+ '</td>'
	// 	+ '<td>' + val[0].name + '<br>' + val[0].campaignId + '</td>'
	// 	+ '<td>' + val[0].campaignType + '</td>'		
	// 	+ '<td>' + val[0].targetingType + '</td>'		
	// 	+ '<td>' + val[0].dailyBudget + '</td>'
	// 	+ '<td>' + val[0].startDate + '</td>'
	// 	+ '<td>N/A</td>'
	// 	+ '<td>' + val[0].state + '</td>'
	// 	+ '<td>' + val[0].cost + '</td>'
	// 	+ '<td>' + val[0].clicks + '</td>'
	// 	+ '<td>' + val[0].impressions + '</td>'    
 //  +'</tr>' 
 //  )


});



})
.fail(function(err) {
	console.log("error" + err);
});


// function para editar campañas
// function editButget(id)
// {

//   window.location=BASE_URL + '/edit/butget/' + id;
// }


function editButget(id,budget)
{

  window.location=BASE_URL + '/edit/butget/' + id + '/' + budget;
}


function editButgetDe(id,budget)
{

  window.location=BASE_URL + '/edit/butgetde/' + id + '/' + budget;
}


function pauseCamp(id)
{

  window.location=BASE_URL + '/pause/camp/' + id;
}




// function edit()
// {

//   window.location=BASE_URL + '/update/campaigns';
// }








// $(document).ready(function() {
// 	$('#example').DataTable( {
// 		"ajax": "data/objects.txt",
// 		"columns": [
// 		{ "data": "name" },
// 		{ "data": "position" },
// 		{ "data": "office" },
// 		{ "data": "extn" },
// 		{ "data": "start_date" },
// 		{ "data": "salary" }
// 		]
// 	} );
// } );



// table users
// $(document).ready(function() { 
//     $('#table').DataTable({       
//         "ajax": {
//             url : BASE_URL+'Users/load',
//             type : 'GET'
//         },

//     });
// });

// leads table
// $(document).ready(function() { 
//     $('#tableLeads').DataTable({       
//         "ajax": {
//             url : BASE_URL+'leads/load',
//             type : 'GET'
//         },

//     });
// });


// // customers table
// $(document).ready(function() { 
//     $('#tableCustomers').DataTable({       
//         "ajax": {
//             url : BASE_URL+'customers/load',
//             type : 'GET'
//         },

//     });
// });



// // customers table
// $(document).ready(function() { 
//     $('#tableUsers').DataTable({       


//     });
// });



// cargo los countrys con ajax
// $.ajax({
//   url: BASE_URL+'api/getcountrys',   
//   dataType: 'json'    
// })
// .done(function(result) {

//  // console.log(result); 

//  $.each(result, function(index, val) {

//     // console.log(val);
//     $("#country").append('<option value="'+ val.id_country + '">' + val.country + '</option>')
//    // $("#country").append('<option>' + val.country + '</option>')

//  });
// });


// // cargo los states con ajax
// $.ajax({
//   url: BASE_URL+'api/getstates',   
//   dataType: 'json'    
// })
// .done(function(result) {

//  // console.log(result); 

//  $.each(result, function(index, val) {

//    $("#state").append('<option value="'+ val.id_state + '">' + val.state + '</option>')
//    // $("#state").append('<option>' + val.state + '</option>')

//  });
// });


// // cargo los roles con ajax
// $.ajax({
//   url: BASE_URL+'api/getroles',   
//   dataType: 'json'    
// })
// .done(function(result) {

//  // console.log(result); 

//  $.each(result, function(index, val) {

//    $("#role").append('<option value="'+ val.id_role + '">' + val.role + '</option>')
//    // $("#role").append('<option>' + val.role + '</option>')  

//  });
// });



// // cargo el total de admins,usuarios,profesores y estudiantes
// $.ajax({
//   url: BASE_URL+'api/countusers',   
//   dataType: 'json'    
// })
// .done(function(result) {

//  // console.log(result);

//  // console.log(result.totalUsers.totalusers); 

//   // console.log(result.totalStudents["totalStudent"]); 

//    // console.log( typeof(result) );

//    $('#totalAdmins').html(result.totalAdmins.totaladmins);
//    $('#totalUsers').html(result.totalUsers.totalusers);
//    $('#totalTeachers').html(result.totalTeachers.totalteachers);
//    $('#totalStudents').html(result.totalStudents.totalstudents);

//  });



// // img sidebar
// $.ajax({
//   url: BASE_URL+'api/imgprofile',   
//   dataType: 'json'    
// })
// .done(function(result) {

// // console.log(result);

// $('#img').html('<img src=" ' + BASE_URL + 'uploads/thumbnails/'+ result.img +
//   ' " class="img-circle alt="User Image"" />' );
// });



// // img navbar
// $.ajax({
//   url: BASE_URL+'api/imgprofile',   
//   dataType: 'json'    
// })
// .done(function(result) {

// // console.log(result);

// $('#imgMenu').html('<img src=" ' + BASE_URL + 'uploads/thumbnails/'+ result.img +
//   ' " class="user-image alt="User Image"" />' );
// });


// // img navbar dropdown
// $.ajax({
//   url: BASE_URL+'api/imgprofile',   
//   dataType: 'json'    
// })
// .done(function(result) {

// // console.log(BASE_URL);
// // console.log(first_name);

// $('#imgMenuTwo').html('<img src=" ' + BASE_URL + 'uploads/files/'+ result.img +
//   ' " class="mg-circle alt="User Image"" />'
//   +  
//   '<p><small> ' + member_since + ' : ' + created_date + ' </small> </p>'



//   );
// });




// // cerrar mensaje de bienvenida
// $(".message").click(function(event) {

//   $(".message").hide('fast');
//     // $("minz").attr("id","cambio");
//     // $("#myfirstchart").remove("#myfirstchart");

//   });




// // funcion para eliminar usuarios, checando con la notificacion swal

// function deleteUsers(params)
// {

//     // swal("Hola mundo!");

//     console.log(params);


//     swal({
//       title: are_you_sure,
//       text: record_deleted,
//       type: 'warning',
//       showCancelButton: true,
//       confirmButtonColor: "#3085d6",
//       confirmButtonText: accept,
//       cancelButtonColor: '#d33'    

//     }).then(function(result) {



//       // console.log(result + "Usuario eliminado"); // Bien


//       // console.log(typeof(result));
//       // test = result;

//          // $("#delete").attr("id","cambio");
//          // $("#delete").attr('href',BASE_URL + 'users/deletetest/');

//          // prueba();

//          // event.preventDefault();

//          // console.log(result);

//          // verificamos si ahy resultados
//          if (result) {

//           confirmDelete(params);

//         }



//       }, function(err) {

//     // event.preventDefault();
//       // console.log(err + "Usuario no eliminado"); // Fallo

//       // return event.preventDefault();

//       // console.log(result);
//       // return false;

//     });

//   }

//   // funcion para ir a la ruta para eliminar
//   function confirmDelete(params)
//   {

//     window.location=BASE_URL + 'users/delete/' + params;
//   }



//  // tabla que cargue con json
//  // tengo 2 funciones editar y eliminar al hacer click
//  // le paso el parametro id a las funciones
//  // para editar o eliminar por id
//  $.ajax({
//   url: BASE_URL+'api/getusers',   
//   dataType: 'json'    
// })
//  .done(function(result) {

//    // console.log(result);

//  // console.log(result[0]);

// //  $.each(result, function(i, item) {
// //     console.log(item['id_user']);
// // })

// $("#table").html('<table id="tableUsers"class="table table-responsive table-hover table-striped" > '
//   + '<thead><tr><th >#</th><th >Img</th><th >First_name</th><th >Last_name</th><th >Country</th><th >State</th><th >Role</th><th >Created_date</th><th >Actions</th></tr></thead>'
//   + '<tbody id="tablet"></tbody></table>'
//   );

// $.each(result, function(index, val) {



//   $("#tablet").append(
//     '<tr>' + '<td>' + val['id_user'] + '</td>'    
//     + '<td><img src=" ' + BASE_URL + 'uploads/thumbnails/' + val['img'] + ' " class="img-responsive img-circle"/></td>'
//     + '<td>' + val['first_name'] + '</td>'
//     + '<td>' + val['last_name'] + '</td>'
//     + '<td>' + val['country'] + '</td>'
//     + '<td>' + val['state'] + '</td>'
//     + '<td>' + val['role'] + '</td>'
//     + '<td>' + val['created_date'] + '</td>'
//     + '<td><a class="approved"  ><span class="btn-success btn-xs glyphicon glyphicon-pencil" data-toggle="Edit" title="Edit" onclick="edit( ' + val['id_user'] + ')"></span></a>'
//     + '<a id="delete"   ><span class="btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="Delete" title="Delete" onclick="deleteUsers( ' + val['id_user'] + ')"></span></a></td>'
//   // + '</tbody>'
//   +'</tr>'
//   // + '<table>'
//   )


// });



// });



// // function para editar usuarios
// function edit(params)
// {

//   window.location=BASE_URL + 'users/edit/' + params;
// }




// // pdf users
// $('#pdf').click(function(event) {
//   window.location=BASE_URL + 'users/usersPdf';

// });


// // excel users
// $('#excel').click(function(event) {
//   window.location=BASE_URL + 'users/usersExcel';

// });



// // combo dependiente country/state
// $('#country').change(function(event) {

//   var countryVal = $("#country").val();

//   $.get(BASE_URL + 'api/getcombo',{countryVal: countryVal}, function(data){

//     // el resultado llega como string, asi que lo parseo
//     // console.log(typeof(data));

//       // parseo el string
//       var par = JSON.parse(data);
//       // console.log(par);

//       // console.log(par[0].state);

//       // console.log(typeof(par));


//       $("#state").html('<option>' + par[0].state + '</option>');
//       // remuevo la opcion Select Country
//       $("#option").remove();


//     });



// });


