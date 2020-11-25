<!doctype html>
<html>
 <head>
  <!-- CSS -->
  <!-- <link href="style.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/dropzone/dropzone.min.css" />

  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone/dropzone.min.js"></script>

 </head>
 <body >
  <div class="container" >
   <div class='content'>
    <form action="uploadphp" class="dropzone" id="dropzonewidget">

    </form>
   </div>
  </div>
  <script>
  Dropzone.autoDiscover = false;
$(".dropzone").dropzone({
 addRemoveLinks: true,
 removedfile: function(file) {
   var name = file.name;

   $.ajax({
     type: 'POST',
     url: 'uploadphp',
     data: {name: name,request: 2},
     sucess: function(data){
        console.log('success: ' + data);
     }
   });
   var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
 }
});
  </script>
 </body>
</html>
