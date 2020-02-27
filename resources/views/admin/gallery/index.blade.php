@extends('admin.layouts.master')

@section('style')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
.owl-dots{
  display: none;
}
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
</style>

@endsection
@section('content')

  <div class="wrapper">
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
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
                <a href="{{url('dashboard/allcsv')}}" class="btn top-btn csv-btn">Download <br> CSV</a>
                <a href="" class="btn btn-primary top-btn new-btn" data-toggle="modal" data-target="#create_section" style="background: #63c6bd;">New Section</a>
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
                    <select class="form-control border-gray" placeholder="">
                      <option disabled selected hidden>Roles/Teams</option>
                      <option style="font-weight: 700;">Teams</option>
                      @foreach(Feed::teams() as $team)
                      <option value="{{$team->id}}">{{$team->name}}</option>
                      @endforeach
                      <option style="font-weight: 700;">Roles</option>
                      @foreach(Feed::roles() as $role)
                      <option value="{{$role->id}}">{{$role->name}}</option>
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
            <div class="card" style="background-color: #dbdedf;">
              <!-- <div class="card-header">
                <h4 class="card-title"> Jobs List</h4>
              </div> -->

              <div class="card-body pt-0">                
                <div class="row justify-content-center border-bottom border-secondary">
                  <h4 class="w-100 px-3 pt-2">Section title</h4>
                  <div class="col-md-10">
                    <div class="owl-carousel owl-theme">
                      <div class="item text-center h-105">
                        <div class="rounded border border-white h-100 overflow-hidden bg-secondary py-4">
                          <a href="{{url('dashboard/gallery/add-content')}}"><i class="fa fa-plus-circle fa-2x text-white mt-2"></i></a>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc1.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary pr-2"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc2.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="action">
                      <a href="" style="padding-right: 3px;"><i class="material-icons" style="color:gray">edit</i></a>
                      <a href="" data-toggle="modal" data-target="#duplicate_section"><i class="material-icons" style="color:gray">library_add</i></a>
                      <a href="" style="padding-right: 3px;"> <i class="material-icons" style="color:gray">delete</i> </a>
                    </div>
                  </div>
                </div>   

                <div class="row justify-content-center border-bottom border-secondary">
                  <h4 class="w-100 px-3 pt-2">Section title</h4>
                  <div class="col-md-10">
                    <div class="owl-carousel owl-theme">
                      <div class="item text-center h-105">
                        <div class="rounded border border-white h-100 overflow-hidden bg-secondary py-4">
                          <a href=""><i class="fa fa-plus-circle fa-2x text-white mt-2"></i></a>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc1.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc2.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc2.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc2.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc2.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc2.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="{{asset('frontend-assets/dashboard/img/faces/abc2.jpg')}}" class="rounded mh-100 h-100">
                        </div>
                        <div class="edit-icon d-none">
                          <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit text-primary"></i></a>
                          <a href=""><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <div class="py-2 pl-1">
                          <p class="mb-0">Freela team region</p>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="action">
                      <a href="" style="padding-right: 3px;"><i class="material-icons" style="color:gray">edit</i></a>
                      <a href="" data-toggle="modal" data-target="#duplicate_section"><i class="material-icons" style="color:gray">library_add</i></a>
                      <a href="" style="padding-right: 3px;"> <i class="material-icons" style="color:gray">delete</i> </a>
                    </div>
                  </div>
                </div> 
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">Edit content</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" name="" class="select-img" id="file_name" placeholder="Insert a cover image">
              <label for="insert-cover">
                <button class="btn btn-default image-btn">Insert</button>
              <input type="file" name="cover_image" id="insert-cover" onchange="document.getElementById('file_name').value = this.value.split('\\').pop().split('/').pop()">
              </label>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <select class="c-select form-control">
                    <option selected disabled="">Teams/Role</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <select class="c-select form-control">
                    <option selected disabled="">Select section</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <input type="text" name="name" class="form-control" placeholder="title">
                </div>
                <div class="col-md-3">
                  <input type="submit" name="edit_form" value="Save" class="btn btn-primary background-blue mt-0 mb-0 rounded">
                </div>
              </div>
            </div>
            <div class="form-group">
              
            </div>
          </form>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Create Section Modal -->
  <!-- Modal -->
  <div class="modal fade" id="create_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">New Section <br>
            <span style="font-size: 1rem;text-transform: initial;">Section create division to organize and categorize contents</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          
        </div>
        <div class="modal-body">
          <form method="" action="">
            <div class="form-group">
              <div class="row">
                <div class="col-md-9">
                  <input type="text" name="section_title" class="form-control" placeholder="Section title">
                </div>
                <div class="col-md-3">
                  <input type="submit" name="edit_form" value="Create" class="btn btn-primary background-blue mt-0 mb-0 rounded">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Duplicate Section Modal -->
  <!-- Modal -->
  <div class="modal fade" id="duplicate_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="exampleModalLabel">Duplicate Section <br>
            <span style="font-size: 1rem;text-transform: initial;">Create a new section from an old one, duplicating also all the content within it. </span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          
        </div>
        <div class="modal-body">
          <form method="" action="">
            <div class="form-group">
              <div class="row">
                <div class="col-md-9">
                  <input type="text" name="section_title" class="form-control" placeholder="Section title">
                </div>
                <div class="col-md-3">
                  <input type="submit" name="edit_form" value="Create" class="btn btn-primary background-blue mt-0 mb-0 rounded">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <select class="c-select form-control">
                    <option selected disabled="">Teams/Role</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>
            </div>
          </form>
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
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: true
        },
        600: {
          items: 3,
          nav: false
        },
        1000: {
          items: 6,
          nav: true,
          loop: false,
          margin: 20
        }
      }
    })
  })
</script>
<script>
  $( function() {
      $( ".item" ).draggable();
    } );
  </script>
@endsection
