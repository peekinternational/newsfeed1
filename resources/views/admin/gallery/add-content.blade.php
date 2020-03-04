@extends('admin.layouts.master')

@section('style')
<link href="{{ asset('frontend-assets/css/dropzone.css') }}" rel="stylesheet">
<style>
.dropzone .dz-preview {
    margin-left: -117px;
}
</style>

@endsection
@section('content')
<?php
  $section_id = Request::segment('4');
 ?>
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
          <h5 class="text-uppercase" class="navbar-brand" href="#pablo"><strong>New Conetnt</strong></h5><br>
          <span class="heading-txt text-uppercase">Insert new content into gallery. You can choose between PDF, image or video file.</span>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
          <ul class="navbar-nav">
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
          <div class="card" style="width:70%;">
            <!-- <div class="card-header">
              <h4 class="card-title"> Add User</h4>
            </div> -->
            <div class="row" style="margin: 0;">
              <div class="col-md-12">

                <div role="tabpanel">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li role="presentation" class="active">
                      <a href="#text" aria-controls="home" role="tab" data-toggle="tab"><i class="material-icons">note_add</i><span>PDF</span> </a>
                    </li>
                    <li role="presentation">
                      <a href="#image" aria-controls="image" role="tab" data-toggle="tab"> <i class="material-icons">add_photo_alternate</i><span>Image</span> </a>
                    </li>
                    <li role="presentation">
                      <a href="#external_links" aria-controls="external_links" role="tab" data-toggle="tab"> <i class="material-icons">missed_video_call</i><span>Video</span> </a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="text">
                      <form method="post" action="" enctype="multipart/form-data"  id="TextForm">
                      {{ csrf_field() }}

                      <div class="form-group">
                        <input type="text" name="post_title" id="imagetitledata" class="form-control required2" placeholder="Title" required maxlength="130" onkeyup="imagetitle(this)">
                        <span class="asterisk"  style="display:none; color:#63c6bd">* Field Required</span>
                      </div>
                      <input type="hidden" name="section_id" value="{{$section_id}}">

                        <div class="input-field">
                          <label class="active">File</label>
                        </div>

                        <div class="form-group pull-left" style="margin-top: 196px;">
                            <input type="text" name="file_name_image" class="select-img required2" id="file_name_image" placeholder="Insert a cover image (mandatory)">
                            <label for="insert-cover">
                              <button class="btn btn-default image-btn">Insert</button>
                            <input type="file" class="required_image_text" name="cover_image" id="insert-image-text" onchange="document.getElementById('file_name_image').value = this.value.split('\\').pop().split('/').pop()">
                            </label>
                            <span class="asterisk_image_text" style="display:none; color:#63c6bd">* Field Required</span>
                        </div>
                        <div class="form-group pull-right">
                          <input type="submit" class="btn btn-primary background-blue" name="PUBLISH">
                        </div>
                      </form>
                      <div class="formbody">
                         <img src="{{asset('/frontend-assets/gif/loader.gif')}}" style="display:none; width: 13%;left: 43%;" class="loader" id="gifid">
                         <div class="form-group">
                           <div class="row" style="display: block;flex-wrap: wrap; margin-right: -15px;margin-left: -15px;">
                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                               <div class="dorgz" style="position: relative;height: 300px;">
                                 <form id='frmTargetText' name='dropzone' action="{{url('dashboard/imagepost')}}" class="dropzone" >{{ csrf_field() }}
                                 </form>
                                 <button type="button" class="btn btn-primary background-blue" id="buttonfreetext" style="float: right;margin-top: 58px;">Submit</button>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="image">
                      <form method="post" action="" enctype="multipart/form-data" id="freelistingForm">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <input type="text" name="post_title" id="imagetitledata" class="form-control required" placeholder="Title" required maxlength="130" onkeyup="imagetitle(this)">
                          <span class="asterisk"  style="display:none; color:#63c6bd">* Field Required</span>
                        </div>
                        <input type="hidden" name="section_id" value="{{$section_id}}">

                        <div class="input-field">
                          <label class="active">Photos</label>

                        </div>
                        <div class="form-group pull-left" style="margin-top: 196px;">
                            <input type="text" name="file_name_image" class="select-img" id="file_name_image" placeholder="Insert a cover image (mandatory)">
                            <label for="insert-cover">
                              <button class="btn btn-default image-btn">Insert</button>
                            <input type="file" class="required_image" name="cover_image" id="insert-image-gallery" class="required"  onchange="document.getElementById('file_name_image').value = this.value.split('\\').pop().split('/').pop()">
                            </label>
                            <span class="asterisk_image"  style="display:none; color:#63c6bd">* Field Required</span>
                        </div>

                      </form>
                       <div class="formbody">
                          <img src="{{asset('/frontend-assets/gif/loader.gif')}}" style="display:none; width: 13%;left: 43%;" class="loader" id="gifid">
                          <div class="form-group">
                            <div class="row" style="display: block;flex-wrap: wrap; margin-right: -15px;margin-left: -15px;">
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                                <div class="dorgz" style="position: relative;height: 300px;">
                                  <form id='frmTarget' name='dropzone' action="{{url('dashboard/imagepost')}}" class="dropzone" >{{ csrf_field() }}
                                  </form>
                                  <button type="button " class="btn btn-primary background-blue" id="buttonfreeimage" style="float: right;margin-top: 58px;">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="external_links">
                      @if ($errors->any())
                      <div class="alert alert-danger">
                         <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                         </ul>
                      </div>
                      @endif
                      <form method="post" action="" enctype="multipart/form-data" id="VideoForm">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <input type="text" name="post_title" id="videotitledata" class="form-control required3" placeholder="Title" required maxlength="130" onkeyup="imagetitle(this)">
                        <span class="asterisk"  style="display:none; color:#63c6bd">* Field Required</span>
                      </div>
                      <input type="hidden" name="section_id" value="{{$section_id}}">
                        <div class="input-field">
                          <label class="active">Video</label>
                        </div>
                        <div class="form-group pull-left" style="margin-top: 196px;">
                            <input type="text" name="" id="file_name_links" class="select-img" placeholder="Insert a cover image (mandatory)">
                            <label for="insert-cover">
                              <button class="btn btn-default image-btn">Insert</button>
                            <input type="file" class="required_image_video" name="cover_image" id="insert-video-cover" onchange="document.getElementById('file_name_links').value = this.value.split('\\').pop().split('/').pop()">
                            </label>
                            <span class="asterisk_image_video"  style="display:none; color:#63c6bd">* Field Required</span>
                        </div>
                        <div class="form-group pull-right">
                          <input type="submit" class="btn btn-primary background-blue" name="PUBLISH">
                        </div>
                      </form>
                      <div class="formbody">
                         <img src="{{asset('/frontend-assets/gif/loader.gif')}}" style="display:none; width: 13%;left: 43%;" class="loader" id="gifid">
                         <div class="form-group">
                           <div class="row" style="display: block;flex-wrap: wrap; margin-right: -15px;margin-left: -15px;">
                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                               <div class="dorgz" style="position: relative;height: 300px;">
                                 <form id='frmTargetVideo' name='dropzone' action="{{url('dashboard/imagepost')}}" class="dropzone" >{{ csrf_field() }}
                                 </form>
                                 <button type="button " class="btn btn-primary background-blue" id="buttonfreevideo" style="float: right;margin-top: 58px;">Submit</button>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script src="{{ asset('/frontend-assets/js/dropzone.js') }}"></script>
  <script src="{{asset('frontend-assets/dashboard/ckeditor/ckeditor.js')}}"></script>
  <script src="{{asset('frontend-assets/dashboard/ckeditor/js/sample.js')}}"></script>
  <script src="{{asset('frontend-assets/dashboard/ckeditor/js/sf.js')}}"></script>
<script src="{{ asset('frontend-assets/tinymce/tinymce.min.js') }}"></script>
<script>
tinymce.init({
  selector: '.tex-editor',
  statusbar: true,
  setup: function (editor) {
    editor.on('change', function () {
      editor.save();
    });
  },
  height: 200,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code',
    'charactercount'
  ],
  formats: {
    // Changes the default format for h1 to have a class of heading
    h1: { block: 'h1', classes: 'heading' },
	h2: { block: 'h2', classes: 'heading' },
	h3: { block: 'h3', classes: 'heading' },
	h4: { block: 'h4', classes: 'heading' },
	h5: { block: 'h5', classes: 'heading' }
  },
  style_formats: [
    // Adds the h1 format defined above to style_formats
    { title: 'Heading 1', format: 'h1' },
	{ title: 'Heading 2', format: 'h2' },
	{ title: 'Heading 3', format: 'h3' },
	{ title: 'Heading 4', format: 'h4' },
	{ title: 'Heading 5', format: 'h5' }
  ],
  toolbar: 'styleselect | bold italic | bullist numlist | link'
});
tinymce.PluginManager.add('charactercount', function (editor) {
  var self = this;
  function update() {
    editor.theme.panel.find('#charactercount').text(['Characters: {0}', self.getCount()]);
  }
  editor.on('init', function () {
    var statusbar = editor.theme.panel && editor.theme.panel.find('#statusbar')[0];
    if (statusbar) {
      window.setTimeout(function () {
        statusbar.insert({
          type: 'label',
          name: 'charactercount',
          text: ['Characters: {0}', self.getCount()],
          classes: 'charactercount',
          disabled: editor.settings.readonly
        }, 0);
        editor.on('setcontent beforeaddundo', update);
        editor.on('keyup', function (e) {
            update();
        });
      }, 0);
    }
  });
  self.getCount = function () {
    var tx = editor.getContent({ format: 'raw' });
    var decoded = decodeHtml(tx);
    // here we strip all HTML tags
    var decodedStripped = decoded.replace(/(<([^>]+)>)/ig, "").trim();
    var tc = decodedStripped.length;
    return tc;
  };
  function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
  }
});

function textteam(data){
  $("#imageteamdata").children('[value="'+data.value+'"]').attr('selected', true);
  $("#linkteamdata").children('[value="'+data.value+'"]').attr('selected', true);
}
function imageteam(data){
  $("#textteamdata").children('[value="'+data.value+'"]').attr('selected', true);
  $("#linkteamdata").children('[value="'+data.value+'"]').attr('selected', true);
}
function linkteam(data){
  $("#imageteamdata").children('[value="'+data.value+'"]').attr('selected', true);
  $("#textteamdata").children('[value="'+data.value+'"]').attr('selected', true);
}
function textrole(data){
  $("#imageroledata").children('[value="'+data.value+'"]').attr('selected', true);
  $("#linkroledata").children('[value="'+data.value+'"]').attr('selected', true);
}
function imagerole(data){
  $("#textroledata").children('[value="'+data.value+'"]').attr('selected', true);
  $("#linkroledata").children('[value="'+data.value+'"]').attr('selected', true);
}
function linkrole(data){
  $("#imageroledata").children('[value="'+data.value+'"]').attr('selected', true);
  $("#textroledata").children('[value="'+data.value+'"]').attr('selected', true);
}
// Title
function texttitle(data){
  // alert(data.value);
  $("#imagetitledata").val(data.value);
  $("#linktitledata").val(data.value);
}
function imagetitle(data){
  $("#texttitledata").val(data.value);
  $("#linktitledata").val(data.value);
}
function linktitle(data){
  $("#imagetitledata").val(data.value);
  $("#texttitledata").val(data.value);
}




Dropzone.options.frmTarget = {
autoProcessQueue: false,
 maxFiles: 1,
acceptedFiles: ".jpg,.png,.mp4,.mkv,.avi",
parallelUploads: 1,
addRemoveLinks: true,
url: "{{ url('dashboard/gallery/imagegallery')}}",
init: function () {

  var myDropzone = this;

  $("#buttonfreeimage").click(function (e) {
    //alert('hello');
    e.preventDefault();
    $(".asterisk").hide();
    var empty = $(".required").filter(function() { return !this.value; })
    .next(".asterisk").show();
    if(empty.length != 0){
      $("#empty_error").show();
      setTimeout(function () {
        $("#empty_error").hide();
      },5000);
    }

    if(empty.length) return false;   //uh oh, one was empty!
    $('.right').stop().animate({scrollTop: 0}, { duration: 1500, easing: 'easeOutQuart'});

    var check_empty = $('.required_image').val();
      if (check_empty.length ==0) {
        $(".asterisk_image").css('display','block');
        return false;
      }else {
        $(".asterisk_image").css('display','none');

      }

    var data = $('form#freelistingForm').serializeArray();
    console.log(data);
     myDropzone.on('sending', function(file, xhr, formData){
       for (var i=0; i<data.length; i++){
           formData.append(data[i].name, data[i].value);
       }
       formData.append('cover_image', $('#insert-image-gallery')[0].files[0]);
    //formData.append('userName', 'bob');
   });
    myDropzone.processQueue();



  });
  this.on("complete", function (file) {
      if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

        window.location.href = "{{url('/dashboard/gallery')}}";

      }
    });

 }
}

Dropzone.options.frmTargetText = {
autoProcessQueue: false,
 maxFiles: 1,
acceptedFiles: ".pdf",
parallelUploads: 1,
addRemoveLinks: true,
url: "{{ url('dashboard/gallery/imagegallery')}}",
init: function () {

  var myDropzone = this;

  $("#buttonfreetext").click(function (e) {
    // alert('hello');
    e.preventDefault();
    $(".asterisk").hide();
    var empty = $(".required2").filter(function() { return !this.value; })
    .next(".asterisk").show();
    if(empty.length != 0){
      $("#empty_error").show();
      setTimeout(function () {
        $("#empty_error").hide();
      },5000);
    }
    // alert(empty.length);
    if(empty.length) return false;   //uh oh, one was empty!
    $('.right').stop().animate({scrollTop: 0}, { duration: 1500, easing: 'easeOutQuart'});

    var check_empty = $('.required_image_text').val();
      if (check_empty.length ==0) {
        $(".asterisk_image_text").css('display','block');
        return false;
      }else {
        $(".asterisk_image_text").css('display','none');

      }

    var data = $('form#TextForm').serializeArray();
    console.log(data);
     myDropzone.on('sending', function(file, xhr, formData){
       for (var i=0; i<data.length; i++){
           formData.append(data[i].name, data[i].value);
       }
       formData.append('cover_image', $('#insert-image-text')[0].files[0]);
    //formData.append('userName', 'bob');
   });
    myDropzone.processQueue();



  });
  this.on("complete", function (file) {
      if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

        window.location.href = "{{url('/dashboard/gallery')}}";

      }
    });

 }
}


Dropzone.options.frmTargetVideo = {
autoProcessQueue: false,
 maxFiles: 1,
acceptedFiles: ".mp4,.mkv,.avi",
parallelUploads: 1,
addRemoveLinks: true,
url: "{{ url('dashboard/gallery/imagegallery')}}",
init: function () {

  var myDropzone = this;

  $("#buttonfreevideo").click(function (e) {
    // alert('hello');
    e.preventDefault();
    $(".asterisk").hide();
    var empty = $(".required3").filter(function() { return !this.value; })
    .next(".asterisk").show();
    if(empty.length != 0){
      $("#empty_error").show();
      setTimeout(function () {
        $("#empty_error").hide();
      },5000);
    }
    // alert(empty.length);
    if(empty.length) return false;   //uh oh, one was empty!
    $('.right').stop().animate({scrollTop: 0}, { duration: 1500, easing: 'easeOutQuart'});

    var check_empty = $('.required_image_video').val();
      if (check_empty.length ==0) {
        $(".asterisk_image_video").css('display','block');
        return false;
      }else {
        $(".asterisk_image_video").css('display','none');

      }

    var data = $('form#VideoForm').serializeArray();
    console.log(data);
     myDropzone.on('sending', function(file, xhr, formData){
       for (var i=0; i<data.length; i++){
           formData.append(data[i].name, data[i].value);
       }
       formData.append('cover_image', $('#insert-video-cover')[0].files[0]);
    //formData.append('userName', 'bob');
   });
    myDropzone.processQueue();



  });
  this.on("complete", function (file) {
      if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

        window.location.href = "{{url('/dashboard/gallery')}}";

      }
    });

 }
}


  $('.nav-tabs').on('click', 'li', function() {
      $('.nav-tabs li.active').removeClass('active');
      $(this).addClass('active');
  });
</script>
@endsection
