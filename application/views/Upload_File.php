<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/dropzone/dropzone.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone/dropzone.min.js"></script>

<form action="<?php echo base_url('index.php/upload_file/dragDropUpload/'); ?>" class="dropzone"></form>
<?php
if(!empty($files)){ foreach($files as $row){
        $filePath = 'uploads/'.$row["file_name"];
        $fileMime = mime_content_type($filePath);
?>
    <embed src="<?php echo base_url('uploads/'.$row["file_name"]); ?>" type="<?php echo $fileMime; ?>" width="350px" height="240px" />
<?php
} }else{
?>
    <p>No file(s) found...</p>
<?php } ?>
