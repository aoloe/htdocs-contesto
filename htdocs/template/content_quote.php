<h1><?= tr('Request a quote') ?></h1>

<form action="" method="post" class="contactForm form" id="contact_form" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="200000" />

<p class="contact_honey">
<label for="<?= $post_prefix ?>honeypot">Leave this field blank if you're human</label><br>
<input type="text" name="<?= $post_prefix ?>honeypot" id="<?= $post_prefix ?>honeypot" class="text-field" placeholder="">
</p>

<p><strong><?= tr('Source language') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>language_source" class="required" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Target languages') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>language_target" class="required" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Required delivery time') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>delivery_time" class="required" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Document to be translated') ?></strong></p>
<p><input type="file" name="<?= $post_prefix ?>document" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Company') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>company" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Contact person') ?></strong></p>

<p><strong><?= tr('First name, name') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>name" class="required" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Address') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>address" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('ZIP, City') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>city" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Phone') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>phone" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('Fax') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>fax" id="<?= $post_prefix ?>name" value="" /></p>

<p><strong><?= tr('E-mail') ?></strong></p>
<p><input type="text" name="<?= $post_prefix ?>email" class="required" id="<?= $post_prefix ?>email" value="" /></p>

<p><strong><?= tr('Comments') ?></strong></p>
<p><textarea  class="required" name="<?= $post_prefix ?>comments" id="<?= $post_prefix ?>comments" rows="" cols=""></textarea></p>

<p>* = <?= tr('Required field') ?></p>

<p><input type="submit" value="<?= tr('Submit') ?>" class="submit submitTheme" name="<?= $post_prefix ?>submit" id="<?= $post_prefix ?>submit" />
</p>
</form>
