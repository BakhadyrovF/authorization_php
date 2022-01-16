<h1 style="margin-bottom: 30px;">Sign In</h1>
<?php $form = app\core\form\Form::begin("", "post"); ?>
<?php $form->field($model, "email") ?>
<?php $form->field($model, "password") ?>

<button type="submit" class="btn btn-success">Submit</button>
<a href="/register" style="float: right; margin-top: 17px;">Dont have an account yet?</a>
<?php $form->end();  ?>