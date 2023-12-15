@extends('auth.master')

@section('css')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
<head>
<meta name="viewport" content="initial-scale=1.0, width=device-width" />
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
  type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
  type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"
       type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" ></script>
 <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
<div class="h-100 fixed" style="padding: 20px;">
    <div class="row h-100">
      <div class="col-3">
        <div class="tab-content" id="interventions-content">
            <div class="tab-pane fade show active" id="intervention" role="tabpanel" aria-labelledby="intervention-tab" style="margin-top: 15px;">
                <div class="form-group">
                  <input type="text" class="form-control" id="description" placeholder="Descrição">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="datetimes" id="date"/>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary form-control" id="btn-intervention" name="btn-intervention">Adicionar Interdição</button>
                </div>
            </div>
        </div>
      </div>
<script>

</script>

      <div class="col-9">
	<div style="width: 640px; height: 480px" id="mapContainer"></div>
		<script>
			var platform = new H.service.Platform({
  			'apikey': 'Xx5yDLc19ALja3ez6NYnWtGB1EkpARUi5qCTnK0nlF0'
			});
			// Obtain the default map types from the platform object:
			var defaultLayers = platform.createDefaultLayers();

			// Instantiate (and display) a map object:
			var map = new H.Map(
    			document.getElementById('mapContainer'),
    			defaultLayers.vector.normal.map,
    			{
      				zoom: 13,
      				center: { lat: -22, lng: -47.9 }
    			});

			// Add event listener:
			map.addEventListener('tap', function(evt) { 
			});
			// The behavior variable implements default interactions for pan/zoom (also on mobile touch environments).
 			const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

 			// Enable dynamic resizing of the map, based on the current size of the enclosing cntainer
 			window.addEventListener('resize', () => map.getViewPort().resize());

 			// Create the default UI:
		 	var ui = H.ui.UI.createDefault(map, defaultLayers, 'pt-BR');
            const zoomControl = ui.getControl('mapsettings');
            zoomControl.setVisibility(false);

 			/**
            * Returns an instance of H.map.Icon to style the markers
            * @param {number|string} id An identifier that will be displayed as marker label
            *
            * @return {H.map.Icon}
            */
            function getMarkerIcon(id) 
            {
                const svgCircle = `<svg width="30" height="30" version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <g id="marker">
                            <circle cx="15" cy="15" r="10" fill="#0099D8" stroke="#0099D8" stroke-width="4" />
                            <text x="50%" y="50%" text-anchor="middle" fill="#FFFFFF" font-family="Arial, sans-serif" font-size="12px" dy=".3em">${id}</text>
                          </g></svg>`;
                return new H.map.Icon(svgCircle, {
                    anchor: {
                        x: 10,
                        y: 10
                    }
                });
            }

			function addMarker(position, id) 
			{
     		    const marker = new H.map.Marker(position, 	
				{
         			data: 
					{
             			id
         			},
         			icon: getMarkerIcon(id),
					volatility: true
     			});
				marker.draggable = true;
     			map.addObject(marker);
     			return marker;
 			}
			map.addEventListener('dragstart', function(ev) 
			{
     			const target = ev.target;
     			const pointer = ev.currentPointer;
     			if (target instanceof H.map.Marker) 
				{
				    behavior.disable(H.mapevents.Behavior.Feature.PANNING);
         			var targetPosition = map.geoToScreen(target.getGeometry());
                  	target['offset'] = new H.math.Point(pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y);
     			}
 			}, false);
			var origemlat, origemlng, destinolat, destinolng;
			map.addEventListener('drag', function(ev) 
			{
     			const target = ev.target;
     			const pointer = ev.currentPointer;
     			if (target instanceof H.map.Marker) 
				{
         			target.setGeometry(map.screenToGeo(pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y));
     			}
 			}, false);
			map.addEventListener('dragend', function(ev) 
			{
     			const target = ev.target;
     			if (target instanceof H.map.Marker) 
				{
         			behavior.enable(H.mapevents.Behavior.Feature.PANNING);
         			const coords = target.getGeometry();
         			const markerId = target.getData().id;
				    if (markerId === 'A') 
					{
             			routingParams.origin = `${coords.lat},${coords.lng}`;
         			} 
					else if (markerId === 'B') 
					{
             			routingParams.destination = `${coords.lat},${coords.lng}`;
         			}
         			updateRoute();
     			}
 			}, false);

			const origin = 
			{
     			lat: -21.99,
     			lng: -47.9
 			};
 			const destination = 
			{
     			lat: -22.01,
     			lng: -47.89
 			}; 
			const originMarker = addMarker(origin, 'A');
 			const destinationMarker = addMarker(destination, 'B');
			const routingParams = 
			{
     			'origin': `${origin.lat},${origin.lng}`,
     			'destination': `${destination.lat},${destination.lng}`,
     			'transportMode': 'car',//mudar para pedestrian
     			'return': 'polyline'
 			};
			const router = platform.getRoutingService(null, 8);
			let routePolyline;
 			function routeResponseHandler(response) 
			{
     			const sections = response.routes[0].sections;
     			const lineStrings = [];
     			sections.forEach((section) => 
				{
         		    // convert Flexible Polyline encoded string to geometry
         			lineStrings.push(H.geo.LineString.fromFlexiblePolyline(section.polyline));
     			});
     			const multiLineString = new H.geo.MultiLineString(lineStrings);
     			const bounds = multiLineString.getBoundingBox();
			    // Create the polyline for the route
     			if (routePolyline) 
				{
         		    // If the routePolyline we just set the new geometry
         			routePolyline.setGeometry(multiLineString);
     			} 
				else 
				{
         			// routePolyline is not yet defined, instantiate a new H.map.Polyline
         			routePolyline = new H.map.Polyline(multiLineString, 
					{
             			style: {
                 			lineWidth: 5
             			}
         			});
     			}
			    // Add the polyline to the map
				map.addObject(routePolyline);
 			}
			function updateRoute() 
			{
     			router.calculateRoute(routingParams, routeResponseHandler, console.error);
 			}
			updateRoute();
		</script>
        </div>
@endsection

@section('js')
<input type="hidden" name="to" id="to" value="">
<input type="hidden" name="from" id="from" value="">
<script type="text/javascript">

$(function() {
  $('input[name="datetimes"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
timePicker24Hour: true,
    locale: {
      format: 'DD/MM/YYYY hh:mm'
    }
  });
});
</script>

  <script type='module'>
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import { getDatabase, set, push, ref } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-database.js";
    // Add Firebase products that you want to use

const firebaseConfig = {

    apiKey: "AIzaSyBMeStwvz12p3wdRCZT0ZIjh-F_IEfGvvs",

  authDomain: "hereapp-a7be6.firebaseapp.com",

  databaseURL: "https://hereapp-a7be6-default-rtdb.firebaseio.com",

  projectId: "hereapp-a7be6",

  storageBucket: "hereapp-a7be6.appspot.com",

  messagingSenderId: "648507048604",

  appId: "1:648507048604:web:f64f527c6f8ac4aa062359"

  };

// Initialize Firebase
  const app = initializeApp(firebaseConfig);

// Initialize Realtime Database and get a reference to the service
const database = getDatabase(app);

  var description, date;

  $("#btn-intervention").click(function(){
    description = $('#description').val();
date = $('input[name="datetimes"]').val();
var data = date.toString();
        var array = data.split(" - ");

const postListRef = ref(database, 'interdictions');
const newPostRef = push(postListRef);
set(newPostRef, {beginDate: array[0],
    description: description,
    destination: destination,
    endDate: array[1],
    origin: origin});
});
</script>
@endsection
</body>
