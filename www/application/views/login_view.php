<section class="card">

  <div class="card__header">
    <h1>Please login...</h1>
  </div>

  <form action="<?php base_url(); ?>login/validate" method="post" accept-charset="utf-8" class="card__body" id="login-form">

    <?php if($message!=null) :?>

    <div class='error'><?php echo $message; ?></div>

    <?php endif; ?>


      <p>
        <input type="text" name="username" placeholder="Username" autofocus="autofocus" />
      </p>

      <p>
        <input type="password" name="password" placeholder="Password" />
      </p>

      <p><input type="submit" name="submit" value="Login" /></p>

  </form>
</section>
