@extends('layouts.master')

@section('title','Dashboard')

@section('footer_JSscript')
	
<script>
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


var todayCount = document.getElementById('today_count_field').value;
var tomorrowCount = document.getElementById('tomorrow_count_field').value;
var allCount = document.getElementById('all_count_field').value;

	console.log("Count = "+todayCount);
	document.getElementById("CountToday").innerHTML=todayCount;
	document.getElementById("CountTomorrow").innerHTML=tomorrowCount;
	document.getElementById("all").innerHTML=allCount;
	


</script>
@stop

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
</style>
@stop

@section('content')






<!-- {{\Carbon\Carbon::now()->addDays(1)->format('d-m')}} -->



<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active tab-heading" href="#profile" role="tab" data-toggle="tab" >Today's Events <span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountToday"></span>
		
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link tab-heading" href="#buzz" role="tab" data-toggle="tab">Tomorrow's Events <span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="CountTomorrow"></span> </a>
  </li>
  <li class="nav-item">
    <a class="nav-link tab-heading" href="#references" role="tab" data-toggle="tab">All Events <span class="badge" style="background-color: #d55; font-size: 14px; color: #fff;" id="all"></span> </a>
  </li>
</ul>



<!-- Tab panes -->
<div class="tab-content" >
	<div role="tabpanel" class="tab-pane  active" id="profile">
 		<!-- Today's Event -->
 		<div class="card">
			<div class="card-header"><h3>Event List</h3> </div>
			<div class="card-body">

				<div class="form-group">
					<input type="text" id="myInput" onkeyup="today()" placeholder="Search Anything" title="Type in a name" class="form-control">
				</div>
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
				
				

				@foreach($events->sortBy('date_of_event') as $event)


				@if( Carbon\Carbon::parse($event->date_of_event)->format('d-m') == \Carbon\Carbon::now()->format('d-m') )
				
				<?php
				$today_count = $event->where('date_of_event',Carbon\Carbon::parse($event->date_of_event))->count();
				?>

				

				<tr id='list-row'>
					
					<td>
						<a href='#{{ $event->id }}' >
						 	<li class="list-group-item">
						 		<div class="row" id="myList">
					 					<div class="col-sm-2">{{ $event->id }}</div>
								 		<div class="col-sm-2"><kbd> {{ $event->task }} </kbd></div>
								 		<div class="col-sm-2"> {{ Carbon\Carbon::parse($event->date_of_event)->format('d-M') }}  </div>
								 		<div class="col-sm-6"> {{ $event->disc }} </div>
								</div>
						 	</li>
						</a>
					</td>
				</tr>
				@endif
				@endforeach
				<input type="hidden" id='today_count_field' value="@if(isset($today_count)) {{$today_count}} @else 0 @endif"/>
				</table>
			</div>
		</div>
	</div>

	<div role="tabpanel" class="tab-pane fade" id="buzz">
		<!-- Tomorrow's Event -->

		<div class="card">
			<div class="card-header"><h3>Event List</h3> </div>
			<div class="card-body">

				<div class="form-group">
					<input type="text" id="myInput02" onkeyup="tomorrow()" placeholder="Search Anything" title="Type in a name" class="form-control">
				</div>
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
				
				@foreach($events->sortBy('date_of_event') as $event)

				@if( Carbon\Carbon::parse($event->date_of_event)->format('d-m') == \Carbon\Carbon::now()->addDays(1)->format('d-m') )
				
				<?php
				$tomorrowCount = $event->where('date_of_event',Carbon\Carbon::parse($event->date_of_event))->count();
				?>

				<tr id='list-row'>
					
					<td>
						<a href='#{{ $event->id }}' >
						 	<li class="list-group-item">
						 		<div class="row" id="myList">
					 					<div class="col-sm-2">{{ $event->id }}</div>
								 		<div class="col-sm-2"><kbd> {{ $event->task }} </kbd></div>
								 		<div class="col-sm-2"> {{ Carbon\Carbon::parse($event->date_of_event)->format('d-M') }}  </div>
								 		<div class="col-sm-6"> {{ $event->disc }} </div>
								</div>
						 	</li>
						</a>
					</td>
				</tr>
				@endif
				@endforeach
				<input type="hidden" id='tomorrow_count_field' value="@if(isset($tomorrowCount)) {{$tomorrowCount}} @else 0 @endif"/>
				</table>
			</div>
		</div>

	</div>

	<div role="tabpanel" class="tab-pane fade" id="references">
			<div class="card">
				<div class="card-header"><h3>All Events</h3> </div>
				<div class="card-body">

					<div class="form-group">
						<input type="text" id="myInput2" onkeyup="all_events()" placeholder="Search Anything" title="Type in a name" class="form-control">
					</div>
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
					
					<?php
							$all =0;
						?>

					@foreach($events->sortBy('date_of_event') as $event)

						@if( Carbon\Carbon::parse($event->date_of_event)->format('d-m-y') >= \Carbon\Carbon::now()->format('d-m-y') )
						<?php
							$all += 1;
						?>

						<tr id='list-row'>
							
							<td>
								<a href='#{{ $event->id }}' >
								 	<li class="list-group-item">
								 		<div class="row" id="myList">
							 					<div class="col-sm-2">{{ $event->id }}</div>
										 		<div class="col-sm-2"><kbd> {{ $event->task }} </kbd></div>
										 		<div class="col-sm-2">{{ Carbon\Carbon::parse($event->date_of_event)->format('d-M-Y') }}</div>
										 		<div class="col-sm-6"> {{ $event->disc }} </div>
										</div>
								 	</li>
								</a>
							</td>
						</tr>
						@endif

					@endforeach


					<input type="hidden" id='all_count_field' value="@if(isset($all)) {{$all}} @else 0 @endif"/>
					</table>
				</div>
			</div>
	</div>

</div>


<br><br>


<br>
	
@stop
