<?php
//include ('/srv/www/htdocs/login/login.php');
session_start();
if (!isset($_SESSION['hiiripippeli'])){
	die();
}
include_once ('functions.php');
$_SESSION['temphakemisto_short']=getTempDir();
$short=$_SESSION['temphakemisto_short'];
$_SESSION['temphakemisto']=create_temp_dir($_SESSION['temphakemisto_short']);
$long=$_SESSION['temphakemisto'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
                var swfu;

                window.onload = function() {
                        var settings = {
                                flash_url : "swfupload_f9.swf",
                                upload_url: "upload.php?<?php echo "HAKEMISTO=".$_SESSION['temphakemisto_short']; ?>",// Relative to the SWF file
                                post_params: {"HAKEMISTO" : "<?php echo $_SESSION['temphakemisto_short']; ?>"},
                                file_size_limit : "100 MB",
                                file_types : "*.*",
                                file_types_description : "All Files",
                                file_upload_limit : 100,
                                file_queue_limit : 0,
                                custom_settings : {
                                        progressTarget : "fsUploadProgress",
                                        cancelButtonId : "btnCancel"
                                },
                                debug: false,

				// Button settings
                                button_image_url: "images/nappi.png",     // Relative to the Flash file
                                button_width: "65",
                                button_height: "29",
                                button_placeholder_id: "spanButtonPlaceHolder",
                                button_text: '<span class="theFont">Lataa</span>',
                                button_text_style: ".theFont { font-size: 16; }",
                                button_text_left_padding: 12,
                                button_text_top_padding: 3,
	
                                // The event handler functions are defined in handlers.js
                                file_queued_handler : fileQueued,
                                file_queue_error_handler : fileQueueError,
                                file_dialog_complete_handler : fileDialogComplete,
                                upload_start_handler : uploadStart,
                                upload_progress_handler : uploadProgress,
                                upload_error_handler : uploadError,
                                upload_success_handler : uploadSuccess,
                                upload_complete_handler : uploadComplete,
                                queue_complete_handler : queueComplete  // Queue plugin event
                        };

                        swfu = new SWFUpload(settings);
             };
        </script>

<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Kuvien_valinta</title>
</head>
<body>
<table style="width: 80%;" cellpadding="2" cellspacing="2" align="center">
  <tbody>
    <tr>
      
      <td style="text-align: center; background-color: rgb(0, 102, 0); color: rgb(153, 153, 0);" align="center"><big><big><big>Kuvien vienti</big></big></big></td>
      
    </tr>
    <tr>
      
      <td align="center">
      
        <form id="form1" action="kuvien_valinta.php" method="post" enctype="multipart/form-data">
                <fieldset class="flash" id="fsUploadProgress">
                        <legend>Ylöslataus-pötkö</legend>
                        </fieldset>
                <div id="divStatus">0 Tiedostoa ylösladattu</div>
                        <div>
                                 <span id="spanButtonPlaceHolder"></span>
                                <input id="btnCancel" type="button" value="Peruuta kaikki ylöslataukset" onclick="swfu.cancelQueue();" disabled="disabled" style="font-size: 8pt;" />
                        </div>
 

        </form>


<form method="get" action="duunaa.php" name="duunaa">
<input name="duunaa" value="Viedääs kikkareet tsydeemiin..." type="submit">
</form><br><br>
HUOM! Mene eteenpäin vasta kun kuvat on uploadattu....

            </td>
      
          </tr>
        
      
  </tbody>
</table>
<br>
</body>
</html>
