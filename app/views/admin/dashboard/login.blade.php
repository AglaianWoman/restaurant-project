@extends("layouts.login")
@section("content")

<?php echo Form::open(array('url' => 'admin/login')) ?>
    <?php echo Form::token(); 
    echo Form::label('email', 'E-Mail Address', array('class' => 'awesome'));
    echo Form::email('email');
    echo Form::password('password');
    echo Form::submit("Log In");
    ?>
<?php echo Form::close() ?>

@stop