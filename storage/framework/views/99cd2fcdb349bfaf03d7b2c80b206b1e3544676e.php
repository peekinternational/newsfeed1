<?php $__env->startSection('style'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend-assets/css/owl.carousel.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend-assets/css/owl.theme.default.min.css')); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo e(asset('frontend-assets/dashboard/css/jquery-ui.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('frontend-assets/dashboard/css/style2.css')); ?>">
<script src="<?php echo e(asset('frontend-assets/dashboard/js/jquery-ui.js')); ?>"></script>

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
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

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
                <a href="<?php echo e(url('dashboard/allcsv')); ?>" class="btn top-btn csv-btn" disabled>Download <br> CSV</a>
                <a href="" class="btn btn-primary top-btn new-btn" id="top_btn" data-toggle="modal" data-target="#create_section" style="background: #63c6bd;" disabled>New Section</a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?php echo e(url('dashboard/logout')); ?>">Logout</a>
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
                      <?php $__currentLoopData = Feed::teams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="team,<?php echo e($team->id); ?>"><?php echo e($team->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <option disabled value="" style="font-weight: 700;">Roles</option>
                      <?php $__currentLoopData = Feed::roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="role,<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control border-gray" id="keyword" placeholder="Search" onkeyup="searchByname(this.value)" onkeydown="searchByname(this.value)" style="width:300px;">
                  </div>
                  <!-- <div class="form-group">
                    <select name="team" id="get_teams" class="form-control border-gray" onchange="teams(this);">
                            <option value="">Select Team</option>
                            <?php $__currentLoopData = Feed::teams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($team->id); ?>"><?php echo e($team->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                  </div>
                  <div class="form-group">
                      <select name="role" id="get_role" class="form-control border-gray" onchange="postion(this);">
                            <option value="">Select Role</option>
                            <?php $__currentLoopData = Feed::roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                  </div> -->
                  <!-- <button type="submit" class="btn btn-default">Submit</button> -->
                </form>
                <p class="pull-right mb-0" style="line-height: 36px"><span id="show_record"></span> </p>
              </div>
            </div>
            <?php if(Session::has('post')): ?>
               <div class="alert alert-success">
                  <?php echo e(Session::get('post')); ?>

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <?php endif; ?>
               <?php if(Session::has('delnum')): ?>
               <div class="alert alert-success">
                  <?php echo e(Session::get('delnum')); ?>

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <?php endif; ?>
            <div class="card" style="background-color: #dbdedf;">
              <!-- <div class="card-header">
                <h4 class="card-title"> Jobs List</h4>
              </div> -->

              <div class="card-body pt-0">
                <!-- <div class="row justify-content-center border-bottom border-secondary">
                  <h4 class="w-100 px-3 pt-2">Section title</h4>
                  <div class="col-md-10">
                    <div class="owl-carousel owl-theme">
                      <div class="item text-center h-105">
                        <div class="rounded border border-white h-100 overflow-hidden bg-secondary py-4">
                          <a href="<?php echo e(url('dashboard/gallery/add-content')); ?>"><i class="fa fa-plus-circle fa-2x text-white mt-2"></i></a>
                        </div>
                      </div>
                      <div class="item">
                        <div class="border border-white rounded mh-100 overflow-hidden h-105">
                          <img src="<?php echo e(asset('frontend-assets/dashboard/img/faces/abc1.jpg')); ?>" class="rounded mh-100 h-100">
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
                          <img src="<?php echo e(asset('frontend-assets/dashboard/img/faces/abc2.jpg')); ?>" class="rounded mh-100 h-100">
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
                          <img src="<?php echo e(asset('frontend-assets/dashboard/img/faces/abc2.jpg')); ?>" class="rounded mh-100 h-100">
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
                </div> -->
                <div class="showresponce" id="showresponce">
                  <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="row justify-content-center border-bottom border-secondary">
                    <h4 class="w-100 px-3 pt-2"><?php echo e($section->title); ?></h4>
                    <div class="col-md-10">
                      <div class="row">

                        <div class="col-md-2" style="margin-top:10px">
                          <div class="item text-center h-105" style="width:60%;">
                            <div class="rounded border border-white h-100 overflow-hidden bg-secondary py-4">
                              <a href="<?php echo e(url('dashboard/gallery/add-content/'.$section->id)); ?>"><i class="fa fa-plus-circle fa-2x text-white mt-2"></i></a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10">
                          <div class="">

                            <div id="gallery">
                              <div id="image-container" style="width: 100%;">
                                <ul id="image-list" class="image-list news-slide-menu">
                                  <!-- <div class="item"> -->
                                  <?php $__currentLoopData = Feed::getgallery($section->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                  <?php
                                  // print_r($img->cover_image); die;
                                  $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
                                  if($img->cover_image){
                                    $cover_image=$img->cover_image;
                                  }else{
                                    $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
                                  }

                                  ?>
                                  <!-- <li id="image_<?php echo e($img->id); ?>" ><img src="<?php echo e($cover_image); ?>" class="rounded mh-100 h-100"></li> -->
                                  <!-- <div class="border border-white rounded mh-100 overflow-hidden h-105"> -->
                                  <li id="image_<?php echo e($img->id); ?>" >
                                    <div class="border border-white rounded mh-100 overflow-hidden h-105">
                                      <img src="<?php echo e($cover_image); ?>" class="rounded mh-100 h-100">
                                    </div>
                                    <div class="edit-icon">
                                      <!-- <a href="" data-toggle="modal" data-target="#exampleModal-<?php echo e($img->id); ?>"><i class="fa fa-edit text-primary pr-2"></i></a> -->
                                      <a href="" data-toggle="modal" data-target="#exampleModal-<?php echo e($img->id); ?>"><i class="material-icons" style="color:white;font-size:18px;">edit</i></a>
                                      <a href=""  data-toggle="modal" data-target="#deleteModal-<?php echo e($img->id); ?>"><i class="material-icons" style="color:white;font-size:18px;">delete</i></a>
                                    </div>
                                    <div class="py-2 pl-1">
                                      <p class="mb-0"><?php echo e($img->title); ?></p>
                                    </div>
                                  </li>

                                  <!-- Edit Content Modal -->
                                  <div class="modal fade" id="exampleModal-<?php echo e($img->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title text-uppercase" style="font-weight: 700;" id="exampleModalLabel">Edit content</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?php echo e(url('dashboard/gallery/edit-content')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="form-group">
                                              <input type="text" name="" class="select-img" id="file_name" placeholder="Insert a cover image">
                                              <label for="insert-cover">
                                                <button class="btn btn-default image-btn">Insert</button>
                                                <input type="file" name="cover_image" id="insert-cover" onchange="document.getElementById('file_name').value = this.value.split('\\').pop().split('/').pop()">
                                              </label>
                                            </div>
                                            <input type="hidden" name="content_id" value="<?php echo e($img->id); ?>">
                                            <!-- <div class="form-group">
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
                            </div> -->
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-8">
                                  <input type="text" name="title" class="form-control" placeholder="title" value="<?php echo e($img->title); ?>">
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
                      </div>
                    </div>
                  </div>
                  <!-- Edit Content Modal End -->
                  <!-- Delete Content Modal -->
                  <div class="modal fade" id="deleteModal-<?php echo e($img->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-uppercase" style="font-weight: 700;" id="exampleModalLabel">Delete Content ?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure want to delete this content "<?php echo e($img->title); ?>"?</p>
                          <input type="hidden" name="content_id" value="<?php echo e($img->id); ?>">
                          <div class="form-group">
                            <div class="row justify-content-center">
                              <div class="col col-md-3">
                                <a href="<?php echo e(url('/dashboard/gallery/delete-content/'.$img->id)); ?>" class="btn background-blue mt-0 mb-0 rounded w-100">Yes</a>
                              </div>
                              <div class="col col-md-3 pl-1">
                                <button type="button" class="btn background-pink mt-0 mb-0 rounded w-100" data-dismiss="modal">No</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Delete Content Modal End -->

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="action">
        <a href="" style="padding-right: 3px;" data-toggle="modal" data-target="#EditSectionModal-<?php echo e($section->id); ?>"><i class="material-icons" style="color:gray">edit</i></a>
        <a href="" data-toggle="modal" data-target="#duplicate_section-<?php echo e($section->id); ?>"><i class="material-icons" style="color:gray">library_add</i></a>
        <a href="" data-toggle="modal" data-target="#deleteSectoinModal-<?php echo e($section->id); ?>" style="padding-right: 3px;"> <i class="material-icons" style="color:gray">delete</i> </a>
      </div>
    </div>
  </div>

  <!-- Duplicate Section Modal -->
  <div class="modal fade" id="duplicate_section-<?php echo e($section->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" style="font-weight:700;" id="exampleModalLabel">Duplicate Section <br>
          </h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
          <p style="font-size: 13px;text-transform: initial;">Create a new section from an old one, duplicating also all the content within it. </p>
          <form method="post" action="<?php echo e(url('/dashboard/gallery/duplicate-section')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
              <div class="row">
                <div class="col-md-9">
                  <input type="text" name="section_title" class="form-control" placeholder="Section title" required>
                </div>
                <input type="hidden" name="section_id" value="<?php echo e($section->id); ?>">
                <div class="col-md-3">
                  <input type="submit" name="edit_form" value="Create" class="btn btn-primary background-blue mt-0 mb-0 rounded">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <select class="c-select form-control" name="type" required>
                    <option selected disabled hidden="">Teams/Role</option>
                    <option disabled value="" style="font-weight: 700;">Teams</option>
                    <?php $__currentLoopData = Feed::teams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="team,<?php echo e($team->id); ?>"><?php echo e($team->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option disabled value="" style="font-weight: 700;">Roles</option>
                    <?php $__currentLoopData = Feed::roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="role,<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Duplicate Section Modal End -->
  <!-- Edit Section Modal -->
  <div class="modal fade" id="EditSectionModal-<?php echo e($section->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" style="font-weight: 700;" id="exampleModalLabel">Edit Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo e(url('dashboard/gallery/edit-section')); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
              <div class="row">
                <div class="col-md-9">
                  <input type="text" name="section_title" class="form-control" value="<?php echo e($section->title); ?>" placeholder="Section title" required>
                </div>
                <input type="hidden" name="section_id" value="<?php echo e($section->id); ?>">
                <div class="col-md-3">
                  <input type="submit" name="edit_form" value="Update" class="btn btn-primary background-blue mt-0 mb-0 rounded">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <select class="c-select form-control" name="type" required>
                    <!-- <option selected disabled hidden="">Teams/Role</option> -->
                    <option disabled value="" style="font-weight: 700;">Teams</option>
                    <?php $__currentLoopData = Feed::teams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $type ='';
                    if('team,'.$team->id === $section->type.','.$section->team_role_id){
                      $type = 'yes';
                    }else{
                      $type = 'no';
                    }

                    ?>

                    <option value="team,<?php echo e($team->id); ?>" <?php echo e($type == 'yes' ? 'selected="selected"' : ''); ?>><?php echo e($team->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option disabled value="" style="font-weight: 700;">Roles</option>
                    <?php $__currentLoopData = Feed::roles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $type2 ='';
                    if('role,'.$role->id === $section->type.','.$section->team_role_id){
                      $type2 = 'yes';
                    }else{
                      $type2 = 'no';
                    }

                    ?>
                    <option value="role,<?php echo e($role->id); ?>" <?php echo e($type2 == 'yes' ? 'selected="selected"' : ''); ?>><?php echo e($role->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Section Modal End -->
  <!-- Delete Section Modal -->
  <div class="modal fade" id="deleteSectoinModal-<?php echo e($section->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" style="font-weight: 700;" id="exampleModalLabel">Delete Content ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure want to delete this content "<?php echo e($section->title); ?>". Section and all contents on it ?</p>
          <input type="hidden" name="content_id" value="<?php echo e($section->id); ?>">
          <div class="form-group">
            <div class="row justify-content-center">
              <div class="col col-md-3">
                <a href="<?php echo e(url('/dashboard/gallery/delete-section/'.$section->id)); ?>" class="btn background-blue mt-0 mb-0 rounded w-100">Yes</a>
              </div>
              <div class="col col-md-3 pl-1">
                <button type="button" class="btn background-pink mt-0 mb-0 rounded w-100" data-dismiss="modal">No</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Section Modal End -->
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Content Modal -->
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
      </div>
    </div>
  </div>
  <!-- Edit Content Modal End -->

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
                  <input type="text" name="section_title" id="new_section_title" class="form-control" placeholder="Section title">
                </div>
                <div class="col-md-3">
                  <input type="submit" name="edit_form" id="create_section_btn" value="Create" class="btn btn-primary background-blue mt-0 mb-0 rounded">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Duplicate Section Modal -->
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
  <!-- Duplicate Section Modal End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('frontend-assets/js/owl.carousel.min.js')); ?>"></script>
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
              url: "<?php echo e(url('/dashboard/gallery/search')); ?>",
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
      var _token = "<?php echo e(csrf_token()); ?>";
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
    		url:" <?php echo e(url('dashboard/gallery/add_section')); ?>",
    		data: {title:title,type:type,_token:"<?php echo e(csrf_token()); ?>"},
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
  									 url: "<?php echo e(url('/dashboard/gallery/reorderUpdate')); ?>",
  									 type: 'post',
  									 data: {imageIds: imageIdsArray,_token:"<?php echo e(csrf_token()); ?>"},
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>