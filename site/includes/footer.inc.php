<?php
/**
 * footer.inc.php
 * Pied de page pour le site de repas…
 * programmé par Antony Garand
 * le 23 septembre 2015
 */
?>
<?php 
if(!empty($conn)){
    @$conn->close();
}
?>
<!-- Footer -->
<div class="footer">
  <div class="container">
    <p class="pull-left">Antony Garand 2015</p>
    <p class="pull-right"><a href="#myModal" role="button" data-toggle="modal"> <i class="icon-mail"></i> CONTACT</a></p>
  </div>
</div>
<!-- Contact form in Modal -->
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&Atilde;—</button>
    <h3 id="myModalLabel"><i class="icon-mail"></i> Contact Me</h3>
  </div>
  <div class="modal-body">
    <form>
      <input type="text" placeholder="Yopur Name">
      <input type="text" placeholder="Your Email">
      <input type="text" placeholder="Website (Optional)">
      <textarea rows="3" style="width:80%"></textarea>
      <br/>
      <button type="submit" class="btn btn-large"><i class="icon-paper-plane"></i> SUBMIT</button>
    </form>
  </div>
</div>
<!-- Scripts -->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="includes/js/bootstrap.min.js"></script>
<script src="includes/js/script.js"></script>
</body>
</html>
