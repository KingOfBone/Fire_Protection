<script>
            function callResize()
            {
                var height = document.body.scrollHeight;
                parent.resizeIframe(height);
				parent.window.top.location.reload;
            }
            window.onload =callResize;
        </script>	
<?php
$noinvoice=$_GET['nopinjam']; ?>
<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
<iframe  src="assets/mpdf/cetakinvoice.php?noinvoice=<?php echo $noinvoice; ?>" frameborder=no width='100%' height='500'  >
</iframe>
</div></div></div>