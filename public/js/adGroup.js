$( function() 
{

    let dates = [moment().subtract(2, 'days').format('YYYYMMDD')];
    let table = $('#adGroups').DataTable({
        "scrollY":"600px",
        "scrollCollapse":true,
        "deferLoading": 57,
        "autoWidth": true,
        "columnDefs": [
        { "width": "10%", "targets": 0 }
        ],
        "ajax":{
        "url": "reportAdGroups",
        "data": function ( d ) { 
            d.dates = dates;
          }
        },
        "initComplete": function(settings, json) {
         //boxDataFiltered();
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
            'data':'id',
            'checkboxes': {
                'selectRow': true
            }, 
        },
        { 'data':"id",render: function(data,type,row){
             //actions
            let html;
            if(row.state!='archived'){
            html = '<div class="dropdown links">'
                +' <button class="btn button-orange dropdown-toggle" type="button" data-toggle="dropdown">'
                +'</button>'
                +'<ul class="dropdown-menu">'
                        +'<li>'
                        +'<form method="POST" action="/budget/increase" accept-charset="UTF-8">'
                            +' <input type="hidden" name="id_keyword" value="'+row.id+'">'
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
                        + '<a data-toggle="Pause Campaign" title="Pause Campaign" href="#'+row.id+'">'
                            + '<span class="">Pause Keyword</span>'
                        +'</a>'
                    +'</li>'
                    +' <br>'
                        +' <li>'
                            + '<a data-toggle="Enable Campaign" title="Enable Campaign" href="#'+row.id+'">'
                            +'<span>Enable Keyword</span>'
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
        {"data": "account",render:function(data,type,row)
            {
            return 'Account';
            }
        },
        { "data": "name" },
        { "data": "adGroupId"},
        { "data": "keywordText"},
        { "data": "matchType"},
        { "data": "state"},
        { "data": "suggestBid" },
        { "data": "dailyBudget" },
        { "data": "impressions"},
        { "data": "clicks"},
        { "data": "id", 
            //CTR
             render: function(data,type,row)
             {
                if(row.impressions > 0)
                {
                    let calc = (row.clicks/row.impressions)*100;
                    return calc.toFixed(2)+'%';
                }
                return '-';
             } 
        },
        { 'data':'spend'},
        { 'data': 'id', 
            //CPC 
         render: function(data,type,row)
         {
            if(row.clicks > 0)
            {
                let calc = (row.spend/row.clicks)*100;
                return calc.toFixed(2)+'%';
            }
            return '-';
            } 
        },
        { 'data': 'orders' },
        { 'data': 'sales'},
        { 'data':'id',
            render: function(data,type,row)
            {
            //ACOS
            if(row.sales > 0)
            {
                let calc = (row.spend/row.sales)*100;
                return calc.toFixed(2)+'%';
            }
            return '-';
            } 
        },
        {  'data':'id',
            render: function(data,type,row)
            {
            //Conversion Rate
            if(row.clicks > 0)
            {
                let calc = (row.orders/row.clicks)*100;
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
    
    let start = moment().subtract(1, 'days');
    let end = moment().subtract(1, 'days')
    function cb(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    let date_range = [];
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate : end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],
            'Last 30 Days': [moment().subtract(30, 'days'), moment().subtract(1, 'days')]
            //'This Month': [moment().startOf('month'), moment().endOf('month')],
            //'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
    table.ajax.reload();
  });

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