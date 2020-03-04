@extends('layouts.master')

@section('title','Dashboard')



@section('header_css')

<style type="text/css">
	a {
	  color:black;
	  text-decoration: none;

	  /* First we need to help some browsers along for this to work.
	     Just because a vendor prefix is there, doesn't mean it will
	     work in a browser made by that vendor either, it's just for
	     future-proofing purposes I guess. */
	  -o-transition:.5s;
	  -ms-transition:.5s;
	  -moz-transition:.5s;
	  -webkit-transition:.5s;
	  /* ...and now for the proper property */
	  transition:.5s;
	}
	a:hover,#list-row:hover {
	text-decoration: none;
	 background-color: #000; color: #001;  
	 -o-transition:.5s;
	  -ms-transition:.5s;
	  -moz-transition:.5s;
	  -webkit-transition:.5s;
	}
	.tab-heading:hover{
		color: #fff;
	}
	.nav-link:hover{
		color: #fff;
	}
</style>

@stop

@section('content')


<!-- <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active tab-heading" href="#today" role="tab" data-toggle="tab" >Today's Events 
    	<span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountToday"></span>
	</a>
  </li>
  <li class="nav-item">
    <a class="nav-link tab-heading" href="#tomorrow" role="tab" data-toggle="tab">Tomorrow's Events 
    	<span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountTomorrow"></span> 
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link tab-heading" href="#all_event" role="tab" data-toggle="tab">All Events 
    	<span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountAll"></span> 
    </a>
  </li>
</ul>
 -->



<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
    	Today's Events 
    	<span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountToday"></span>
    </a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
    	Tomorrow's Events 
    	<span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountTomorrow"></span> 
    </a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
    	All Events 
    	<span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountAll"></span> 
    </a>
  </div>
</nav>


<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<div class='card'>
			<div class="card-header"><h3>Event List</h3> </div>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="myInput" onkeyup="today()" placeholder="Search Anything" title="Type in a name" class="form-control">
				</div>
			</div>
		</div>
					<div id='today'></div>
  	</div>



  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<div class='card'>
		<div class="card-header"><h3>Event List</h3> </div>
		<div class="card-body">
			<div class="form-group">
				<input type="text" id="myInput02" onkeyup="tomorrow()" placeholder="Search Anything" title="Type in a name" class="form-control">
			</div>
		</div>
	</div>

  	<div id='tomorrow'></div>
  </div>

  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<div class='card'>
		<div class="card-header"><h3>Event List</h3> </div>
		<div class="card-body">
			<div class="form-group">
				<input type="text" id="myInput2" onkeyup="all_events()" placeholder="Search Anything" title="Type in a name" class="form-control">
			</div>
		</div>
	</div>

  	<div id='all'>3</div>

  </div>
</div>


	
@stop

@section('footer_JSscript')
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script>    for AXIOS -->
<script type="text/javascript">

// console.log('@axios',axios);
	
// axios.get('http://localhost:8000/api/all').then(function(res){
// 	console.log('Response',res);


//  })


	$.getJSON('http://'+window.location.hostname+":"+window.location.port+'/api/today',function(res){
		var today_json_data = res.data;
		//document.write();
		document.getElementById('CountToday').innerHTML = `${today_json_data.length}`;

		document.getElementById("today").innerHTML=`
				<table align="center" style="width: 100%;" id="myTable">
						<tr>
							<th>
								<li class="list-group-item font-weight-bold header" style="background-color: #bbf;color: #000;font-style: bold;">
							 		<div class="row">
										<div class="col-sm-2">ID</div>
										<div class="col-sm-2">Event</div>
										<div class="col-sm-2">Date</div>
										<div class="col-sm-6">Discription</div>
							 		</div>
							 	</li>
							 </th>
						</tr>

		

					${today_json_data.map(function(event){
						return `
								<tr id='list-row'>
									<td>
										<a href='#${ event.id }' >
										 	<li class="list-group-item">
										 		<div class="row" id="myList">
								 					<div class="col-sm-2">${ event.id }</div>
								 					<div class="col-sm-2"><kbd> ${event.task} </kbd></div>
								 					<div class="col-sm-2">${event.date_of_event}</div>
								 					<div class="col-sm-6"> ${event.disc} </div>
												</div>
										 	</li>
										</a>
									</td>
								</tr>
						`;
					}).join('')}
				</table>

		`;
	});

	$.getJSON('http://'+window.location.hostname+":"+window.location.port+'/api/tomorrow',function(res){
		var tomorrow_json_data = res.data;
		document.getElementById('CountTomorrow').innerHTML = `${tomorrow_json_data.length}`;

		document.getElementById("tomorrow").innerHTML=`
				<table align="center" style="width: 100%;" id="myTable02">
						<tr>
							<th>
								<li class="list-group-item font-weight-bold header" style="background-color: #bbf;color: #000;font-style: bold;">
							 		<div class="row">
										<div class="col-sm-2">ID</div>
										<div class="col-sm-2">Event</div>
										<div class="col-sm-2">Date</div>
										<div class="col-sm-6">Discription</div>
							 		</div>
							 	</li>
							 </th>
						</tr>

			${tomorrow_json_data.map(function(event){
			return `

						<tr id='list-row'>
							<td>
								<a href='#${ event.id }' >
								 	<li class="list-group-item">
								 		<div class="row" id="myList">
						 					<div class="col-sm-2">${ event.id }</div>
						 					<div class="col-sm-2"><kbd> ${event.task} </kbd></div>
						 					<div class="col-sm-2">${event.date_of_event}</div>
						 					<div class="col-sm-6"> ${event.disc} </div>
										</div>
								 	</li>
								</a>
							</td>
						</tr>
						`;
					}).join('')}
				</table>

			`;

	});

	$.getJSON('http://'+window.location.hostname+":"+window.location.port+'/api/all',function(res){
		var all_json_data = res.data;
		document.getElementById('CountAll').innerHTML = `${all_json_data.length}`;

		document.getElementById("all").innerHTML=`
				<table align="center" style="width: 100%;" id="myTable2">
						<tr>
							<th>
								<li class="list-group-item font-weight-bold header" style="background-color: #bbf;color: #000;font-style: bold;">
							 		<div class="row">
										<div class="col-sm-2">ID</div>
										<div class="col-sm-2">Event</div>
										<div class="col-sm-2">Date</div>
										<div class="col-sm-6">Discription</div>
							 		</div>
							 	</li>
							 </th>
						</tr>

						${all_json_data.map(function(event){
						return `

						<tr id='list-row'>
							<td>
								<a href='#${ event.id }' >
								 	<li class="list-group-item">
								 		<div class="row" id="myList">
						 					<div class="col-sm-2">${ event.id }</div>
						 					<div class="col-sm-2"><kbd> ${event.task} </kbd></div>
						 					<div class="col-sm-2">${event.date_of_event}</div>
						 					<div class="col-sm-6"> ${event.disc} </div>
										</div>
								 	</li>
								</a>
							</td>
						</tr>
						`;
					}).join('')}
				</table>

						`;
	});


function today() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function tomorrow() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput02");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable02");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function all_events() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  console.log('all: '+input);
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}



</script>	

@stop