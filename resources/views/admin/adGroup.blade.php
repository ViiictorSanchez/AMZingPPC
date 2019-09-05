@extends('layouts.app', ['taken2' => $taken2])

@section('title','Ppc Manager')


@section('content')

<script>
        $( function() {
          $( "#tabs" ).tabs();


        } );
</script>

 <div class="row " class="tabless">
      <ul class="ul-margin-display">
          <li><a href="{{route('admin/ppcmanager')}}" class="btn btn-info" role="button">Campaigns</a></li>
          <li><a href=" {{route('/admin/AdGroup')}} " class="btn btn-info" role="button">Ad Groups</a></li>
          <li><a href="#" class="btn btn-info" role="button">Ads</a></li>
          <li><a href="{{route('/admin/keywords')}}" class="btn btn-info" role="button">Keywords</a></li>
          <li><a href="{{route('/admin/Products')}}" class="btn btn-info" role="button">Products</a></li>
          <li><a href="#" class="btn btn-info" role="button">SearchTerms</a></li>
            
          <div class="row display-filter-date">
              <div class="btn-group margin-filter-date">
                  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span>ALL</span> <i class="fa fa-caret-down"></i>
                   </div>
               </div>
             </div>          
       </ul>
   </div>

     <div class="container width-container" id="tabs-1">
       <div class="row margin-filters-flex">
          <div class="dropdown col-lg-12" >
            <div id="tabs-1">
              <div class="row">
              <p class="account-span"> Accounts: <strong> {{ $seller->name }} </strong> <br> <span class="size-marketplace">Marketplaces: {{ $profile->name}} </span> </p>
              <p class="margin-filter-span"> Filter View:<span> <strong> Saved filter V1.1 </strong></span></p>
                <div class="dropdown margin-separate-sort">
                 <button class="btnm dropdown-toggle" type="button" data-toggle="dropdown">
                 <span id="sort_drop">Sort</span></button>
                    <ul  class="dropdown-menu">
                      <span>Sort By: </span>
                                                      
                    </ul> 
                  </div>
              <div class="dropdown" style=" margin-right: 20px;">
                <button class="btnm dropdown-toggle" type="button" data-toggle="dropdown">
                <span></span>Filters</button>
                
               </div>

             <div class="dropdown" style=" margin-right: 20px;">
                <button class="btnm dropdown-toggle" type="button" data-toggle="dropdown">
                <span></span>Customize</button>
                 <ul class="dropdown-menu margin-contains customize">
                                                           
                </ul>
               </div>
             </div>

             <div class="row">                        
                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box  box-ppc">
                        <div class="inner">
                          <h3 id ="ppc_sales">$0</h3>
                          <p>PPC Sales </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                     </div>
                 </div>

                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box  box-ppc">
                         <div class="inner">
                          <h3  id ="ppc_spend">$0</h3>
                          <p>PPC Spend</p>
                         </div>
                         <div class="icon">
                          <i class="ion ion-bag"></i>
                         </div>
                     </div>
                 </div>

                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box box-ppc">
                      <div class="inner">
                        <h3 id ="ppc_profit">$0</h3>

                        <p>PPC Profit</p>
                       </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                       </div>
                     </div>
                 </div>

                 <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box  box-ppc">
                        <div class="inner">
                          <h3 id ="ppc_acos">0%</h3>

                          <p>PPC ACoS</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        </div>
                 </div>

                  <div class="filters-wrapper" >
                    <div class="filter-item tags-filters">
                    
                    </div> 
                 </div>
               </div> <!-- end row -->   
                
          
           <div class="mb-4">

            <table id="adGroups" class="table table-responsive table-hover table-striped" style="">    
              <thead>
                <tr>
                  <th></th>
                  <th >Actions</th>
                  <th >Account</th>
                  <th >Campaign</th>
                  <th >Ad Group</th>
                  <th >Keyword</th>
                  <th >Match Type</th>
                  <th >Status</th>               
                  <th >Suggested bid</th>
                  <th >Bid</th>                
                  <th >Impressions</th>
                  <th >Clicks</th>
                  <th >CTR</th>
                  <th >Spend</th>
                  <th >CPC</th>
                  <th >Orders</th>
                  <th >Sales</th>
                  <th >ACOS</th>
                  <th >Conversion Rate</th>                         
                </tr>
              </thead>        
             </table>
       </div>      
      
   </div>
   
   <script src="/js/adGroup.js"></script>

@endsection