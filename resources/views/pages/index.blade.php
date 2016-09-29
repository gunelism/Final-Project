@extends('pages/layout')

@section('title')
   Ana səhifə
@endsection
@section('content')
  <!-- SEARCHBAR SECTION START -->
  <section id="searchbar">
    <div class="container">
      <div class="row">
        <!-- Listlər inline olaraq yazılıb -->
          <form class="form-inline" action="index.html" method="POST">
            <div class="form-group col-lg-4 col-md-4 col-sm-4">
              <input type="text" class="form-control" name="keyword" placeholder="Açar söz">
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-3"> <!--Şəhər inputu nisbətən kiçikdi. -->
              <input type="text" class="form-control" name="city" placeholder="Şəhər / Region">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4">
              <input type="text" class="form-control" name="category" placeholder="Kateqoriya">
            </div>
            <div class="form-group col-lg-1 col-md-1 col-sm-1">
              <input type="submit" class="form-control" name="submit" value="&#xf002;">
            </div>
          </form>
      </div>
    </div>
  </section>
  <!-- SEARCHBAR SECTION END -->

  <!-- GOOGLEMAP SECTION START -->
  <section id="googlemap">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 padding0">
            <div id="infoMap"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- GOOGLEMAP SECTION END -->

  <section id="news">
    <div class="container">
      <div class="row">
          @foreach($datas as $data)
            @if($data->status=='1'&& $data->type_id=='2')
                   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="thumbnail">
                    <a href="{{url('/single/'.$data->id)}}"><img src="{{url('/image/'.$data->image)}}" alt="News Image"></a>
                    <div class="caption">
                      <h3>{{$data->title}}</h3>
                      <p>{{substr($data->about, 0,150)}}...</p>
                      <p><a href="{{url('/single/'.$data->id)}}" class="btn center-block" role="button">Ətraflı</a></p>
                    </div>
                  </div>
                </div>
              @endif
          @endforeach
    </div>
               {{-- {{ $datas->links()}} --}}
               <a href="{{url('/isteksiyahisi')}}" class="pull-right"><h4>Bütün İstəklər <i class="fa fa-long-arrow-right" aria-hidden="true"></i></h4></a>
    </div>
  </section>
 {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAanmTrOlQYWRepobnwqSO1E2SOoHYMRBA&libraries=places&callback=initMap"async defer></script> --}}
 <script type="text/javascript" src="scripts/main.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAanmTrOlQYWRepobnwqSO1E2SOoHYMRBA&callback=initMap"
        async defer></script>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
      </script>
        <script type="text/javascript">
             var markers = [];
      function initMap() {
      var myLatLng = [
      @foreach($datamaps as $datamap)
         @if($datamap->status=='1')
            {lat: {{$datamap->lat}},
            lng:{{$datamap->lng}},
            title:"{{$datamap->title}}"
          },
          @endif

      @endforeach
      ];

      var map = new google.maps.Map(document.getElementById('infoMap'), {
      center: {  lat: 40.100,lng: 48.800},
      zoom: 8,
      scrollwheel: false
    });
    //   var infowindow = new google.maps.InfoWindow({
    //   content: 'hellooooo'
    // });
          //     var info = new google.maps.InfoWindow();
          //     function manyInfo(mark, infowindow) {
          //     infowindow.setContent(mark.title);
          //     infowindow.open(map, mark);
          //     markers.addListener('closeclick', function() {
          //         infowindow.setMarker(null);
          //     });
          //
          // }
        //  for (var i = 0; i < myLatLng.length; i++) {
        //     marker = new google.maps.Marker({
        //     position: myLatLng[i],
        //     map: map,
        //     title: 'Hello World!'
        //    });
        //    marker.addListener('click', function() {
        //   infowindow.open(map, marker);
        // });
        // }
         markers = myLatLng.map(function(location, i) {
              return new google.maps.Marker({
                  position: location,
                  title:myLatLng[i].title,
                  // label: labels[i],
                  id: i,
                  animation: google.maps.Animation.DROP
              });

          });
          // for (var i = 0; i < markers.length; i++) {
          //     google.maps.event.addListener(markers[i], 'click', function() {
          //         manyInfo(this, info);
          //     });
          // }
          var markerCluster = new MarkerClusterer(map, markers, {
            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
        });
}
        </script>

@endsection
