<template>
 <!-- DataTales Example -->
 <div class="mb-4">
  <!-- <div class="card-header py-3"> -->
    <!-- <h6 class="m-0 font-weight-bold text-primary">Campaing tag actions</h6> -->
 <!--  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped" id="" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Actions</th>
            <th>Keyword</th>
            <th>Match Type</th>
            <th>Bid</th>
            <th>Average CPC</th>
            <th>PPC Spend</th>
            <th>PPC Sales</th>
            <th>PPC Profit</th>               
          </tr>
        </thead>              
        <tbody>
          <tr>
            <td>
              <!--  <i class="fas fa-fw fa-cog"></i> -->
        <!--   <select name="" class="btn-success ">
               <span class="fas fa-fw fa-cog"></span>                 
               <option value="" > </option>
               <option value="">Add</option>
               <option value="">Edit </option>
               <option value="">Delete </option>                       
             </select> -->


             <div class="dropdown">
              <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                <span class="fas fa-fw fa-cogs"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="" class="btn btn-warning btn-sm fas fa-plus-square"></a></li>
                  <li><a href="" class="btn btn-primary btn-sm fas fa-edit"></a></li>
                  <li><a href="" class="btn btn-danger btn-sm fas fa-trash-alt"></a></li>
                </ul>
              </div> 

              <!--  <i class="fas fa-trash-alt"></i> -->
              <!-- <i class="fas fa-plus"></i> -->
              <!-- <i class="fas fa-edit"></i> -->
              <!-- <i class="fas fa-plus-square"></i> -->

            </td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
            <td>2011/04/25</td>
            <td>$320,800</td>            
          </tr>
          <tr>
            <td>
              <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                  <span class="fas fa-fw fa-cogs"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="" class="btn btn-warning btn-sm fas fa-plus-square"></a></li>
                    <li><a href="" class="btn btn-primary btn-sm fas fa-edit"></a></li>
                    <li><a href="" class="btn btn-danger btn-sm fas fa-trash-alt"></a></li>
                  </ul>
                </div>                
              </td>
              <td>Accountant</td>
              <td>Tokyo</td>
              <td>63</td>
              <td>2011/07/25</td>
              <td>$170,750</td>
              <td>2011/04/25</td>
              <td>$320,800</td>           
            </tr>
            <tr>
              <td>
                <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                    <span class="fas fa-fw fa-cogs"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="" class="btn btn-warning btn-sm fas fa-plus-square"></a></li>
                      <li><a href="" class="btn btn-primary btn-sm fas fa-edit"></a></li>
                      <li><a href="" class="btn btn-danger btn-sm fas fa-trash-alt"></a></li>
                    </ul>
                  </div>                
                </td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
                <td>2011/04/25</td>
                <td>$320,800</td>            
              </tr>
              <tr>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                      <span class="fas fa-fw fa-cogs"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="" class="btn btn-warning btn-sm fas fa-plus-square"></a></li>
                        <li><a href="" class="btn btn-primary btn-sm fas fa-edit"></a></li>
                        <li><a href="" class="btn btn-danger btn-sm fas fa-trash-alt"></a></li>
                      </ul>
                    </div>                
                  </td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>            
                </tr>
                <tr>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="fas fa-fw fa-cogs"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="" class="btn btn-warning btn-sm fas fa-plus-square"></a></li>
                          <li><a href="" class="btn btn-primary btn-sm fas fa-edit"></a></li>
                          <li><a href="" class="btn btn-danger btn-sm fas fa-trash-alt"></a></li>
                        </ul>
                      </div>                
                    </td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>            
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </template>

      <script>
        export default {
          mounted() {
            // console.log('Component mounted.')
          }
        }
      </script>
