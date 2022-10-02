<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Innovention</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

<?php include_once('templates/nav.php');?>

<?php include_once('templates/sidenav.php');?>

  <div class="content-wrapper">

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">General Settings</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">General Settings</li>

            </ol>

          </div>

        </div>

      </div>

    </div>

    <div class="content">

      <div class="container-fluid">

        <div class="card card-primary card-outline">

          <div class="card-header">

            <h3 class="card-title">

              <i class="fas fa-cog"></i>

              POS General Settings/ Defaults

            </h3>

          </div>

          <div class="card-body">

            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">

              <li class="nav-item">

                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Serial Key Generator</a>

              </li>

              <li class="nav-item">

                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Default Product ID References</a>

              </li>

              <li class="nav-item">

                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Developer Information</a>

              </li>

              <li class="nav-item">

                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Script Update</a>

              </li>

              <li class="nav-item">

                <a class="nav-link" id="custom-content-below-coupons-tab" data-toggle="pill" href="#custom-content-below-coupons" role="tab" aria-controls="custom-content-below-coupons" aria-selected="false">Coupons Settings</a>

              </li>

              <li class="nav-item">

                <a class="nav-link" id="custom-content-below-additional-settings-tab" data-toggle="pill" href="#custom-content-below-additional-settings" role="tab" aria-controls="custom-content-below-additional-settings" aria-selected="false">Additional Settings</a>

              </li>

              <li class="nav-item">

                <a class="nav-link" id="custom-content-below-reset-tab" data-toggle="pill" href="#custom-content-below-reset" role="tab" aria-controls="custom-content-below-reset" aria-selected="false">Reset Database</a>

              </li>

            </ul>

            <div class="tab-content" id="custom-content-below-tabContent">

              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">

                <div class="card-body">

                  <h6 class="card-title">This page container will generate a serial key</h6>

                  <p class="card-text">Don't forget to click save button after clicking Generate Serial Key button.</p>

                  <div class="form-group">

                    <input type="" class="form-control" name="" id="serialkey">

                  </div>

                   <button class="btn btn-primary" id="gen" onclick="generatekey(this.id)">Genarate Serial Key</button>

                   <button class="btn btn-primary float-right" id="save" onclick="saveserialkey(this.id)">Save</button> 

                </div>

              </div>

              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">

                <div class="row">

                  <div class="col-md-6">

                    <div class="card-body">

                      <div class="form-group">

                        <label>Famous Batter</label>

                        <input type="text" class="form-control" id="famousbatter" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Famous Bag</label>

                        <input type="text" class="form-control"  id="famousbag" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Brownie Mix</label>

                        <input type="text" class="form-control"  id="browniemix" disabled="">      

                      </div>

                      <div class="form-group">

                        <label>Sugar Packets</label>

                        <input type="text" class="form-control"  id="sugarpackets" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Brownie Mix Upgrade Price</label>

                        <input type="text" class="form-control"  class="form-control" id="upgradeprice" disabled="">

                      </div>

                       <button class="btn btn-warning" onclick="editidref();">Edit</button>

                       <button class="btn btn-warning float-right" onclick="saveProductDefIDs();">Save</button> 

                    </div> 

                  </div>

                </div>    

              </div>

              <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">

                <div class="row">

                  <div class="col-md-6">

                    <div class="card-body">

                      <div class="form-group">

                        <label>Company Name</label>

                        <input type="text" class="form-control" id="companyname" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Address</label>

                        <input type="text" class="form-control" id="companyaddress" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Vat Reg Tin</label>

                        <input type="text" class="form-control" id="vatreg" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Accr#. </label>

                        <input type="text" class="form-control" id="accr" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Date Issued</label>

                        <div class="input-group">

                          <div class="input-group-prepend">

                            <span class="input-group-text">

                              <i class="far fa-calendar-alt"></i>

                            </span>

                          </div>

                          <input type="text" class="form-control float-right" id="dateissuedaccr" disabled="">

                        </div>

                      </div>

                    </div>

                  </div>  

                  <div class="col-md-6">

                    <div class="card-body">

                      <div class="form-group">

                        <label>Valid Until</label>

                        <div class="input-group">

                          <div class="input-group-prepend">

                            <span class="input-group-text">

                              <i class="far fa-calendar-alt"></i>

                            </span>

                          </div>

                          <input type="text" class="form-control float-right" id="validuntilaccr" disabled="">

                        </div>

                      </div>

                      <div class="form-group">

                        <label>PTU. No.</label>

                        <input type="text" class="form-control" id="ptu" disabled="" disabled="">

                      </div>

                      <div class="form-group">

                        <label>Date Issued</label>

                        <div class="input-group">

                          <div class="input-group-prepend">

                            <span class="input-group-text">

                              <i class="far fa-calendar-alt"></i>

                            </span>

                          </div>

                          <input type="text" class="form-control float-right" id="dateissuedptu" disabled="">

                        </div>

                      </div>

                      <div class="form-group">

                        <label>Valid Until</label>

                        <div class="input-group">

                          <div class="input-group-prepend">

                            <span class="input-group-text">

                              <i class="far fa-calendar-alt"></i>

                            </span>

                          </div>

                          <input type="text" class="form-control float-right" id="validuntilptu" disabled="">

                        </div>

                      </div>

                      <button class="btn btn-info" onclick="editdev();">Edit</button>

                      <button class="btn btn-info float-right" onclick="saveDevInfo();">Save</button>      

                    </div>     

                  </div>                

                </div>

              </div>

              <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-2">

                      <button type="button" id="alter" onclick="alter();" class="btn btn-block btn-default btn-sm">ALTER TABLE</button>

                    </div>

                    <div class="col-md-2">

                      <button type="button" id="dropifexist" onclick="dropexist();" class="btn btn-block btn-default btn-sm">ALTER DROP IF EXIST</button>

                    </div>

                    <div class="col-md-2">

                      <button type="button" id="alteradd" onclick="alteradd();" class="btn btn-block btn-default btn-sm">ALTER DROP IF EXIST ADD</button>

                    </div>     

                    <div class="col-md-2">

                      <button type="button" id="alteradd" onclick="update();" class="btn btn-block btn-default btn-sm">UPDATE</button>

                    </div>  

                    <div class="col-md-2">

                      <button type="button" id="alteradd" onclick="newTable();" class="btn btn-block btn-default btn-sm">NEW TABLE</button>

                    </div>  



                  </div>  

                  <div class="form-group">

                    <label for="stores">Select Store:</label>

                    <select id="stores" class="custom-select">

                        <option value="All">All</option>

                    </select>

                  </div>

                  <div class="form-group">

                    <label for="tablename">Table Name</label>

                    <input type="text" class="form-control" id="tablename" placeholder="Enter table name">

                  </div>

                  <div class="form-group">

                    <label for="columnname">New column name</label>

                    <input type="text" class="form-control" id="columnname" placeholder="Enter column name">

                  </div>

                  <div class="form-group">

                    <label for="aftercolumnname">Enter last column</label>

                    <input type="text" class="form-control" id="aftercolumnname" placeholder="Enter column name">

                  </div>

                  <div class="form-group">

                    <label for="datatype">Data Type</label>

                    <select class="custom-select" name="datatype" id="datatype" required>

                      <option value="">Select Data Type</option>

                      <option value="INT">INT</option>

                      <option value="VARCHAR">VARCHAR</option>

                      <option value="TEXT">TEXT</option>

                      <option value="DATE">DATE</option>

                      <option value="TINYINT">TINYINT</option>

                      <option value="SMALLINT">SMALLINT</option>

                      <option value="MEDIUMINT">MEDIUMINT</option>

                      <option value="BIGINT">BIGINT</option>

                      <option value="DECIMAL">DECIMAL</option>

                      <option value="FLOAT">FLOAT</option>

                      <option value="DOUBLE">DOUBLE</option>

                      <option value="REAL">REAL</option>

                      <option value="BIT">BIT</option>

                      <option value="BOOLEAN">BOOLEAN</option>

                      <option value="SERIAL">SERIAL</option>

                      <option value="DATETIME">DATETIME</option>

                      <option value="TIMESTAMP">TIMESTAMP</option>

                      <option value="TIME">TIME</option>

                      <option value="YEAR">YEAR</option>

                      <option value="CHAR">CHAR</option>

                      <option value="VARCHAR">VARCHAR</option>

                      <option value="TINYTEXT">TINYTEXT</option>

                      <option value="TEXT">TEXT</option>

                      <option value="MEDIUMTEXT">MEDIUMTEXT</option>

                      <option value="LONGTEXT">LONGTEXT</option>

                      <option value="BINARY">BINARY</option>

                      <option value="VARBINARY">VARBINARY</option>

                      <option value="TINYBLOB">TINYBLOB</option>

                      <option value="BLOB">BLOB</option>

                      <option value="MEDIUMBLOB">MEDIUMBLOB </option>

                      <option value="LONGBLOB">LONGBLOB</option>

                      <option value="ENUM">ENUM</option>

                      <option value="SET">SET</option>

                      <option value="GEOMETRY">GEOMETRY</option>

                      <option value="POINT">POINT</option>

                      <option value="LINESTRING">LINESTRING</option>

                      <option value="POLYGON">POLYGON</option>

                      <option value="MULTIPOINT">MULTIPOINT</option>

                      <option value="MULTILINESTRING">MULTILINESTRING</option>

                      <option value="MULTIPOLYGON">MULTIPOLYGON</option>

                      <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>

                      <option value="JSON">JSON</option>

                    </select>

                  </div>

                  <div class="form-group">

                      <textarea class="form-control" id="scriptdesc" placeholder="Enter ..."></textarea>

                  </div>  

                  <button class="btn btn-info float-right" onclick="checkalter();">Save</button>                 

                </div>

              </div>

              <div class="tab-pane fade show" id="custom-content-below-additional-settings" role="tabpanel" aria-labelledby="custom-content-below-additional-settings">

                <div class="row">

                  <div class="col-md-6">

                    <div class="card-body">

                      <div class="form-group">

                        <label>POS Verion</label>

                        <input type="text" class="form-control" id="version" disabled="">

                      </div>

                    <button class="btn btn-primary" onclick="editposver();">Edit</button>

                    <button class="btn btn-primary float-right" onclick="savePosVersion();">Save</button>  

                    </div>

                  </div>             

                </div>

              </div>

              <div class="tab-pane fade show" id="custom-content-below-coupons" role="tabpanel" aria-labelledby="custom-content-below-coupons">     

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-2">

                      <button type="button" class="btn btn-sm btn-secondary btn-block mb-3" data-toggle="modal" data-target="#modal-add-coupon">New Coupon</button> 

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-12"> 

                      <table id="example2" class="table table-striped" style="width:100%">

                        <thead>

                          <tr>

                            <th>Coupon Name</th>

                            <th>Description</th>

                            <th>Effective Date</th>

                            <th>Expiry Date</th>

                            <th>Action</th>

                          </tr>

                        </thead>

                        <tfoot>

                          <tr>

                            <th>Coupon Name</th>

                            <th>Description</th>

                            <th>Effective Date</th>

                            <th>Expiry Date</th>

                            <th>Action</th>

                          </tr>

                        </tfoot>

                      </table>

                    </div>

                  </div>

                </div>                    

              </div>

              <div class="tab-pane fade show" id="custom-content-below-reset" role="tabpanel" aria-labelledby="custom-content-below-reset">

                  <div class="card-body">

                      <div class="row">

                          <div class="col-sm-6">

                            <div class="form-group">

                                <label>Select Table</label>

                                <select id="resettable" class="custom-select">

                                    <option value="Sales">Sales</option>

                                    <option value="Logs">Logs</option>

                                    <option value="Inventory">Inventory</option>

                                    <option value="Products">Products</option>

                                    <option value="Refunds">Refunds</option>

                                    <option value="Serial">Serial</option>

                                    <option value="Users">Users</option>

                                    <option value="Outlet">Outlet</option>

                                    <option value="Inbox">Inbox</option>

                                    <option value="Script">Script Runner</option>

                                </select>

                            </div>

                          </div>

                      </div>

                      <button onclick="resetdatabase()" class="btn btn-primary">Submit</button>

                  </div>

              </div>

            </div>          

          </div>

        </div> 

        <div class="card card-primary card-outline">

          <div class="card-header">

            <h3 class="card-title">

              <i class="fas fa-key"></i>

              Serial Keys

            </h3>

          </div>

          <div class="card-body">

            <table id="example1" class="table table-striped" style="width:100%">

              <thead>

                <tr>

                  <th>Serial Keys</th>

                  <th>Status</th>

                  <th>Date Created</th>

                  <th>Date Used</th>

                </tr>

              </thead>

              <tfoot>

                <tr>

                  <th>Serial Keys</th>

                  <th>Status</th>

                  <th>Date Created</th>

                  <th>Date Used</th>

                </tr>

              </tfoot>

            </table>

          </div>

        </div>

      </div>

    </div>

  </div>

<?php include_once('templates/webfooter.php');?>

<?php include_once('modals/updatemodal.php');?>

<?php include_once('modals/editcouponmodal.php');?>

<?php include_once('modals/addcouponmodal.php');?>



</div>

<script src="../plugins/jquery/jquery.min.js"></script>

<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../plugins/moment/moment.min.js"></script>

<script src="../dist/js/adminlte.min.js"></script>

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

var alternumber = 0;

function alter() {

  var tablename = $( "#tablename" ).val();

  if (!tablename) {

    alert('Input table name first.');

  } else {

    alternumber = 1;

    $("#scriptdesc").val("ALTER TABLE `" +tablename+ "`;");

  }

}

function dropexist() {

  var tablename = $( "#tablename" ).val();

  var columnname = $( "#columnname" ).val();

  if (!tablename) {

    alert('Input table name first.');

  } else {

    if (!columnname) {

      alert('Input new column name first.');

    } else {

      alternumber = 2;

      $("#scriptdesc").val("ALTER TABLE `" +tablename+ "` DROP IF EXISTS `" +columnname+ "`;");

    }

  } 

}

function alteradd() {

  var tablename = $( "#tablename" ).val();

  var columnname = $( "#columnname" ).val();

  var datatype = $( "#datatype" ).val();

  var aftercolumnname = $( "#aftercolumnname" ).val();

  if (!tablename) {

    alert('Input table name first.');

  } else {

    if (!columnname) {

      alert('Input new column name first.');

    } else {

      if (!aftercolumnname) {

        alert('Input the last column name of `'+tablename+'` table.');

      } else {

        if (!datatype) {

          alert('Select data type first.');  

        } else {

          alternumber = 3;

          $("#scriptdesc").val("ALTER TABLE `" +tablename+ "` DROP IF EXISTS `" +columnname+ "`; ALTER TABLE `" +tablename+ "` ADD `"+columnname+"` "+datatype+" NOT NULL AFTER `" +aftercolumnname+ "`;");         

        }

      }

    }

  } 

}

function newTable() {

  alternumber = 5;

  alert("Input new table query");

}

function update() {

  alternumber = 4;

  alert("Please use double quote for STRING value.");

}



function checkalter() {

  var tablename = $( "#tablename" ).val();

  var columnname = $( "#columnname" ).val();

  var datatype = $( "#datatype" ).val();

  var aftercolumnname = $( "#aftercolumnname" ).val();

  var query = $("#scriptdesc").val();

  if (alternumber == 1) {

    if (!tablename) {

      alert('Input table name first.');

    } else {

      if (confirm('Are you sure you want to save this alter query into the database?')) {

        savealter(query);

      } 

    }

  } else if(alternumber == 2) {

    if (!tablename) {

      alert('Input table name first.');

    } else {

      if (!columnname) {

        alert('Input new column name first.');

      } else {

        if (confirm('Are you sure you want to save this alter query into the database?')) {

          savealter(query);

        } 

      }

    } 

  } else if(alternumber == 3) {

    if (!tablename) {

      alert('Input table name first.');

    } else {

      if (!columnname) {

        alert('Input new column name first.');

      } else {

        if (!aftercolumnname) {

          alert('Input the last column name of `'+tablename+'` table.');

        } else {

          if (!datatype) {

            alert('Select data type first.');  

          } else {

            if (confirm('Are you sure you want to save this alter query into the database?')) {

              savealter(query);

            }       

          }

        }

      }

    }

  } else if(alternumber == 4) {

    if (!query) {

      alert('Input update query first');

    } else {

      if (confirm('Are you sure you want to save this update query into the database?')) {

        savealter(query);

      } 

    }

  } else if(alternumber == 5) {

    if (!query) {

      alert('Input new table query first');

    } else {

      if (confirm('Are you sure you want to save this update query into the database?')) {

        savealter(query);

      } 

    }

  } else {

    alert('Click alter button first');

  }

}



function savealter(query) {

  var storeid = $("#stores").val();

    $.ajax({  

      url:"actions/savealter.php",  

      method:"POST",  

      data:{'query':query, storeid:storeid},  

      success:function(data){  

        alert(data);

        $("#tablename").val('');

        $("#columnname").val('');

        $("#aftercolumnname").val('');

        $("#scriptdesc").val('');

      }  

    }); 

}

$( document ).ready(function() {

  LoadDatatable();

  LoadDatatable2() ;

  getdefaults();

  LoadStores();

  $('#dateissuedaccr').datepicker({ dateFormat: 'yy-mm-dd' }).val();

  $('#validuntilaccr').datepicker({ dateFormat: 'yy-mm-dd' }).val();

  $('#dateissuedptu').datepicker({ dateFormat: 'yy-mm-dd' }).val();

  $('#validuntilptu').datepicker({ dateFormat: 'yy-mm-dd' }).val();



  $('#effectivedate').datepicker({ dateFormat: 'yy-mm-dd' }).val();

  $('#expirydate').datepicker({ dateFormat: 'yy-mm-dd' }).val();

});



  var editdevinfo = false;

  var editidreferences = false;

  var editposversion = false;



  function editdev() {

    if (editdevinfo) {



      $( "#companyname" ).prop( "disabled", editdevinfo );

      $( "#companyaddress" ).prop( "disabled", editdevinfo );

      $( "#vatreg" ).prop( "disabled", editdevinfo );

      $( "#accr" ).prop( "disabled", editdevinfo );

      $( "#dateissuedaccr" ).prop( "disabled", editdevinfo );

      $( "#validuntilaccr" ).prop( "disabled", editdevinfo );

      $( "#ptu" ).prop( "disabled", editdevinfo );

      $( "#dateissuedptu" ).prop( "disabled", editdevinfo );

      $( "#validuntilptu" ).prop( "disabled", editdevinfo );



      editdevinfo = false;



    } else {

 

      $( "#companyname" ).prop( "disabled", editdevinfo );

      $( "#companyaddress" ).prop( "disabled", editdevinfo );

      $( "#vatreg" ).prop( "disabled", editdevinfo );

      $( "#accr" ).prop( "disabled", editdevinfo );

      $( "#dateissuedaccr" ).prop( "disabled", editdevinfo );

      $( "#validuntilaccr" ).prop( "disabled", editdevinfo );

      $( "#ptu" ).prop( "disabled", editdevinfo );

      $( "#dateissuedptu" ).prop( "disabled", editdevinfo );

      $( "#validuntilptu" ).prop( "disabled", editdevinfo );



      editdevinfo = true;

    }

  }



  function editidref() {

    if (editidreferences) {



      $("#famousbatter").prop( "disabled", editidreferences ); 

      $("#famousbag").prop( "disabled", editidreferences );

      $("#browniemix").prop( "disabled", editidreferences );

      $("#sugarpackets").prop( "disabled", editidreferences );

      $("#upgradeprice").prop( "disabled", editidreferences );



      editidreferences = false;



    } else {

 

      $("#famousbatter").prop( "disabled", editidreferences ); 

      $("#famousbag").prop( "disabled", editidreferences );

      $("#browniemix").prop( "disabled", editidreferences );

      $("#sugarpackets").prop( "disabled", editidreferences );

      $("#upgradeprice").prop( "disabled", editidreferences );

      

      editidreferences = true;

    }

  }

  function editposver() {

    if (editposversion) {

      $("#version").prop( "disabled", editposversion ); 

      editposversion = false;

    } else {

      $("#version").prop( "disabled", editposversion ); 

      editposversion = true;

    }

  }

  function generatekey(id) {

    $.ajax({  

      url:"actions/generatekey.php",  

      method:"POST",  

      data:{id:id},  

      success:function(data){  

        $("#serialkey").val(data);

      }  

    }); 

  }

  function saveserialkey(id) {

    $serialkey =  $("#serialkey").val();

    if ($serialkey == '') {

      alert('Generate first');

    } else {

      $.ajax({  

      url:"actions/savekey.php",  

      method:"POST",  

      data:{id:id , serial:$serialkey},  

      success:function(data){  

        alert('Saved!');

        $("#serialkey").val('');

        var table = $('#example1').DataTable();

        $('#example1').empty();

        table.destroy();

        LoadDatatable();

      }  

      }); 

    }

  }

  function LoadDatatable() {

    $("#example1").DataTable({

      "responsive": true,

      "autoWidth": false,

      "processing": true,

      "serverSide": true,

      "pageLength": 5,

      "ajax": "dtserver/getserialkeys.php"

    });

  }

  function LoadDatatable2() {

    $("#example2").DataTable({

      "responsive": true,

      "autoWidth": false,

      "processing": true,

      "serverSide": true,

      "pageLength": 5,

      "ajax": "dtserver/getcoupons.php",

      "order": [[ 4, "asc" ]]

    });

  }

  function saveProductDefIDs() {

    var famousbatter = $("#famousbatter").val(); 

    var famousbag = $("#famousbag").val(); 

    var browniemix = $("#browniemix").val(); 

    var sugarpackets = $("#sugarpackets").val(); 

    var upgradeprice = $("#upgradeprice").val(); 

    if($("#famousbatter").prop( "disabled") == true ) {

      alert('Edit ids first');

    } else {

    if (confirm('Are you sure you want to change product reference ids?')) {

      $.ajax({

        url: 'actions/savedefaultids.php',

        type: 'post',

        data: {famousbatter:famousbatter, famousbag:famousbag, upgradeprice:upgradeprice, sugarpackets:sugarpackets, browniemix:browniemix},

        success:function(data){   

          alert(data);

          editidref();

          getdefaults();

        }

      })

    }

    }

  }

  function saveDevInfo() {

    var companyname =    $("#companyname").val(); 

    var companyaddress = $("#companyaddress").val(); 

    var vatreg =         $("#vatreg").val(); 

    var accr =           $("#accr").val(); 

    var dateissuedaccr = $("#dateissuedaccr").val(); 

    var validuntilaccr = $("#validuntilaccr").val(); 

    var ptu =            $("#ptu").val(); 

    var dateissuedptu =  $("#dateissuedptu").val(); 

    var validuntilptu =  $("#validuntilptu").val(); 

    if($("#companyname").prop( "disabled") == true ) {

      alert('Edit dev company info first');

    } else {

      if (confirm('Are you sure you want to change dev company info?')) {

      $.ajax({

        url: 'actions/savedevinfo.php',

        type: 'post',

        data: {

          companyname:companyname, 

          companyaddress:companyaddress,

          vatreg:vatreg,

          accr:accr,

          dateissuedaccr:dateissuedaccr,

          validuntilaccr:validuntilaccr,

          ptu:ptu,

          dateissuedptu:dateissuedptu,

          validuntilptu:validuntilptu

        },

        success:function(data){   

          alert(data);

          editdevinfo();

          getdefaults();

        }

      }) 

      }

    }

  }

  function savePosVersion(){

    var version =  $("#version").val(); 

    if($("#version").prop( "disabled") == true ) {

      alert('Edit POS version first');

    } else {

      if (confirm('Are you sure you want to change POS Version?')) {

      $.ajax({

        url: 'actions/saveposversion.php',

        type: 'post',

        data: {

          version:version

        },

        success:function(data){   

          alert(data);

          editposversion();

          getdefaults();

        }

      }) 

      }

    }

  }

  function getdefaults() {



    $("#famousbatter").val('Fetching...'); 

    $("#famousbag").val('Fetching...');

    $("#browniemix").val('Fetching...');

    $("#sugarpackets").val('Fetching...');

    $("#upgradeprice").val('Fetching...');



    $("#companyname").val('Fetching...');

    $("#companyaddress").val('Fetching...');

    $("#vatreg").val('Fetching...');

    $("#accr").val('Fetching...');

    $("#dateissuedaccr").val('Fetching...');

    $("#validuntilaccr").val('Fetching...');

    $("#ptu").val('Fetching...');

    $("#dateissuedptu").val('Fetching...');

    $("#validuntilptu").val('Fetching...');



    $("#version").val('Fetching...');



    $.ajax({

      url: 'actions/getdefaults.php',

      type: 'post',

      dataType: 'json',

      success:function(response){   



        $("#famousbatter").empty(); 

        $("#famousbag").empty();

        $("#browniemix").empty();

        $("#sugarpackets").empty();

        $("#upgradeprice").empty();



        $("#companyname").empty();

        $("#companyaddress").empty();

        $("#vatreg").empty();

        $("#accr").empty();

        $("#dateissuedaccr").empty();

        $("#validuntilaccr").empty();

        $("#ptu").empty();

        $("#dateissuedptu").empty();

        $("#validuntilptu").empty();



        $("#version").empty();



        var famousbatter = response[0]['famousbatter']; 

        var famousbag = response[0]['famousbag'];        

        var browniemix = response[0]['browniemix'];  

        var sugarpackets = response[0]['sugarpackets']; 

        var upgradeprice = response[0]['upgradeprice']; 



        var companyname = response[0]['companyname']; 

        var companyaddress = response[0]['companyaddress'];        

        var vatreg = response[0]['vatreg'];  

        var accr = response[0]['accr']; 

        var dateissuedaccr = response[0]['dateissuedaccr']; 

        var validuntilaccr = response[0]['validuntilaccr'];        

        var ptu = response[0]['ptu'];  

        var dateissuedptu = response[0]['dateissuedptu']; 

        var validuntilptu = response[0]['validuntilptu']; 



        var version = response[0]['version']; 

    

        $("#companyname").val(companyname);

        $("#companyaddress").val(companyaddress);

        $("#vatreg").val(vatreg);

        $("#accr").val(accr);

        $("#dateissuedaccr").val(dateissuedaccr);

        $("#validuntilaccr").val(validuntilaccr);

        $("#ptu").val(ptu);

        $("#dateissuedptu").val(dateissuedptu);

        $("#validuntilptu").val(validuntilptu);



        $('#famousbatter').val(famousbatter);       

        $('#famousbag').val(famousbag);

        $('#browniemix').val(browniemix);    

        $('#sugarpackets').val(sugarpackets);  

        $('#upgradeprice').val(upgradeprice); 



        $('#version').val(version);  

      }

    })

  }

</script>

<script type="text/javascript">

  $( "#updatetable" ).keyup(function() {

    var updatetable = $( "#updatetable" ).val();

    var updatecolumnname = $( "#updatecolumnname" ).val();

    var updatewhereclause = $( "#updatewhereclause" ).val();

    $( "#updatequery" ).val("UPDATE `" +updatetable+ "` SET "+updatecolumnname+" WHERE "+updatewhereclause+ ";");

  });

  $( "#updatecolumnname" ).keyup(function() {

    var updatetable = $( "#updatetable" ).val();

    var updatecolumnname = $( "#updatecolumnname" ).val();

    var updatewhereclause = $( "#updatewhereclause" ).val();

    $( "#updatequery" ).val("UPDATE `" +updatetable+ "` SET "+updatecolumnname+" WHERE "+updatewhereclause+ ";");          

  });

  $( "#updatewhereclause" ).keyup(function() {

    var updatetable = $( "#updatetable" ).val();

    var updatecolumnname = $( "#updatecolumnname" ).val();

    var updatewhereclause = $( "#updatewhereclause" ).val();

    $( "#updatequery" ).val("UPDATE `" +updatetable+ "` SET "+updatecolumnname+" WHERE "+updatewhereclause+ ";");   

  });

</script>

<script type="text/javascript">

  function EditCoupon(id) {

  $.ajax({  

    url:"actions/editcoupon.php",  

    method:"post",  

    data:{id:id},  

    success:function(data){  

      $('#edit_coupon_body').html(data);  

      $('#modal-coupon').modal("show");

    }

  });

}



function resetdatabase() {

    var tabletoreset = $( "#resettable" ).val();

    $.ajax({

        url:"actions/resettable.php",

        method:"post",

        data:{tabletoreset:tabletoreset},

        success:function(data){

            alert(data);
            location.reload();

        }

    });

}

function LoadStores() {
    $.ajax({
      url: 'dtserver/getstoreids.php',
      dataType: 'json',
      success:function(response){     

        var len = response.length;

        $("#stores").empty();

        $("#stores_gen").empty();

        $("#stores1").empty();

        $("#stores1").append("<option value='All'>All</option>")

        $("#stores").append("<option value='All'>All</option>")

        $("#stores_gen").append("<option value='All'>All</option>")

        for( var i = 0; i<len; i++){

            var id = response[i]['id'];

            var name = response[i]['name']; 

            $("#stores").append("<option value='"+id+"'>"+name+"</option>");           

            $("#stores1").append("<option value='"+id+"'>"+name+"</option>");   

            $("#stores_gen").append("<option value='"+id+"'>"+name+"</option>");   
        }



      }

    });

  }

</script>

</body>

</html>

