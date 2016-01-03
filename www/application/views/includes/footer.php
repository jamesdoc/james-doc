    </section> <?php /* end .container */ ?>

    <footer>

        <ul class="social">
            <li class="social__icon social__icon--twitter"><a href="http://www.twitter.com/jamesdoc" target="_blank">Twitter</a></li>
            <li class="social__icon social__icon--instagram"><a href="http://www.instagram.com/thejamesdoc" target="_blank">Instagram</a></li>
            <li class="social__icon social__icon--lastfm"><a href="http://www.last.fm/user/jamesdoc" target="_blank">Last.fm</a></li>
        </ul>

    	<small>
    		Design and build by James Doc &middot;
    		<? if ($this->session->userdata('username')) {
	        	echo anchor('logout','Logout');
	        } else {
		        echo anchor('login','Login');
		    } ?>
		</small>
    </footer>

	<script src="<?=site_url('assets/script.js');?>"></script>

	<script>
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script>
        try {
       		var pageTracker = _gat._getTracker("UA-8852329-10");
       		pageTracker._trackPageview();
        } catch(err) {}
    </script>

</body>

</html>
