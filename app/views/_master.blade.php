<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Schedule')</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<link rel='stylesheet' href='/css/style.css' type='text/css'>
</head>

<body>
    <!-- HEADER OF PAGE - which is different if user is teacher or student: -->
    @if(Auth::check())
        <a href='/logout'>Log out {{ Auth::user()->email }}</a>
        @if (Auth::user()->Teacher == TRUE)   <!-- User is a TEACHER:-->
            <?php include("../app/views/HeaderTeacher.php") ?>
        @else <!-- User is a STUDENT:-->
            <?php include("../app/views/HeaderStudent.php") ?>
        @endif
    @else <!-- User is not signed in:-->
            <?php include("../app/views/HeaderUnknown.php") ?>
    @endif

    <!-- Format the way Flash messages are displayed: -->
    @if(Session::get('flash_message'))
		<div class='flash-message'> {{ Session::get('flash_message') }}</div>
	@endif
    
	@yield('content')

	@yield('body')

</body>
</html>