<p><img class="alignnone" src="<?= $path ?>images/logo_contact.png" alt="Contesto" width="350" height="116" /><br />
<strong><?= tr('Contesto Translations') ?></strong><br />
Heinrichstrasse 32<br />
8005 <?= tr('Zurich') ?><br />
<?= tr('Switzerland') ?></p>
<p><img src="<?= $path ?>images/contact_mail.gif" alt="phone" /> 044 271 36 65<br />
<img src="<?= $path ?>images/contact_fax.gif" alt="fax" /> 044 271 36 65<br />
<img src="<?= $path ?>images/contact_mail.gif" alt="mail" /> <a href="mailto:traduzioni@contesto.ch">traduzioni@contesto.ch</a></p>

<h6><?= tr('Contact form') ?></h6>

<form action="" method="post" class="contactForm form" id="contact_form">

<p class="contact_honey">
<label for="<?= $post_prefix ?>honeypot">Leave this field blank if you're human</label><br>
<input type="text" name="<?= $post_prefix ?>honeypot" id="<?= $post_prefix ?>honeypot" class="text-field" placeholder="">
</p>

<p><strong><?= tr('Name') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>name" class="required" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong>E-mail</strong></p>
<p><input type="text" name="<?= $post_prefix ?>email" class="required" id="<?= $post_prefix ?>email" value="" /></p>

<p><strong><?= tr('Subject') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>subject" id="<?= $post_prefix ?>subject" value="" /></p>

<p><strong><?= tr('Message') ?></strong></p>
<p><textarea  class="required" name="<?= $post_prefix ?>message" id="<?= $post_prefix ?>message" rows="" cols=""></textarea></p>

<p>* = <?= tr('Required field') ?></p>

<p><input type="submit" value="<?= tr('Submit') ?>" class="submit submitTheme" name="<?= $post_prefix ?>submit" id="<?= $post_prefix ?>submit" />
</p>
</form>
