<?php require_once $abs_us_root.$us_url_root.'users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//PHP Goes Here!
$errors = [];
$successes = [];
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
//Forms posted
if(!empty($_POST))
{
  $token = $_POST['csrf'];
if(!Token::check($token)){
  die('Token doesn\'t match!');
}
  $deletions = $_POST['delete'];
  if ($deletion_count = deleteUsers($deletions)){
    $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
  }
  else {
    $errors[] = lang("SQL_ERROR");
  }
}

$userData = fetchAllUsers(); //Fetch information for all users

$userData = array_sort($userData, 'surname', SORT_DESC); // Sort by surname


?>
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">

	    <div class="col-xs-12 col-md-6">
		<h1>LeaderBoard</h1>
	  </div>

	  <div class="col-xs-12 col-md-6">
			
		  </div>

        </div>


				 <div class="row">
		     <div class="col-md-12">
          <?php echo resultBlock($errors,$successes);


				?>

							 <hr />
				 <div class="alluinfo">&nbsp;</div>
				<form name="adminUsers" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				 <div class="allutable table-responsive">
					<table class='table table-hover table-list-search'>
					<thead>
					<tr>
						<th>First Name</th><th>Last Name</th><th>Points</th>
					 </tr>
					</thead>
				 <tbody>
					<?php
					//Cycle through users
					foreach ($userData as $v1) {
							?>
					<tr>
					<td><?=$v1->fname?></td>
					<td><?=$v1->lname?></td>
					<td><?=$v1->points?></td>
					</tr>
							<?php } ?>

				  </tbody>
				</table>
				</div>

					<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
				
				</form>

		  </div>
		</div>


  </div>
</div>


	<!-- End of main content section -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
