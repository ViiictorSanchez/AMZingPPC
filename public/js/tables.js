
$( function() 
{
  let dates = [moment().subtract(1, 'days').format('YYYYMMDD')];
  let table = $('#campaigns').DataTable({
    "scrollY":"600px",
    "scrollCollapse":true,
    "deferLoading": 57,
    "autoWidth": true,
    "columnDefs": [
      { "width": "20%", "targets": 0 }
    ],
    "ajax":{
      "url": "reports",
      "data": function ( d ) { 
        d.dates = dates;
 
      }
    },
   
    "initComplete": function(settings, json) {
      // // console.log( 'DataTables has finished its initialisation.' );
      boxDataFiltered();
    },
    'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="d-flex justify-content-center" style="z-index: 10">'+
            '<div class="spinner-border" role="status">'+
             ' <span class="sr-only">Loading...</span>'+
            '</div>'+
          '</div>'

         },            
    columns: [
       {
         'data':'info',
          'checkboxes': {
             'selectRow': true
          }, 
       },
       { 'data':'info',render: function(data,type,row){
          //actions
          let html;
          if(row.state!='archived'){
          html = '<div class="dropdown links">'
            +' <button class="btn button-orange dropdown-toggle" type="button" data-toggle="dropdown">'
            +'</button>'
              +'<ul class="dropdown-menu">'
                      +'<li>'
                      +'<form method="POST" action="/budget/increase" accept-charset="UTF-8">'
                          +' <input type="hidden" name="id_campaign" value="'+row.id+'">'
                          +' <input type="hidden" name="bud_mount" value="'+row.dailyBudget+'">'
                          + '<div class="input-group" style="display:flex; flex-wrap: nowrap;">'
                              + '<select class="btnm" name="dir" id="">'
                                  +'<option value="1">Increase</option>'
                                  +'<option value="0">Decrease</option>'
                              + '</select>'
                            + '<select class="btnm" name="optionDir" id="">'
                                  + '<option value="1">$</option>'
                                  + '<option value="0">% percentage</option>'
                              + '</select>'
                            + '<input style="width: 150px; height: 40px;" type="number" id="inBudget" name="budget" class="form-control border-0 small inBudget" placeholder="budget" aria-label="Search" aria-describedby="basic-addon2" required="">'
                              + '<div class="input-group-append">'
                                + '<input class="btn-primary increa" type="submit" value="+">'
                              + '</div>'
                          + '</div>'
                        +'</form>'
                      +'</li>'
                    +'<br>'
                    +'<li>'
                      + '<a data-toggle="Pause Campaign" title="Pause Campaign" href="/pause/camp/'+row.id+'">'
                        + '<span class="">Pause Campaign</span>'
                      +'</a>'
                  +'</li>'
                  +' <br>'
                    +' <li>'
                        + '<a data-toggle="Enable Campaign" title="Enable Campaign" href="/create/campaigns/'+row.id+'">'
                        +'<span>Enable Campaign</span>'
                        +'</a>'
                    +'</li>'
              +'</ul>'
            +'</div>'
        }else {
          html ='';
        }
          return html;
        }
      },
       { "data": "info" },
       { "data": "id"},
       {  'data':'info',render: function(data,type,row)
          {
            return 'SP';
          }
      },
       { "data": "targetingType"},
       { "data": "dailyBudget" , render: function(data,type,row)
        {
            return '$'+data;
        }
       },
       { "data": "startDate", render: function(data){
            return data.slice(0, 4) + '/' + data.slice(4,6) + '/' + data.slice(6);
       }
      },
       {  'data':'info',
          render: function(data){
            //endDate
            return '-';
          }
       },
       { "data": "state"},
       { "data": "impressions", render: function(data){
          return data.toString().replace(".",",");
       }
      },
       {  "data": "clicks" },
       {  'data':'info',
        render: function(data,type,row)
        {
          //cpc
          if(row.clicks > 0)
          {
            let calc = (row.spend/row.clicks)*100;
            return calc.toFixed(2)+'%';
          }
          return '-';
        } 
       },
       {  "data": "spend", render: function (data)
        {
         if(data != '-') return '$'+data.toFixed(2);
         else return data;
        }
       },
       {  "data": "sales" , render: function (data)
        {
          if(data != '-') return '$'+data.toFixed(2);
          else return data;
        }
       },
       {  "data": "orders" },
       { 'data':'info',
        render: function(data,type,row)
        {
          //profit
          let calc = (row.sales - row.spend);
          if(calc!=0){
            return '$'+calc.toFixed(2);
          }
          return '-';
        }
      },
       {
        'data':'info',
        render: function(data,type,row)
        {
          //acos
          if(row.sales>0) {
              let calc = (row.spend/row.sales)*100
              return calc.toFixed(2)+'%';
          }
          return '-';
        }
       },
       {'data':'info',
        render: function(data,type,row)
        {
          //conversion
          if(row.clicks>0) {
              let calc = (row.orders/row.clicks)*100
              return calc.toFixed(2)+'%';
          }
          return '-';
        } 
      },
       { 
        'data':'info', 
        render: function(data,type,row)
        {
          //clickrate 
          if(row.impressions>0) {
              let calc = (row.clicks/row.impressions)*100
              return calc.toFixed(2)+'%';
          }
          return '-';
        }
      }
    ],
    'select': {
       'style': 'multi',
       'selector': 'td:first-child'
    },     
    'order': [[1, 'asc']],
    "lengthMenu": [100, 150, 250, 500 ],
    "dom": 'rt<"d-flex justify-content-between"ipl>'

  });

  // APPLY CUSTOMIZE
  $('#apply').click( function( event ){

    event.preventDefault();

      let checked = $(".customize [type=checkbox]").map(function ()
      {
        return this.checked;
      }).get();

      for(var i = 0; i < checked.length; i++){
        var column = table.column(i+1);
        if(checked[i]) column.visible(true);
        else column.visible(false);
      }

  });

  // CLEAR 

  $('#clear').click( function(e){
    e.preventDefault();
    var count = 0;

    $(".customize [type=checkbox]").map(function ()
    {
      this.checked = false;
      count++;
    });

  
      for(var i = 0; i < count; i++){
        var column = table.column(i+1);
        column.visible(true);
      }

      $(".customize").removeClass("show");;

  });
  

  function boxDataFiltered ()
  {
    let $ppc_sales = $( '#ppc_sales' );
    let $ppc_spend = $( '#ppc_spend' );
    let $ppc_profit = $( '#ppc_profit' );
    let $ppc_acos = $( '#ppc_acos' );
   
    // let table = $( '#campaigns' ).DataTable();
    let sales_sum = [];
    table.column(14, { search:'applied' } ).data().each(function(value) 
    {
      let comp = parseFloat(value);
      if( !isNaN(comp) ) sales_sum.push(comp);
    });
    let spend_sum = [];
    table.column(13, { search:'applied' } ).data().each(function(value) 
    {
      let comp = parseFloat(value);
      if( !isNaN(comp) ) spend_sum.push(comp);
    });
    let profit_sum = [];
    table.column(16, { search:'applied' } ).data().each(function(value) 
    {
      let comp = parseFloat(value);
      if( !isNaN(comp) ) profit_sum.push(comp);
    });
    let acos_percent = [];
    table.column(17, { search:'applied' } ).data().each(function(value) 
    {
      let comp = parseFloat(value);
      if( !isNaN(comp) ) acos_percent.push(comp);
    });
    const aformatter = new Intl.NumberFormat( 'en-US' , 
    {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 2
    });
    if(sales_sum.length != 0 )
    {
      $ppc_sales.text( aformatter.format( sales_sum.reduce( function ( a , b )
        {
          return  a  +  b ;
        }) 
        ) 
      );
    } else $ppc_sales.text('$0');
    if(spend_sum.length != 0 )
    {
      $ppc_spend.text( aformatter.format( spend_sum.reduce( function ( a , b )
          {
          return  a  +  b ;
          }) 
        ) 
      );
    } else $ppc_spend.text('$0');
    if(profit_sum.length != 0 )
    {
      $ppc_profit.text( aformatter.format( profit_sum.reduce( function ( a , b )
          {
          return  a  +  b ;
          }) 
        ) 
      );
    } else $ppc_profit.text('$0');

    if(acos_percent.length != 0 )
    {
      $ppc_acos.text( (acos_percent.reduce( function ( a , b )
      {
        return  a  +  b ;
        }) ).toFixed(2)+'%' 
      );
    } else $ppc_acos.text('0%');
  }
  boxDataFiltered();
  function deletedCampaign( evt )
  {
    let confirms;
    confirms = confirm("Are you sure to pause this campaign?");
    if ( !confirms )
    {        
      event.preventDefault();
    }
  }
  function pauseAdgroup( evt )
  {
    let confirms;
    confirms=confirm("Are you sure to pause this adgroup?");
    if ( !confirms ) 
    {
      event.preventDefault();
    }
  }
  $( '.dropdown-menu' ).on( 'click', function( event ) 
  {
    event.stopPropagation();
  });

  $( 'body'  ).on( 'click', function( event ) 
  {
    let target = $( event.target );
    if ( target.parents( '.bootstrap-select' ).length )
    {
      event.stopPropagation();
      $( '.bootstrap-select.open' ).removeClass( 'open' );
    }
  });	
//SORT BY COLUMN
  $( "#sort" ).click(function ( event )
  {
    // let table = $( '#campaigns' ).DataTable();
    let column = $( '#sort_by' ).children( "option:selected" ).val();
    let select_text = $( '#sort_drop' ).text($( '#sort_by' ).children( "option:selected" ).text() );
    let sort_dir =  $( '#sort_dir' ).children( "option:selected" ).val();
    table
    .column( column )
    .order( sort_dir )
    .draw();
  });

// FILTER OPTIONS
  let values = {
      "campaign_name": {
          'contain': 'Contains',
          'not_contain' : 'Not contains'
      },
        "campaign_status": {
          'enabled': 'Enabled',
          'paused' : 'Paused',
          'archived' : 'Archived'
      },
      "ppc":{
        'greater' : 'Greater Than',
        'equals': 'Equal To',
        'less': 'Less Than'
      },
  };
  let $vendor = $( '#main_select' );
  let $model = $( '#select_0' );
  $vendor.change( function() 
  {
    $model.empty().append( function() 
    {
      var output = '';
      $.each( values[$vendor.val()], function( key, value ) 
      {
        output += '<option value='+key+'>' + value + '</option>';
      });
      return output;
    });
    let $input = $( '#filter_input' );
    if( $vendor.val() == "campaign_status" )
    {
        $input.hide();
    }else
    {
      $input.show();
    }
  }).change();

// FILTER 
  let multiple_input = []; // to save multiple input filter from campaign name
  let multiple_select = []; // to save multiple select from campaign status
  let columns_filtered = []; // All filters
 // save columns index and name 
  $( "#filter" ).click( function ( event )
  {
    // let table = $( '#campaigns' ).DataTable();
    let $main_select = $( '#main_select' );
    let column_index = $main_select.children( "option:selected" ).attr( 'row_index' );
    let column_value = $main_select.children( "option:selected" ).val();    
    let first_filter = $( '#select_0' ).val();
    let input_text = $( '#filter_input' ).val();
    if( column_index == 2 )
    {
      if( first_filter == 'contain' )
      {
        multiple_input.push( input_text ); // save all inputs
        input_filter = multiple_input.join(' '); // to filter multiple inputs
        table
        .columns( column_index )
        .search( input_filter )
        .draw();
      }else
      {
        $.fn.DataTable.ext.search.push( (settings, row) => 
        {
          let rowData = row[column_index];
          if ( settings.nTable.id !== 'campaigns' ) 
          {
            return true;
          }
          return ( ( rowData.toLowerCase().indexOf( input_text.toLowerCase() ) === -1 ) || ( input_text == null ) );
        });
        table.draw();
      }
    }else if( column_index == 9 )
    {
      multiple_select.push( first_filter ); // save all selects
      select_filter = multiple_select.join(' '); // to filter multiple selects
      table
      .columns(column_index)
      .search(select_filter)
      .draw();
    }
    else if( column_value == 'ppc' )
    {
      let input_text = $( '#filter_input' ).val();
      $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex )
        {
          if ( settings.nTable.id !== 'campaigns' ) 
          {
              return true;
          }
          let number = parseFloat( input_text );
          let first = data[column_index].replace('-',0);
          
          let table_data = parseFloat( data[column_index].replace(/[$%]/g,'') ) || 0; 
          if( first_filter == 'greater' )
          {
            if ( isNaN( number )  ||  ( table_data >= number ) )
            {
                return true;
            }
            return false;
          }
          if( first_filter == 'equals' )
          {
            if ( isNaN( number ) || ( table_data == number ) )
            {
                return true;
            }
            return false;
          }
          if( first_filter == 'less' )
          {
            if ( isNaN( number )  ||  ( table_data <= number ) )
            {
                return true;
            }
            return false;
          }     
        });
       

      table.draw();
    }
    boxDataFiltered ();
    //FILTER TAGS
    let $tags_container = $( '.filter-item' );
    let column_name = $main_select.children( "option:selected" ).text();
    let filter_name = $( '#select_0' ).children( "option:selected" ).text();
    if( column_index == 9 ) input_text = '';
    columns_filtered.push({
      index: column_index,
      filter: first_filter,
      data: input_text,
    });
    // console.log (columns_filtered);
    $tags_container.append( function() 
    {
            var output = '';
            output += '<div style="display: flex; margin: 10px; " id="filter-container">'+
                        '<div class="filter-value">'+
                          '<span id="filter_info" class="text-muted text-uppercase font-weight-bold font-xs d-inline mr-1">'+column_name+' '+filter_name+' '+input_text+'</span>'+
                        '</div>'+
                        '<span id="filter_remove" class="fa fa-window-close filter-delete" column='+column_index+' aria-hidden="true"></span>'+
                      '</div>';
            return output;
        });
  });
  function reFilter()
  {
    //CLEAR ALL FILTERS
    table.search('').columns().search('').draw();
    $.fn.dataTable.ext.search.length = 0;
    table.draw();
    //SET FILTERS
    let input_data = multiple_input.join(' ');
    let select_data = multiple_select.join(' ');
    columns_filtered.forEach( ( filter ) => 
    { 
      if( filter.index == 2 )
      {
        if( filter.filter == 'contain' )
        {
          table
          .columns( filter.index )
          .search( input_data )
          .draw();
        }else
        {
          $.fn.DataTable.ext.search.push( (settings, row) => 
          {
            let rowData = row[filter.index];
            if ( settings.nTable.id !== 'campaigns' ) 
            {
                return true;
            }
            return ( ( rowData.toLowerCase().indexOf( filter.data.toLowerCase() ) === -1 ) || ( filter.data == null ) );
          });
          table.draw();
        }
      }else if( filter.index == 9 )
      {
        table
        .columns(filter.index)
        .search(select_data)
        .draw();
      }
      else if( filter.index != 8 )
      {
        $.fn.dataTable.ext.search.push(
          function( settings, data, dataIndex )
          {
            if ( settings.nTable.id !== 'campaigns' ) 
            {
               return true;
            }
            let number = parseFloat( filter.data );
          
            let table_data = parseFloat( data[filter.index] ) || 0; 

            if( filter.filter == 'greater' )
            {
              if ( isNaN( number )  ||  ( table_data >= number ) )
              {
                  return true;
              }
              return false;
            }
            if( filter.filter == 'equals' )
            {
              if ( isNaN( number )  ||  ( table_data == number ) )
              {
                  return true;
              }
              return false;
            }
            if( filter.filter == 'less' )
            {
              if ( isNaN( number )  ||  ( table_data <= number ) )
              {
                  return true;
              }
              return false;
            }  
          }
        );
        table.draw();
      }else if( filter.index == 8 ){
         $.fn.DataTable.ext.search.push( (settings, row) => 
          {
            let rowDate = row[filter.index];
            if ( settings.nTable.id !== 'campaigns' ) 
            {
                return true;
            }
            if( filter.data.length > 0 && filter.data[0] === filter.data[1] )
            {
              return rowDate == filter.data[0];
            }
            return ( (rowDate >= filter.data[0] || filter.data[0] == null) && (rowDate <= filter.data[1] || filter.data[1] == null));
          });
          table.draw();
      }
    })
    boxDataFiltered ();
  }   

  $(document).on( 'click', '#filter_remove' , function()
   {
    $this = $ ( this );
    $tags = $( '.filter-delete' );
      let date_index = columns_filtered.findIndex( filter => filter.filter === 'date' );
      let tag_index = $tags.index( this ); 
      if ( date_index != -1 && ( tag_index >= date_index ) ) 
      {
          tag_index += 1;
      }
      if( columns_filtered[ tag_index ].index == 2 && columns_filtered[ tag_index ].filter == 'contain' )
      {
        multiple_input.splice( multiple_input.indexOf( columns_filtered[ tag_index ].data ), 1 );
      }else if( columns_filtered[ tag_index ].index == 9 )
      {
        multiple_select.splice( multiple_select.indexOf(columns_filtered[ tag_index ].filter), 1 );
      }
      columns_filtered.splice( tag_index , 1 );
  
    reFilter();
    //Remove tag
    $this.parent().remove();
  });

  let min = moment().format('YYYY-MM-DD');
  table.on( 'select', function ( e, dt, type, indexes )
  {
    let $operations = $( '#operations' ).fadeOut(500);
    $( '#bulk-operations' ).fadeIn(500);
    let select_items = table.rows( { selected: true } ).data();
    // // console.log(select_items,'ejjejeje');
    let select_info = $operations.children(':first').text(select_items.length+' campaigns selected: ');
    let $modal_table = $( '#multi_modal' ).find( 'tbody:last-child' );
    $modal_table.empty().append( function() 
    {
        let output = '';
        let options = ['archived','enabled','paused'];
    
        $.map( select_items , function ( item, index )
        { 
         
          let select = '';
          
          options.forEach( (option, i) => {
              if( option == item.state ){
                select += `<option value="${option}" selected>${option}</option>`;
              }else{
                select += `<option value="${option}">${option}</option>`;
              }
          });
        
          output += `<tr>
            <td>
                <input type="hidden" name="id_campaign[]" value="${item.id}">
            </td>
            <td>
              <select name="status[]">
              ${select}
              </select>
            </td>
            <td>${item.info.split('\n')[0]}</td>
            <td><input name="budget[]" type="number" step="any" value="${item.dailyBudget}" required></td>
            <td><input readonly name="start_date[]" type="text" value="${item.startDate.slice(0, 4) + '/' + item.startDate.slice(4,6) + '/' + item.startDate.slice(6)}"></td>
            <td><input name="end_date[]" type="date" min="${min}"></td>
          </tr>`;
        });
      return output;
    });
  });
  table.on( 'deselect', function ( e, dt, type, indexes ) {
    
    
    let select_items = table.rows( { selected: true } ).data();
    let select_info = $( '#operations' ).children( ':first' ).text(select_items.length+' campaigns selected: ');

    if( select_items.length == 0)
    {
      $('#operations').fadeOut(500);
      $('#bulk-operations').fadeOut(500);
    } 
    let $modal_table = $( '#multi_modal' ).find( 'tbody:last-child' ).empty().append( function() 
    {
      let output = '';
      let options = ['archived','enabled','paused'];
     
      $.map( select_items , function ( item, index )
      {       
        let select = '';
        options.forEach( (option, i) => {
            if( option == item.state ){
              select += `<option value="${option}" selected>${option}</option>`;
            }else{
              select += `<option value="${option}">${option}</option>`;
            }
        });
        output += `<tr>
            <td>
                <input type="hidden" name="id_campaign" value="${item.id}">
            </td>
            <td>
              <select name="status[]">
              ${select}
              </select>
            </td>
            <td>${item.info.split('\n')[0]}</td>
            <td><input name="budget[]" type="number" step="any" value="${item.dailyBudget}" required></td>
            <td><input name="start_date[]" type="date" min="${min}"></td>
            <td><input name="end_date[]" type="date" min="${min}"></td>
          </tr>`;
        
      });

      return output;
    });
    
  } );


  let start = moment().subtract(1, 'days');
  let end = moment().subtract(1, 'days')
  // let mindate = moment().subtract(59, 'days');
  // let maxdate = start;
  //let a2 = moment("20190511", "YYYYMMDD").format('YYYY-MM-DD');
  function cb(start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  }
  let date_range = [];
  $('#reportrange').daterangepicker({
      startDate: start,
      endDate : end,
     // minDate: mindate,
     // maxDate: maxdate,
    
      ranges: {
         
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],
         'Last 30 Days': [moment().subtract(30, 'days'), moment().subtract(1, 'days')]
        //  'This Month': [moment().startOf('month'), moment().endOf('month')],
        //  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);
  cb(start,end);

  $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
 
     date_range.length = 0;
     $('#reportrange span').html(picker.chosenLabel+': ' + picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));

    let startDate = picker.startDate;
    let endDate = picker.endDate;
    dates.length = 0;
    let aux = startDate.clone();
    if( startDate === endDate) dates.push( startDate.format( 'YYYYMMDD') );
    else while( aux < endDate ){
      dates.push(aux.format( 'YYYYMMDD') );
      aux.add(1, 'days');
    }
    table.ajax.reload(boxDataFiltered);
  });
    $("#bulk-btn").on('click', function() {
      
      let select_items = table.rows( { selected: true } ).data();
      let campaigns_bo = '' 
      $.map( select_items , function ( item, index ){ 
          campaigns_bo = campaigns_bo == '' ? item.id : campaigns_bo+','+item.id
      });
      $("#bo-campaigns").val(campaigns_bo)
      let selectedAction = $("#bo-action").children("option:selected").val();
      
      $.ajax({url: "/admin/bulk-operations", 
        data:{
          campaigns: campaigns_bo,
          value_budget: $("#bo-value").val(),
          action: selectedAction
        },
        success: function(result){
          table.ajax.reload(boxDataFiltered);
        }
      });
    });
});

$("input:checkbox").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
//Select 2 load
$(document).ready(function() {
  $('#selectSellers').select2({
  });
  //call ajax to refresh
  $( "#selectSellers" ).change(function() {
    console.log('seler changed');
  });
});