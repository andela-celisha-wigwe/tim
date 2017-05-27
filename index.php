<html>
<head>
	<title>MIT CGPA Calculator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.6/handlebars.min.js" ></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.grade-input {
			text-transform: uppercase;
		}

		.container {
			max-width: 1160px;
			margin: 10px auto;
			padding: 0px;
		}

		#calculate-cgpa {
			width: 100%;
			text-transform: uppercase;
		}

		#hash {
			background: #337ab7;
		    padding: 0 5px;
		    border-radius: 2px;
		    color: #fff;
		}

		#warning {
			text-align: center !important;
			margin: 0 auto;
			display: block;
			padding: 5px;
		}

		#result {
			text-align: center;
			background: whitesmoke;
			display: block;
			padding: 1px;
			color: #337ab7;
		}
		.type {
			text-align: left;
			font-style: italic;
			display: block;
			font-weight: 200;
			font-size: 70%;
		}

		.semester-title {
			margin: 0 auto !important;
			text-align: center;
			background: rgb(245, 245, 245);
			color: #337ab7;
		}

		#result-text {
			font-weight: 300;
		}

		#result-count {
			display: block;
		    font-size: 60%;
		    font-weight: 300;
		    font-style: italic;
		    background: #337ab7;
		    color: #fff;
		}

		span.compulsory, span.elective {
		    padding: 0 2px;
		    color: #337ab7;
		    font-weight: 700;
		}

		span.elective {
			color: #246d38;
		}

		#limit {
			color: #d9534f;
		    font-weight: bold;
		}

		.single-course {
			margin: 4px 0;
			padding: 10px 0;
			border-left: solid 5px;
		}

		.single-course.compulsory {
			border-left-color: #337ab7;
		}

		.single-course.elective {
			border-left-color: #246d38;
		}

		.course-description {
			font-style: italic;
			font-weight: 200;
		}
	</style>
	<script src="./calculator.js"></script>
	<script type="text/javascript">
		var displayWarning = function () {
			document.getElementById('warning').innerHTML = "You have not entered any grades."
		}

		var displayForm = function (html) {
			var scoresContainer = document.getElementById('scores-container')
			var courseTemplate = document.getElementById("course-template").innerHTML;
			var make = Handlebars.compile(courseTemplate);
			for (semester in data) {
				scoresContainer.innerHTML += '<h2 class="semester-title">' + data[semester].name + '</h2>'
				data[semester].courses.map(function (course) {
					var course = make(course);
					scoresContainer.innerHTML += course
				})
			}

			document.getElementById('calculate-cgpa').addEventListener('click', function () {
				var courses = []
				var validGrades = ['A', 'B', 'C', 'D', 'E', 'F'];
				var inputs = document.getElementsByClassName('grade-input')
				for (var i = 0; i < inputs.length; i++) {
					var courseField = inputs[i]
					if (courseField.tagName.toUpperCase() == "INPUT" && validGrades.indexOf(courseField.value.trim().toUpperCase()) != -1) {
						var course = new Course(courseField.name, courseField.value)
						courses.push(course)
					}
				}
				if (courses.length > 0 ) {
					var calculator = new GPCalc(courses);
					document.getElementById('warning').innerHTML = ""
					document.getElementById('result-text').innerHTML = '<span class="result-text hidden-sm">CGPA: </span>' + parseFloat(Math.round(calculator.calculate() * 100) / 100).toFixed(2);
					document.getElementById('result-count').innerHTML = 'Courses: ' + calculator.numCourses()
				} else {
					displayWarning()
				}
			})
		}

	</script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92192279-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body onload="displayForm()">
	<script type="text/x-handlebars-template" id="course-template">
		<div class="row single-course {{type}}">
			<div class="col-md-4 col-sm-2 col-xs-12">
				<label for="{{name}}">{{name}}:
					<span class="hidden-sm course-description">{{desc}}</span><br>
					<span class="type {{type}}">{{type}}</span>
				</label>
			</div>
			<div class="col-md-8 col-sm-10 col-xs-12">
				<input type="text" maxlength="1" value="" placeholder="a, b" name="{{name}}" id="{{name}}" class="grade-input form-control">
			</div>
		</div>
	</script>

	<div class="panel panel-default container">
		<div class="panel-heading">
			<h3>MIT CGPA Calculator</h3>
			<!-- <h4 id="limit">2.45</h4> -->
		</div>
		<div id="warning" class="btn-danger"></div> 
		<h1 id="result">
			<span id="result-text">Your CGPA will show here.</span>
			<span id="result-count"></span>
		</h1>
		  <div class="panel-body">
			<div id="scores-container" class="row">
			</div>
			<button type="submit" class="btn btn-sm btn-primary" id="calculate-cgpa">Calculate</button>
		  </div>
	</div>
	
</body>
</html>