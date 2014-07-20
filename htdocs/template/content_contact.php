<p><img class="alignnone" src="<?= $path ?>images/logo_contact.png" alt="Contesto" width="350" height="116" /><br />
<strong>Contesto Translations</strong><br />
Heinrichstrasse 51<br />
8005 Zürich<br />
Switzerland</p>
<p><img src="<?= $path ?>images/contact_mail.gif" alt="phone" /> 044 271 36 65<br />
<img src="<?= $path ?>images/contact_fax.gif" alt="fax" /> 044 271 36 65<br />
<img src="<?= $path ?>images/contact_mail.gif" alt="mail" /> <a href="mailto:traduzioni@contesto.ch">traduzioni@contesto.ch</a></p>

<h6><?= tr('Contact form') ?></h6>

<form action="http://contesto.illustration.ch/contact/" method="post" class="contactForm form" id="contact-form">

<p class="contact_honey">
<label for="contact_honeypot">Leave this field blank if you're human</label><br>
<input type="text" name="contact_honeypot" id="contact_honeypot" class="text-field" placeholder="">
</p>

<p><strong><?= tr('Name') ?></strong></p>
<p><input type="text" name="contactName" class="required" id="contactName" value="" /></p>

<p><strong>E-mail</strong></p>
<p><input type="text" name="contactEmail" class="required" id="contactEmail" value="" /></p>

<p><strong><?= tr('Subject') ?></strong></p>
<p><input type="text" name="contactSubject" id="contactSubject" value="" /></p>

<p><strong><?= tr('Message') ?></strong></p>
<p><textarea  class="required" name="contactMessage" id="contactMessage" rows="" cols=""></textarea></p>

<input type="hidden" name="submitted" id="submitted" value="true" />

<p>* = <?= tr('Required field') ?></p>

<p><input type="submit" value="<?= tr('Submit') ?>" class="submit submitTheme" id="submitform" />
</p>
</form>
