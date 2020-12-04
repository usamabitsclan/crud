<!doctype html>
<html>
 <head>
  <!-- CSS -->
  <!-- <link href="style.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css



" />

  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js



"></script>


 </head>
 <body >
   <p>DROP ZONE</p>

  <div class="container" >
   <div class='content'>
    <!-- <form action="uploadphp" class="dropzone" id="dropzonewidget">

    </form> -->
    <form action="<?php echo base_url('index.php/upload_file/dragDropUpload/'); ?>" id="myDropzoneElement" class="dropzone"></form>

   </div>
  </div>
  <script>
//  var path3 = "<?php echo base_url('Uploaads/Laravel-best-PHP-Framework-1568x1045 (1) (1).jpg');?>";


  Dropzone.autoDiscover = false; // otherwise will be initialized twice
  var myDropzoneOptions = {
      maxFilesize: 5,
      addRemoveLinks: true,
      removedfile: function(file) {
         var fileName = file.name;
         $.ajax({
           type: 'POST',
           url: 'removedropzone',
           data: {name: fileName ,request: 'delete'},
           success: function(data){
              console.log('success: ' + data);
           }
         });

         var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
       },
      clickable: true
  };


            $.ajax({
              type: 'POST',
              url: 'getimages',
              dataType: 'json',
              success: function(data){

                for (var i = 0; i < data.length; i++) {
                    console.log("http://localhost/crud/Uploaads"+data[i].file_name);
                    var temp = { name: data[i].file_name, dataURL: "http://localhost/crud/Uploads/"+data[i].file_name};
                    myDropzone.files.push(temp);
                    myDropzone.emit("addedfile", temp);
                    createThumbnail(temp);
                  }

              }
            });

  var myDropzone = new Dropzone('#myDropzoneElement', myDropzoneOptions);
//  var mockFile = { name: "image", size: 12345,  dataURL: path3 };

  function createThumbnail(temp) {
      myDropzone.createThumbnailFromUrl(temp,
          myDropzone.options.thumbnailWidth,
          myDropzone.options.thumbnailHeight,
          myDropzone.options.thumbnailMethod, true, function (thumbnail) {
              myDropzone.emit('thumbnail', temp, thumbnail);
              myDropzone.emit("complete", temp);
          });



  }

  </script>
 </body>
</html>
