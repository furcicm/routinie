<script type='text/javascript' src="../js/planner.js"></script>
<div id="lightbox-panel">
    <h2>For how many years you want to make your plans?</h2>
    <input type="text" class="lightbox-input-years" name="lightbox-years"/><br />
    <div class="lightbox-ok lightbox-button">Ok</div>
    <a href="/?q=planner"><div class="lightbox-cancel lightbox-button close-panel">Cancel</div></a>
</div><!-- /lightbox-panel -->
<div id="lightbox"></div><!-- /lightbox -->
<script>
  $('div#feedback').remove();
  $("#lightbox, #lightbox-panel").fadeIn(300);
	$('.lightbox-input-years').focus();
</script>


 



