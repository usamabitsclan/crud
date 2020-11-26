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
  var path = "<?php echo base_url('Uploaads/');?>";
  var path1 = "<?php echo base_url('Uploaads/1.jpeg');?>";
  var path2 = "<?php echo base_url('Uploaads/2.jpeg');?>";
  var path3 = "<?php echo base_url('Uploaads/Laravel-best-PHP-Framework-1568x1045 (1) (1).jpg');?>";
  var path4 = "<?php echo base_url('Uploaads/4.jpeg');?>";


  Dropzone.autoDiscover = false; // otherwise will be initialized twice
  var myDropzoneOptions = {
      maxFilesize: 5,
      addRemoveLinks: true,
      removedfile: function(file) {
         var fileName = file.name;
         //var id = data[i].id;
         //alert(id);

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
      //dictRemoveFile: "Delete",
      //dictCancelUploadConfirmation: "Are you sure to cancel upload?",
  };


            $.ajax({
              type: 'POST',
              url: 'getimages',
              dataType: 'json',
              success: function(data){
                //console.log(data);
                // data.forEach((id,file_name,array) => {
                //   console.log('Index: ' + id + ' Value: ' + file_name + array);
                // });

                // Object.keys(data).forEach(function (item) {
	              //    console.log(item); // key
	              //     console.log(data[item]); // value
                //
                //
                //   });

                  // for(let key in data) {
                  //   console.log(key);
                  //   console.log(data[key]);
                  // }
                  //
                  // Object.keys(data).forEach(function(key) {
                  //   console.log(key, data[key]);
                  // });
                for (var i = 0; i < data.length; i++) {
                    console.log("http://localhost/crud/Uploaads"+data[i].file_name);
                    var temp = { name: data[i].file_name, dataURL: "http://localhost/crud/Uploads/"+data[i].file_name};
                    myDropzone.files.push(temp);
                    myDropzone.emit("addedfile", temp);
                    createThumbnail(temp);
                  }



                // foreach($arr as $key=>$value){
                //     if(is_array($value)){
                //         printValues($value);
                //         } else{
                //             $values[] = $value;
                //             $count++;
                //           }
                //         }
                //var dataa = json_decode(data);
                //let mockFile = { name: data.file_name, size: 12345 };
                //myDropzone.displayExistingFile(mockFile, 'https://image-url');
              //alert(data);
                 //console.log(dataa);
                 //myDropzone.createThumbnailFromUrl(mockFile, data);
                //  for (var i = 0; i < data.length; i++) {
                //    //var temp = { name: data[i].[file_name], dataURL: <?php echo base_url('Uploaads/');?>data[i].[file_name] };
                //    myDropzone.files.push(temp);
                //    myDropzone.emit("addedfile", temp);
                //    createThumbnail(temp);
                // }
              }
            });

  var myDropzone = new Dropzone('#myDropzoneElement', myDropzoneOptions);
  var mockFile = { name: "image", size: 12345,  dataURL: path3 };

  // myDropzone.emit("addedfile", mockFile);
  // createThumbnail(mockFile);



  function createThumbnail(temp) {
      myDropzone.createThumbnailFromUrl(temp,
          myDropzone.options.thumbnailWidth,
          myDropzone.options.thumbnailHeight,
          myDropzone.options.thumbnailMethod, true, function (thumbnail) {
              myDropzone.emit('thumbnail', temp, thumbnail);
              myDropzone.emit("complete", temp);
          });



  }


  // mockFile.previewElement.classList.add('dz-success');
  // mockFile.previewElement.classList.add('dz-complete');
  //
  //
  //
  // myDropzone.options.addedfile.call(myDropzone, mockFile);
  // myDropzone.options.thumbnail.call(myDropzone, mockFile, path);
  // mockFile.previewElement.classList.add('dz-success');
  // mockFile.previewElement.classList.add('dz-complete');
  //
  // myDropzone.options.addedfile.call(myDropzone, mockFile);
  // myDropzone.options.thumbnail.call(myDropzone, mockFile, path1);
  // mockFile.previewElement.classList.add('dz-success');
  // mockFile.previewElement.classList.add('dz-complete');
  //
  // myDropzone.options.addedfile.call(myDropzone, mockFile);
  // myDropzone.options.thumbnail.call(myDropzone, mockFile, path2);
  // mockFile.previewElement.classList.add('dz-success');
  // mockFile.previewElement.classList.add('dz-complete');
  //
  // myDropzone.options.addedfile.call(myDropzone, mockFile);
  // myDropzone.options.thumbnail.call(myDropzone, mockFile, path3);
  //
  // mockFile.previewElement.classList.add('dz-success');
  // mockFile.previewElement.classList.add('dz-complete');
  // myDropzone.emit("addedfile", mockFile);
  //myDropzone.emit("pexels-arshad-sutar-1749303.jpg", mockFile);

  //myDropzone.createThumbnailFromUrl(mockFile, '/pexels-arshad-sutar-1749303.jpg');




  //
  // Dropzone.options.dropzone = {
  //     paramName: 'NewImages',
  //     autoProcessQueue: false,
  //     uploadMultiple: true,
  //     parallelUploads: 100,
  //     maxFiles: 100,
  //     init: function () {
  //         var myDropzone = this;
  //
  //         //Populate any existing thumbnails
  //         if (thumbnailUrls) {
  //             for (var i = 0; i < thumbnailUrls.length; i++) {
  //                 var mockFile = {
  //                     name: "myimage.jpg",
  //                     size: 12345,
  //                     type: 'image/jpeg',
  //                     status: Dropzone.ADDED,
  //                     url: thumbnailUrls[i]
  //                 };
  //
  //                 // Call the default addedfile event handler
  //                 myDropzone.emit("addedfile", mockFile);
  //
  //                 // And optionally show the thumbnail of the file:
  //                 myDropzone.emit("thumbnail", mockFile, thumbnailUrls[i]);
  //
  //                 myDropzone.files.push(mockFile);
  //             }
  //         }
  //
  //         this.on("removedfile", function (file) {
  //             // Only files that have been programmatically added should
  //             // have a url property.
  //             if (file.url && file.url.trim().length > 0) {
  //                 $("<input type='hidden'>").attr({
  //                     id: 'DeletedImageUrls',
  //                     name: 'DeletedImageUrls'
  //                 }).val(file.url).appendTo('#image-form');
  //             }
  //         });
  //     }
  // });
  //
  //
  //

  </script>
 </body>
</html>
