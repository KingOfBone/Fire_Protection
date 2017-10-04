<script>
            function callResize()
            {
                var height = document.body.scrollHeight;
                parent.resizeIframe(height);
				parent.window.top.location.reload;
            }
            window.onload =callResize;
        </script>		

<iframe  src="manual.pdf" frameborder=no width='100%' height='550'  ></iframe>
