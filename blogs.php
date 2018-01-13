    <?php
  // Alle Blogs bzw. Benutzernamen holen und falls Blog bereits ausgewählt, entsprechenden Namen markieren
  // Hier Code....

  // Schlaufe über alle Blogs bzw. Benutzer
  // Hier Code....

  // Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blogs und der Ausgabe mit PHP ersetzt werden
  $blogs = getUserNames();
  //var_dump($blogs);
    ?>
    <div class="container">
    <?php

  foreach ($blogs as $blog)
  {
      if($blog['name'] != 'admin' && $blog['name'] != 'name') {
          if ($blog['uid'] == $blogId) {
              echo "<a href='index.php?function=blogs&bid=" . $blog['uid'] . "' title='Blog auswählen' style='color:white;'><div class='container' style='margin-top:80px;display:inline;'>
                <div class='card text-white bg-dark mb-3'  style='width:40rem;height:15rem;margin: 2rem;float: left;'>
      		        <div class='card-header'>" . $blog['name'] . "</div>
      		        <div class='card-body'>
      			        <p class='card-text'>Dies ist der Blog von " . $blog['name'] . "</p>
      		        </div>
      	        </div>
      	    </a>";
          } else {
              echo "<a href='index.php?function=blogs&bid=" . $blog['uid'] . "' title='Blog auswählen' style='color:black;'><div class='container' style='margin-top:80px;display:inline;'>
      	<div class='card text-black mb-3'  style='width:40rem;height:15rem;margin:2rem;float: left;'>
      		<div class='card-header'>" . $blog['name'] . "</div>
      		<div class='card-body'>
      			<p class='card-text'>Dies ist der Blog von " . $blog['name'] . "</p>
      		</div>
      	</div></a>";
          }
      }
  }
?>
    </div>
<!--
<div class="jumbotron">
  <h1 class="display-3">Hello, world!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>

<div class="container" style="margin-top:80px">
	<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
		<div class="card-header">Header</div>
		<div class="card-body">
			<h4 class="card-title">Primary card title</h4>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>-->
<!--	<div><a href='index.php?function=blogs&bid=4' title='Blog auswählen'><h4>Anna Abegglen</h4></a></div>
	<div><a href='index.php?function=blogs&bid=2' title='Blog auswählen'><h4>Hans Hinterseer</h4></a></div>
	<div><a href='index.php?function=blogs&bid=1' title='Blog auswählen'><h4>Marc Muster</h4></a></div>
	<div><a href='index.php?function=blogs&bid=3' title='Blog auswählen'><h4>Sonja Sauser</h4></a></div> -->
