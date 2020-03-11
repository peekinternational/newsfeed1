@extends('admin.layouts.master')

@section('style')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{asset('frontend-assets/dashboard/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('frontend-assets/dashboard/css/style2.css')}}">
<script src="{{asset('frontend-assets/dashboard/js/jquery-ui.js')}}"></script>

<style>
.daterangepicker td.in-range {
    background-color: #51cbce;
    border-color: transparent;
    color: #fbfbfb;
    border-radius: 0;
}
.modal-header .close {
    padding: 0 !important;
    margin: 0 !important;
}
.h-105{
  height: 105px;
}
.overflow-hidden{
  overflow: hidden;
}
.edit-icon{
  position: absolute;
  bottom: 27%;
  right: 6px;
}
.item:hover .edit-icon{
  display: block !important;
}
/* .owl-dots{
  display: none;
} */
.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev {
  position: absolute;
}
.owl-carousel .owl-nav button.owl-next{
  right: -20px;
  top: 10%;
  /*background: black;*/
  color: black;
  border-radius: 50%;
  padding: 23px;
  height: 24px;
}
.owl-carousel .owl-nav button.owl-next span{
  font-size: 32px;
}
 .owl-carousel .owl-nav button.owl-prev span{
  font-size: 32px;
 }
 .owl-carousel .owl-nav button.owl-prev{
  left: 0;
  top: 14%;
  /*background: black;*/
  color: black;
  border-radius: 50%;
  padding: 23px;
  height: 24px;
}
.image-list li img {
  width: 147px !important;
  height: 105px !important;
}
.edit-icon2 {
    position: absolute;
    top: 50%;
    width: 100%;
    padding: 9px;
}
.news-slide-menu {
    display: block;
    padding: 0px;
    white-space: nowrap;
    overflow-x: auto;
    margin: 3px 0;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: smooth;
    /* width: 553px; */
    overflow-x: hidden;
    /* display: block; */
    white-space: nowrap;
    overflow-x: auto;
}
.news-slide-menu li {
    display: inline-block;
    position: relative;
    list-style: none;
    font-size: 12px;
    margin: 0 5px;
    font-weight: 400;
    line-height: 15px;
    cursor: pointer;
    vertical-align: middle;
    color: #414e5a;
    float: none;
}

::-webkit-scrollbar{
        height: 6px;
        width: 4px;
    }
    ::-webkit-scrollbar-thumb:horizontal{
        background: gray;
        border-radius: 10px;
    }
.main-panel>.content {
  padding-top: 20px !important;
}
</style>

@endsection
@section('content')

  <div class="wrapper">
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid" style="marin-top:15px;">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo" style="text-transform:uppercase;"><strong>Gallery</strong></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">
              <li>
                <a href="{{url('dashboard/allcsv')}}" class="btn top-btn csv-btn" disabled>Download <br> CSV</a>
                <a href="" class="btn btn-primary top-btn new-btn" id="top_btn" data-toggle="modal" data-target="#create_section" style="background: #63c6bd;" disabled>New Section</a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ url('dashboard/logout') }}">Logout</a>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12 mb-20">
                <form class="form-inline pull-left search-bar" action="">
                  <!-- <div class="form-group">
                    <input type="text" class="form-control border-gray" id="keyword" placeholder="Search" onkeyup="searchByname(this.value)" onkeydown="searchByname(this.value)">
                  </div> -->
                  <!-- <div class="form-group">
                   <input id="e1" name="e1" class="form-control border-gray" value="Select Date">

                  </div> -->
                  <div class="form-group">
                    <select class="form-control border-gray" id="main_select" placeholder="" style="width:300px;">
                      <option disabled selected hidden>Roles/Teams</option>
                      <option disabled value="" style="font-weight: 700;">Teams</option>
                      @foreach(Feed::teams() as $team)
                      <option value="team,{{$team->id}}">{{$team->name}}</option>
                      @endforeach
                      <option disabled value="" style="font-weight: 700;">Roles</option>
                      @foreach(Feed::roles() as $role)
                      <option value="role,{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <!-- <div class="form-group">
                    <select name="team" id="get_teams" class="form-control border-gray" onchange="teams(this);">
                            <option value="">Select Team</option>
                            @foreach(Feed::teams() as $team)
                         <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                          </select>
                  </div>
                  <div class="form-group">
                      <select name="role" id="get_role" class="form-control border-gray" onchange="postion(this);">
                            <option value="">Select Role</option>
                            @foreach(Feed::roles() as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                          </select>
                  </div> -->
                  <!-- <button type="submit" class="btn btn-default">Submit</button> -->
                </form>
                <p class="pull-right mb-0" style="line-height: 36px"><span id="show_record"></span> </p>
              </div>
            </div>
            @if(Session::has('post'))
               <div class="alert alert-success">
                  {{ Session::get('post') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
               @if(Session::has('delnum'))
               <div class="alert alert-success">
                  {{ Session::get('delnum') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif


          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script type="text/javascript" src="{{asset('frontend-assets/js/owl.carousel.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(document).ready(function() {
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 3,
          nav: true
        },
        1000: {
          items: 3,
          nav: true,
          loop: false,
          margin: 20
        }
      }
    });
    $(".next").click(function(){
  $('.owl-carousel').trigger('owl.next');
})
$(".prev").click(function(){
  $('.owl-carousel').trigger('owl.prev');
})
$(".play").click(function(){
  $('.owl-carousel').trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
})
$(".stop").click(function(){
  $('.owl-carousel').trigger('owl.stop');
})
  })

  $( function() {
      $( ".item" ).draggable();
    } );

    $('#main_select').on('change',function () {
      var type = $('#main_select').val();
      // alert(type);
      window.location.href = "{{url('/dashboard/gallery')}}?type="+type;

      if (type !="") {
        $('.top-btn').removeAttr('disabled');
      }else {
        $('.top-btn').attr('disabled', true);

      }
    });
    function searchByname(searchkeyword){
      var searchkeyword = searchkeyword;
      var type =$('#main_select').val();
        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post',
              url: "{{url('/dashboard/gallery/search')}}",
              data: {
                searchkeyword: searchkeyword,type:type
                },
              success: function (response) {
                  $('#showresponce').html(response);
                  // console.log(response);
                  // var res = JSON.parse(response);
                  // var data =res.output;
                  // var total =res.total;
                  //   $('#showresponce2').html(data);
                  //   var totalcount =res.totalcount;
                  //    $('#show_record').html(total+' founds in '+totalcount+' publications');


              }
            });
      }

    // Add Menu through ajax
    $("#create_section_btn").on('click', function (e) {
    	// alert('hello');
    	e.preventDefault();
      var title = $('#new_section_title').val();
      var type = $('#main_select').val();
      var _token = "{{csrf_token()}}";
      // alert(type);
    	// form = new FormData();
    	// form.append('title',title);
    	// form.append('type',type);
    	// form.append('_token',_token);
    	// var formVal = $('form#add_category').serialize();
    	// console.log(form);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    	$.ajax({
    		type: "POST",
    		url:" {{ url('dashboard/gallery/add_section')}}",
    		data: {title:title,type:type,_token:"{{csrf_token()}}"},
    		// cache: false,
    		// contentType: false,
    		// processData: false,
    		success: function(data){
    			toastr.success('Section Created successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
    			location.reload();


    		},
    		error: function() {
    			$('#gifid').hide();
    			$('#loading').hide();
    			$('#checkcatid').prop("disabled",false);
    			alert("Error posting feed");
    		}
    	});
    	//return false;
    });

  </script>
  <script>
  			 $(document).ready(function () {
  					 var dropIndex;
  					 $(".image-list").sortable({
  								 update: function(event, ui) {
                     dropIndex = ui.item.index();
                    changePosition();
  							 }
  					 });

             function changePosition() {
  					 // $('#submit').click(function (e) {
  							 var imageIdsArray = [];
  							 $('.image-list li').each(function (index) {
  									 // if(index <= dropIndex) {
  											 var id = $(this).attr('id');
  											 var split_id = id.split("_");
  											 imageIdsArray.push(split_id[1]);
  									 // }
  							 });

  							 $.ajax({
  									 url: "{{ url('/dashboard/gallery/reorderUpdate')}}",
  									 type: 'post',
  									 data: {imageIds: imageIdsArray,_token:"{{csrf_token()}}"},
  									 success: function (response) {
                       toastr.success('Order Updated successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
  											// $("#txtresponse").css('display', 'inline-block');
  											// $("#txtresponse").text(response);
  									 }
  							 });
  							 // e.preventDefault();
  					 // });
           }

  			 });

  	 </script>
@endsection
