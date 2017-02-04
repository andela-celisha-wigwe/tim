<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.grade-input {
			text-transform: uppercase;
		}

		.container {
			max-width: 900px;
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

		.single-course {
			margin-right: 0px;
			margin-left: 0px;
			padding: 10px 0;
		}

		.course-description {
			font-style: italic;
			font-weight: 200;
		}
	</style>
	<script src="./calculator.js"></script>
	<script type="text/javascript">
		var fields = data.map(function (course) {
			var name = course.name
			var label = '<div class="col-md-4 col-sm-2 col-xs-12"><label for="' + name.toLowerCase() + '">' + name.toUpperCase() + ': <span class="hidden-sm course-description">' + course.desc + '</span><br><span class="type">' + course.type + '</sapn></label></div>'
			var input = '<div class="col-md-8 col-sm-10 col-xs-12"><input type="text" maxlength="1" value="" placeholder="a, b" name="' + name.toLowerCase() + '" id="' + name.toLowerCase() + '" class="grade-input form-control"></div>';
			return '<div class="row single-course">' + label + input + '</div>'
		}).reduce(function (a,b) {
			return a+b
		})

		var displayWarning = function () {
			document.getElementById('warning').innerHTML = "You have not entered any grades."
		}

		var displayForm = function (html) {
			var scoresContainer = document.getElementById('scores-container')
			scoresContainer.innerHTML = '<div>' + fields + '</div>'

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
	<title>Document</title>
</head>
<body onload="displayForm()">

	<div class="panel panel-default container">
		<div class="panel-heading"><h3>MIT CGPA Calculator <span class="pull-right hidden-xs" id="hash">#operation_who_is_159?</span></h3></div>
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