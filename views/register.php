
<h1 style="margin-bottom: 30px;">Sign Up</h1>
<?php $form = app\core\form\Form::begin("", "post"); ?>
<?php $form->field($model, "firstname") ?>
<?php $form->field($model, "lastname") ?>
<?php $form->field($model, "email") ?>
<?php $form->field($model, "password") ?>
<?php $form->field($model, "passwordConfirm") ?>
<button type="submit" class="btn btn-success" style="margin-bottom: 100px;">Submit</button>
<a href="/login" style="float: right; margin-top: 17px;">Already have an account?</a>
<?php $form->end();  ?>

