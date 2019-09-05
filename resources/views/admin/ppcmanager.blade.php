@extends('layouts.app', ['taken2' => $taken2])

@section('title','Ppc Manager')

@section('content')

<script>
        $( function() {
          $( "#tabs" ).tabs();


        } );

</script>
<!-- Content Row -->

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
                        <div class="box-menu">
                            <li class="dropdown-submenu margin-contains" >
                              <select class="btnm" id='sort_by'>
                                  <option value="6">Campaign Budget</option>
                                  <option value="2">Campaign Name</option> 
                                  <option value="17">PPC ACoS</option>
                                  <option value="11">PPC Clicks</option>
                                  <option value="10">PPC Impressions</option>
                                  <option value="16">PPC Profit</option>
                                  <option value="14">PPC Sales</option>
                                  <option value="13">PPC Spend</option>
                              </select>
                            </li>                                            
                            <li class="dropdown-submenu margin-contains" >
                              <select class="btnm" id='sort_dir'>
                                <option value="asc" data-type="" >Ascending</option>
                                <option value="desc" data-type="">Descending</option>
                              </select>
                            </li>   
                            <li class="dropdown-submenu margin-contains">
                              <button id="sort" class="btn btn-warning" type="button" >
                                <span class=""></span>Save</button>
                            </li>
                        </div>                                
                    </ul> 
                  </div>
              <div class="dropdown" style=" margin-right: 20px;">
                <button class="btnm dropdown-toggle" type="button" data-toggle="dropdown">
                <span></span>Filters</button>
                <ul  class="dropdown-menu">
                  <span>Filters  By:</span>
                  <div class="box-menu">
                    <li class="dropdown-submenu" >
                          <select class="btnm" id='main_select'>
                              <option value="campaign_name" row_index='2'>Campaign Name</option>
                              <option value="campaign_status" row_index='9'>Campaign Status</option>
                              <option value="ppc" row_index='17'>PPC ACoS</option>
                              <option value="ppc" row_index='11'>PPC Clicks</option>
                              <option value="ppc" row_index='14'>PPC Sales</option>
                              <option value="ppc" row_index='13'>PPC Spend</option>
                              <option value="ppc" row_index='15'>Orders</option>
                              <option value="ppc" row_index='18'>Conversion Rate</option>
                        </select>
                     </li>                             
                     <li class="dropdown-submenu margin-contains model" >
                        <select class="btnm" id="select_0">
                            <option></option>
                        </select>
                     </li>         
                     <li class="dropdown-submenu margin-contains" >
                      <input id='filter_input' type="text">
                     </li>
                     <li class="dropdown-submenu margin-contains">
                        <button id="filter" class="btn btn-warning" type="button" >
                        <span class=""></span>Save</button>
                     </li>
                    </div>                                
                 </ul>
               </div>
             <div class="dropdown" style=" margin-right: 20px;">
                <button class="btnm dropdown-toggle" type="button" data-toggle="dropdown">
                <span></span>Customize</button>
                <ul class="dropdown-menu margin-contains customize">
                  <li>
                      <a class="small" data-value="0" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Campaign</a>
                  </li>
                  <li>
                      <a class="small" data-value="1" tabIndex="-1">
                          <input type="checkbox" />&nbsp;ID</a>
                  </li>
                  <li>
                      <a  class="small" data-value="2" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Campaign Type</a>
                  </li>
                  <li>
                      <a  class="small" data-value="3" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Targeting Type</a>
                  </li>
                  <li>
                      <a  class="small" data-value="4" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Budget</a>
                  </li>
                  <li>
                      <a class="small" data-value="5" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Start Date</a>
                  </li>
                  <li>
                      <a  class="small" data-value="6" tabIndex="-1">
                          <input type="checkbox" />&nbsp;End Date</a>
                  </li>
                  <li>
                      <a  class="small" data-value="7" tabIndex="-1">
                          <input type="checkbox" />&nbsp;State</a>
                  </li>
                  <li>
                      <a  class="small" data-value="8" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Impressions</a>
                  </li>
                  <li>
                      <a  class="small" data-value="9" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Clicks</a>
                  </li>
                  <li>
                      <a  class="small" data-value="10" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Average CPC</a>
                  </li>
                  <li>
                      <a  class="small" data-value="11" tabIndex="-1">
                          <input type="checkbox" />&nbsp;PPC Spend</a>
                  </li>
                  <li>
                      <a  class="small" data-value="12" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Sales</a>
                  </li>
                  <li>
                      <a class="small" data-value="13" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Total Orders</a>
                  </li>
                  <li>
                      <a  class="small" data-value="14" tabIndex="-1">
                          <input type="checkbox" />&nbsp;PPC Profit</a>
                  </li>
                  <li>
                      <a  class="small" data-value="15" tabIndex="-1">
                          <input type="checkbox" />&nbsp;PPC ACoS</a>
                  </li>
                  <li>
                      <a  class="small" data-value="16" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Conversion Rate</a>
                  </li>
                  <li>
                      <a  class="small" data-value="17" tabIndex="-1">
                          <input type="checkbox" />&nbsp;Click Through Rate</a>
                  </li>
                  <li class="dropdown-submenu margin-contains customButtons">
                      <button id="clear" class="btn btn-warning" type="button" >
                      <span class=""></span>Clear</button>
                      <button id="apply" class="btn btn-warning" type="button" >
                      <span class=""></span>Apply</button>
                  </li>                                              
                </ul>
               </div>
             </div>

             <div class="row">                        
                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box  box-ppc">
                        <div class="inner">
                          <h3 id ="ppc_sales">$870,318.85</h3>
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
                          <h3  id ="ppc_spend">$4,951.00</h3>
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
                        <h3 id ="ppc_profit">$865,367.85</h3>

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
                          <h3 id ="ppc_acos">81.50%</h3>

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
                
                <div id="operations" style="display: none" >
                  <label class="text-muted pull-left d-inline-block">1 campaigns selected: </label>
                  <div class="text-muted text-uppercase ml-2 d-inline-block">
                    <div>
                      <div class="children clearfix">
                        <a class="badge badge-light btn btn-success"  data-toggle="modal" data-target="#multi_modal">Edit Campaign</a>
                       </div>
                     </div>
                   </div>
                 </div>

                 <div id="bulk-operations" class="row" style="display: none; margin: 10px;">
                  
                  <form id="bulk-operations-form" action="{{ route('admin/bo') }}" method="POST">
                      {{ csrf_field() }}
                      <label class="text-muted pull-left d-inline-block">Bulk operations: </label>
                      <input type="hidden" name="campaigns" id="bo-campaigns" value="">
                      <input type="hidden" name="value" id="bo-value-hidden" value="">
                      <select class="btnm" name="action" id="bo-action">
                            <option value="1">Increase budget by ($)</option>
                            <option value="2">Increase budget by (%)</option> 
                            <option value="3">Set budget to</option>
                            <option value="4">Decrease budget by ($)</option>
                            <option value="5">Decrease budget by (%)</option>
                      </select>
                      <input type="number" name="value_budget" size="20" id="bo-value" min=0>
                      <button type="button" class="btn btn-warning" id="bulk-btn">Save</button>
                  </form>
                </div>

        <div class="mb-4">
            <table id="campaigns" class="table table-responsive table-hover table-striped" style="">    
              <thead>
                <tr>
                  <th></th>
                  <th >Actions</th> 
                  <th >Campaign</th>
                  <th >ID</th>
                  <th >Campaign Type</th>
                  <th >Targeting Type</th>
                  <th >Budget</th>               
                  <th >Start Date</th>
                  <th >End Date</th>        
                  <th >State</th>              
                  <th >Impressions</th>
                  <th >Clicks</th>
                  <th >Average CPC</th>
                  <th >PPC Spend</th>
                  <th >Sales</th>
                  <th >Total Orders</th>
                  <th >PPC Profit</th>
                  <th >PPC ACoS</th>
                  <th >Conversion Rate</th>
                  <th >Click Through Rate</th>                         
                </tr>
              </thead>        
             </table>
       </div>
      
      
   </div>

   <script src="/js/tables.js"></script>  
@endsection