<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

<!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->

<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<link href="<?php echo $this->config->item('admin_css_path');?>alertify.core.css" rel="stylesheet">

<link href="<?php echo $this->config->item('admin_css_path');?>alertify.bootstrap.css" rel="stylesheet">

<link href="<?php echo $this->config->item('admin_css_path');?>alertify.default.css" rel="stylesheet">

<script src="<?php echo $this->config->item('admin_js_path');?>/alertify.min.js"></script>
<script>
	jQuery(document).ready(function(){ 
		jQuery(".pagination li a").click(function(e){ 
			document.getElementById('approve_champion_form').action = jQuery(this).attr('href');
			jQuery('#approve_champion_form').submit();   
			e.preventDefault();
		});
	});
	
	function page_count_check(){
		 document.getElementById("approve_champion_form").submit();
	}
</script>
<style>
	.table-bordered th{padding:10px !important;}
	.table-bordered td{padding:10px !important;}
	.pag{text-align: left;}
</style>
<script>

	$(".nav-tabs").tabs({
        select: function(event, ui) {            

            window.location.hash = ui.tab.hash;

        }
    });			

	function confirmAction(status,a_element, message, action){	

		alertify.confirm(message, function(e) {

			if (e) {

				// a_element is the <a> tag that was clicked

				if (action) {

					action(status,a_element);

				}

			}

		});

	}	

	

	function changeStatus(status,result){		

		$.ajax({

			type: "POST",

			dataType: 'json',

			url: '<?php echo $this->config->item('update_fundraising_status');?>',

			data: "champion_id="+result+"&status="+status,

			success: function(Rid1) {

				if (Rid1) {

					location.reload();

					alertify.success("status updated successfully");

				}else{					

					alertify.error("error in updating status");

				}

			}

		}); 

	}

			

	function reset(){

		$("#toggleCSS").attr("href", "<?php echo $this->config->item("admin_css_path");?>/alertify.default.css");

		alertify.set({

		   labels : {

			  ok     : "OK",

			  cancel : "Cancel"

		   },

				

		   delay : 5000,

		   buttonReverse : true,

		   buttonFocus   : "ok"

		});

    }

</script>

<script>

      function load_sub_event_by_event_id(parent){

		 

		if(parent.value != ""){

			$("#select_sub_event").load("<?php echo $this->config->item("load_sub_event_by_event_id");?>?event_id=" + parent.value);

		}else{

			 $('#select_sub_event option').remove();

		}

        

      }



      </script>

         <?php if((isset($_POST['eid']))){
					$eid=$_POST['eid'];
                   if(isset($_POST['sub_eid'])){
					   $sub_id = $_POST['sub_eid'];
				   }else{
					   $sub_id = "";
				   }
				}else{
					$eid='';
					$sub_id='';
                }
          ?>


	<div class="content">
		<!-- Kode-Header End -->
		<div class="sub-header">
			<!-- SUB HEADER -->
		</div>

		<!-- Kode-Slider End -->
		<!--Kode-our-speaker-heading start-->
		<div class="Kode-page-heading">

			<div class="container">
			<!--ROW START-->
				<div class="row">

					<div class="col-md-6 col-sm-6">

						<h2>Manage Champions</h2>

					</div>
					
				</div>







				<!--ROW END-->







			</div>







		</div>







		<!--Kode-our-speaker-heading End-->







		<div class="kode-blog-style-2 search_table" style="min-height:500px;">
		  <div class="container">

          <div class="row" style="margin-bottom:0px;"> 

                  

                    <form method="post" action="" id="approve_champion_form" name="approve_champion_form">

					<div class="col-sm-3">				

						<select class="form-control dropdown" id="event_list" onchange="load_sub_event_by_event_id(this)" name="eid">                    

						   <option value="">-- Select Event--</option>

                       

                        <?php foreach($event_list as $list){?>



                                  <option  <?php if($eid == $list['id']){ echo "selected";}?> value="<?php echo $list['id']; ?>"><?php echo $list['title']; ?></option>

                        <?php } ?>
						</select>                                     

                    </div>

                     <div class="col-sm-3">

                    <select class="form-control dropdown" id="select_sub_event" name="sub_eid">

                       	<?php if(!isset($_POST['sub_eid'])){ ?>
								 <option value="">No event available</option>
						<?php }  if(!empty($get_sub_event_details)){ 
								 foreach($get_sub_event_details as $sub_evento){ ?>
									 <option value="<?php echo $sub_evento['id'];?>" <?php if(isset($_POST['sub_eid'])){ echo 'selected'; }else{ echo ''; }; ?>><?php echo $sub_evento['schedule_title'];?></option>

								<?php	}								
								 } ?>
                     </select>                       

                    </div>   

					<div class="col-sm-3">				

						<select class="form-control dropdown" id="event_list"  name="e_status">                    

                            <option value="">-- All --</option>

                            <option value="1" <?php if((isset($_POST['e_status']) && ($_POST['e_status'] == "1"))){ echo "selected";}else{echo "";}?>>Approved</option>

                            <option value="0" <?php if((isset($_POST['e_status']) && ($_POST['e_status'] == "0"))){ echo "selected";}else{echo "";}?>>Pending</option>

                            <option value="2" <?php if((isset($_POST['e_status']) && ($_POST['e_status'] == "2"))){ echo "selected";}else{echo "";}?>>Declined</option>           

                         </select>                                     

                     </div>

					 <div class="col-md-3 col-sm-3">   
						<button class="blue_box_title" type="submit" style="padding: 9px 20px;margin-bottom:15px;">Search</button> 
				  
		<button onclick ="go_to_location();" class="blue_box_title" type="button" style="padding: 9px 20px;margin-bottom:15px;margin-left:6px;" >Reset</button> 
					</div>
                

                 </div>  
				 
                <div class="row" style="margin-bottom:0px;">
				<div class="col-sm-1">
					<label style="padding:10px;">Records</label>
				</div>
				<div class="col-sm-2">				
                    <select class="form-control dropdown" id="per_page" name="per_page" onchange="page_count_check();">
						<option value="5" <?php if($page_count  == '5'){ echo " selected";}else{ echo "";}?>>5</option>
						<option value="10" <?php if($page_count  == '10'){ echo " selected";}else{ echo "";}?>>10</option>
						<option value="20" <?php if($page_count  == '20'){ echo " selected";}else{ echo "";}?>>20</option>
						<option value="30" <?php if($page_count  == '30'){ echo " selected";}else{ echo "";}?>>30</option>
						<option value="40" <?php if($page_count  == '40'){ echo " selected";}else{ echo "";}?>>40</option>
						<option value="50" <?php if($page_count  == '50'){ echo " selected";}else{ echo "";}?>>50</option>
			</select>
                </div>
            </div>

			
</form>
                <div class="row">

                <div class="col-md-12">

                <div class="table-responsive">

                <table class="table table-bordered">

                <thead>

                <tr>

                <th>Id</th>
                <th>Title</th>
                <th>Display Name</th>
                <th>Event Name</th> 
				<th>Raised Amount</th>
                <th>Target Amount</th>
                <th>Status</th>
                <th>Action</th>
                </tr>

                </thead>

                <tbody>
                <?php 
					if(count($data) > 0){
					$i=0;
				foreach($data as $get_value){ 
			/* 		
					echo "<pre>";
					print_r($get_value);
					 */
					
					if($i % 2 == 0) {	
						$class = "even";
					}else{	
						$class="odd";
					}
					$i++;
				?>
                <tr class="<?php echo $class;?>">
					<td><?php echo $get_value['id']; ?></td>
					<td><?php echo $get_value['champ_title']; ?></td>
					<td><?php echo $get_value['display_name']; ?></td>
					<td><?php echo $get_value['title']; ?></td>
					<td></td>
					<td><?php echo $get_value['target_amount']; ?></td>
					<?php if($get_value['champ_status'] == 0){ ?>
					<td>Pending</td>
					<?php }else if($get_value['champ_status'] == 1){ ?>
                    <td>Approved</td>
                    <?php }else if($get_value['champ_status'] == 2){?>
						<td>Declined</td>
					<?php } ?>
					<td><a target="_blank" href="<?php echo base_url(); ?>index.php/frontend/champion/view_fundraising/<?php echo $get_value['id']; ?>">View</a> | 
                    <?php if($get_value['champ_status'] == 0 || $get_value['champ_status'] == 2){?>
					<a onclick="confirmAction('approve',<?php echo $get_value['id'];?>, 'Do you want to approve this champion request ?', changeStatus); return false;" href="">Approve</a>
                    <?php }else{ ?>
                    <a onclick="confirmAction('decline',<?php echo $get_value['id'];?>, 'Do you want to decline this champion request ?', changeStatus); return false;" href="">Decline</a>
                    <?php } ?>

					</td>

                </tr>
					<?php } }else{ ?>
						<tr><td colspan="8"><?php echo "No champions are available";?></td></tr>
					<?php } ?>

				

                </tbody>

                </table>

                </div>

                </div>

                </div>
				
				<div class="pag">
                   <div class="col-md-12">
						<?php echo $this->pagination->create_links(); ?>
                   </div>
                   </div>
          </div>				

          </div>







     </div>







     </div><!--Content-->


<style>
	.odd{background:#f9f9f9;}
  .even{background:#ffffff;}
</style>

<script>
	function go_to_location(){
		window.location = "<?php echo $this->config->item('base_url');?>index.php/frontend/champion/approve_champions_list";		
	}
</script>
<?php if(isset($_POST)){ ?>
<script>
	$(document).ready(function(){
		var post_event_id = "<?php echo $_POST['eid']; ?>";
		var post_subevent_id = "<?php echo $_POST['sub_eid']; ?>";
		
		get_subs(post_event_id,post_subevent_id);
        function get_subs(post_event_id,post_subevent_id){
			if(post_event_id != ""){
				$("#select_sub_event").load("<?php echo base_url(); ?>frontend/events/get_subs/"+post_event_id+"/"+post_subevent_id);
          	}else{
				$('#select_sub_event option').remove();
			}
		}
	});
</script>
<?php } ?>