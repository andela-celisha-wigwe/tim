<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<style>
		.grade-input {
			text-transform: uppercase;
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

		.result-text {
			font-weight: 300;
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
			var label = '<tr><td><label for="' + name.toLowerCase() + '">' + name.toUpperCase() + ': <span class="hidden-sm course-description">' + course.desc + '</span></label></td>'
			var input = '<td><input type="text" maxlength="1" value="" placeholder="a, b" name="' + name.toLowerCase() + '" id="' + name.toLowerCase() + '" class="grade-input form-control"></td></tr>';
			return label + input
		}).reduce(function (a,b) {
			return a+b
		})

		var displayWarning = function () {
			document.getElementById('warning').innerHTML = "You have not entered any grades."
		}

		var displayForm = function (html) {
			var scoresContainer = document.getElementById('scores-container')
			scoresContainer.innerHTML = '<table class="table table-hover">' + fields + '</table>'

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
					document.getElementById('result').innerHTML = '<span class="result-text hidden-sm">Your current CGPA is: </span>' + parseFloat(Math.round(calculator.calculate() * 100) / 100).toFixed(2);
				} else {
					displayWarning()
				}
			})
		}

	</script>
	<title>Document</title>
</head>
<body onload="displayForm()">

	<div class="panel panel-default">
		<div class="panel-heading"><h3>MIT CGPA Calculator</h3></div>
		<div id="warning" class="btn-danger"></div> 
		  <div class="panel-body">
			<div id="scores-container" class="table-responsive">
			</div>
			<h1 id="result"><span class="result-text">Your CGPA will show here.</span></h1>
			<button type="submit" class="btn btn-sm btn-primary" id="calculate-cgpa">Calculate</button>
		  </div>
	</div>
	
</body>
</html>