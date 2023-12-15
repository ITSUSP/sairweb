<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <title>SAIR: Sistema que Avisa sobre InteRdições</title>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <script src='https://kit.fontawesome.com/3176b763f7.js' crossorigin='anonymous'></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src='https://js.api.here.com/v3/3.1/mapsjs-mapevents.js' type='text/javascript' charset='utf-8'></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type='text/javascript' charset='utf-8' src='https://js.api.here.com/v3/3.1/mapsjs-ui.js' ></script>
    <link rel='stylesheet' type='text/css' href='https://js.api.here.com/v3/3.1/mapsjs-ui.css' />
    <link href='{{ URL::asset('css/visitante.css'); }}' rel='stylesheet' type='text/css'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js' integrity='sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+' crossorigin='anonymous'></script>
    <style type="text/css">
        html, body {
            height: 100%;
            margin: 0;
        }
    </style>
</head>

<body>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js' integrity='sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+' crossorigin='anonymous'></script>
    <nav class='navbar navbar-light bg-light navbar-fixed-top'>
        <div class='container-fluid'>
            <a class='navbar-brand'><i class='fa-solid fa-earth-americas'></i> SAIR</a>
<a class="nav-link" href="register"><span style="margin-right: 5px;"></span>Registrar-se</a>
            <form action='{{ route('authenticate') }}' method='post' class='d-flex'>
    	    @csrf
                <input class='form-control @error('email') is-invalid @enderror' type='email' placeholder='email' aria-label='Email' id='email' name='email' value='{{ old('email') }}'>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <input type='password' class='form-control @error('password') is-invalid @enderror' placeholder='senha' id='password' name='password'>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <button class='btn btn-primary form-control' type='submit' id='buttonlogin'>Login</button>
            </form>    
        </div>
    </nav>
    <div id="map"></div>
    <script>
        // Initialize the platform object
        var platform = new H.service.Platform({
            'apikey': 'Xx5yDLc19ALja3ez6NYnWtGB1EkpARUi5qCTnK0nlF0'
        });
        const defaultLayers = platform.createDefaultLayers();
        // Instantiate (and display) the map
        var map = new H.Map(
            document.getElementById('map'),
            defaultLayers.vector.normal.map,
            {
              zoom: 14,
              center: { lng: -47.9, lat: -22.01 }
            });
        var mapEvents = new H.mapevents.MapEvents(map);
        map.addEventListener('tap', function() {});
        const behavior = new H.mapevents.Behavior(mapEvents);
        window.addEventListener('resize', () => map.getViewPort().resize());
        // Create the default UI:
        const ui = H.ui.UI.createDefault(map, defaultLayers, 'pt-BR');
        const mapSettingsControl = ui.getControl('mapsettings');
        mapSettingsControl.setVisibility(false);
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
    </script>
    <script type='module'>
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js'
        // Add Firebase products that you want to use
        import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-database.js";
        const firebaseConfig = {
    
            apiKey: 'AIzaSyAduf-O9eko1BDAmfEFXbSnCJ9tR2vFwaI',
        
            authDomain: 'intervention-project-b7354.firebaseapp.com',
        
            databaseURL: 'https://intervention-project-b7354.firebaseio.com',
        
            projectId: 'intervention-project-b7354',
        
            storageBucket: 'intervention-project-b7354.appspot.com',
        
            messagingSenderId: '1076644742720',
        
            appId: '1:1076644742720:web:15482c20832db03b74c1a5',
        
            measurementId: 'G-BERXMK2MY4'
        
          };
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
    
        // Initialize Realtime Database and get a reference to the service
        const db = getDatabase();
        const starCountRef = ref(db, 'interventions/');
        const today = new Date();
        const now = today.getTime();
        
        onValue(starCountRef, (snapshot) => {
        //limpar todas as interdicoes do mapa aqui
            snapshot.forEach((intervencao) => {function getMarkerIcon(id) 
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

     		
     	
		var begin = moment(intervencao.child("beginDate"), "DD/MM/YYYY hh:mm").toDate().getTime();
		var end = moment(intervencao.child("endDate"), "DD/MM/YYYY hh:mm").toDate().getTime();
            	//se a intervencao ja passou, exclui-la do BD (depois!)
            	if(begin > now || end < now) return;

            	var origin = intervencao.child("origin").val();
            	var destination = intervencao.child("destination").val();
		addMarker(origin, 'A');
            	addMarker(destination, 'B');
            	const routingParams = 
    		{
         		'origin': `${origin.lat},${origin.lng}`,
         		'destination': `${destination.lat},${destination.lng}`,
         		'transportMode': 'pedestrian',
         		'return': 'polyline'
     		};
    		const router = platform.getRoutingService(null, 8);
    		let routePolyline;
                router.calculateRoute(routingParams, routeResponseHandler, console.error);
            });
        });
    </script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    
</body>
</html>