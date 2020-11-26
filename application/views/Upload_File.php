<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/dropzone/dropzone.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone/dropzone.min.js"></script>

<form action="<?php echo base_url('index.php/upload_file/dragDropUpload/'); ?>" class="dropzone">
<div>
  
</div>
</form>
<?php
if(!empty($files)){ foreach($files as $row){?>
  <a href="../index.php/upload_file/deletefile/<?php echo $row['id']?>">Remove file</a>
<?php
        $filePath = 'uploads/'.$row["file_name"];
        $fileMime = mime_content_type($filePath);
?>
    <embed src="<?php echo base_url('uploads/'.$row["file_name"]); ?>" type="<?php echo $fileMime; ?>" width="200px" height="200px" />
<?php
} }else{
?>
    <p>No file(s) found...</p>
<?php } ?>
