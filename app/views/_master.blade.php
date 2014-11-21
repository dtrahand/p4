<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Schedule')</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/style.css' type='text/css'>

	@yield('head')


</head>
<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<nav>
		<ul>
		@if(Auth::check())
			<a href='/logout'>Log out {{ Auth::user()->email }}</a>
            @if (Auth::user()->Teacher == TRUE)
            <!-- User is a TEACHER:-->
                <a href='/book'>Manage list of Students</a>
                <a href='/book/create'>Manager my available days and time</a>
                <a href='/book/create'>View entire schedule</a>
            @else
            <!-- User is a STUDENT:-->
                <a href='/book/create'>Manager my available days and time</a>
		    @endif

		@else
New user: <a href='/signup'>Sign up</a> or Already have an account: <a href='/login'>Log in</a>
		@endif
		</ul>
	</nav>

	@yield('content')

	@yield('/body')

</body>
</html>