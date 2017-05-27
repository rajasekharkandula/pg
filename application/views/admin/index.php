<!DOCTYPE html>
<html lang="en">
  
<?php echo $head; ?>
  
  <body>
    <div class="be-wrapper be-fixed-sidebar">
	
      <?php echo $header; ?>
	  
	  <div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-3">
				<div class="widget widget-tile">
				  <div id="spark1" class="chart sparkline"></div>
				  <div class="data-info">
					<div class="desc">New Users</div>
					<div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="<?php echo $reports->users_count; ?>" class="number">0</span>
					</div>
				  </div>
				</div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
				<div class="widget widget-tile">
				  <div id="spark2" class="chart sparkline"></div>
				  <div class="data-info">
					<div class="desc">New Products</div>
					<div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="<?php echo $reports->products_count; ?>" class="number">0</span>
					</div>
				  </div>
				</div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
				<div class="widget widget-tile">
				  <div id="spark3" class="chart sparkline"></div>
				  <div class="data-info">
					<div class="desc">API</div>
					<div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="<?php echo $reports->api_count; ?>" class="number">0</span>
					</div>
				  </div>
				</div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3">
				<div class="widget widget-tile">
				  <div id="spark4" class="chart sparkline"></div>
				  <div class="data-info">
					<div class="desc">Product Views</div>
					<div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span data-toggle="counter" data-end="<?php echo $reports->views_count; ?>" class="number">0</span>
					</div>
				  </div>
				</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="widget widget-fullwidth be-loading">
                <div class="widget-head">
                  <div class="tools">
                    <div class="dropdown"><span data-toggle="dropdown" class="icon mdi mdi-more-vert visible-xs-inline-block dropdown-toggle"></span>
                      <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Week</a></li>
                        <li><a href="#">Month</a></li>
                        <li><a href="#">Year</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Today</a></li>
                      </ul>
                    </div><span class="icon mdi mdi-chevron-down"></span><span class="icon toggle-loading mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span>
                  </div>
                  <div class="button-toolbar hidden-xs">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default">Week</button>
                      <button type="button" class="btn btn-default active">Month</button>
                      <button type="button" class="btn btn-default">Year</button>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default">Today</button>
                    </div>
                  </div><span class="title">Recent Movement</span>
                </div>
                <div class="widget-chart-container">
                  <div class="widget-chart-info">
                    <ul class="chart-legend-horizontal">
                      <li><span data-color="main-chart-color1"></span> Customers</li>
                      <li><span data-color="main-chart-color2"></span> Products</li>
                      <li><span data-color="main-chart-color3"></span> Product Views</li>
                    </ul>
                  </div>
                  <div class="widget-counter-group widget-counter-group-right">
                    <div class="counter counter-big">
                      <div class="value">25%</div>
                      <div class="desc">Customers</div>
                    </div>
                    <div class="counter counter-big">
                      <div class="value">5%</div>
                      <div class="desc">Products</div>
                    </div>
                    <div class="counter counter-big">
                      <div class="value">5%</div>
                      <div class="desc">Product Views</div>
                    </div>
                  </div>
                  <div id="main-chart" style="height: 260px;"></div>
                </div>
                <div class="be-spinner">
                  <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="panel panel-default panel-table">
                <div class="panel-heading"> 
                  <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                  <div class="title">Recent Customers</div>
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-borderless">
                    <thead>
                      <tr>
                        <th style="width:30%;">Name</th>
                        <th style="width:40%;">Email</th>
                        <th style="width:30%;">Date</th>
                      </tr>
                    </thead>
                    <tbody class="no-border-x">
                      <?php foreach($users as $u){ ?>
					  <tr>
                        <td><?php echo $u->first_name.' '.$u->last_name; ?></td>
                        <td><?php echo $u->email; ?></td>
						<td><?php echo date('M d, Y',strtotime($u->created_date)); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">
                  <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                  <div class="title">Recent Products</div>
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th style="width:40%;">Name</th>
                        <th style="number">Price</th>
                        <th>Source</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      
					  <tr>
                        <td class="user-avatar"> <img src="assets/img/avatar6.png" alt="Avatar">iPhone 5S</td>
                        <td>$23</td>
                        <td>Best Buy</td>
                        <td>Aug 16, 2016</td>
                       </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
	  
    </div>
	<?php echo $footer; ?>
   
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.dashboard();
      });
    </script>
  </body>

</html>