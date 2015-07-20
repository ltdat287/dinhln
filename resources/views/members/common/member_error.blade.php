@if (count($errors) > 0)
<?php 
$errors = (is_array($errors)) ? $errors : $errors->all();
?>
<section class="error-box">
	<h3>!!ERROR!!</h3>
	<ul>
	@foreach ($errors as $error)
		<li>{{ trans('labels.error_prefix') }}{{ $error }}</li>
	@endforeach
	</ul>
</section>
@endif