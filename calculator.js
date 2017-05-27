var data = {
	mit1: {
		name: "MIT 1",
		courses: [
			// MIT1 1st Semester 
			{
				name: "MIT801",
				desc: "Introduction To Information Techonology",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT802",
				desc: "Introduction To Database",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT803",
				desc: "Programming Languages",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT805",
				desc: "Computer Systems Architecture and Organisation",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT821",
				desc: "Software Systems",
				type: "Compulsory",
				unit: "3"
			},


			// MIT1 2nd Semester 
			{
				name: "MIT804",
				desc: "Introduction To OOP - JAVA",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT806",
				desc: "IT and Law",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT811",
				desc: "Business Information Systems",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT813",
				desc: "Advanced Database Systems",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT822",
				desc: "Operating Systems",
				type: "Compulsory",
				unit: "3"
			},
		]
	},





	mit2: {
		name: "MIT 2",
		courses: [
			// MIT2 1st Semester 
			{
				name: "MIT812",
				desc: "Computer Network & Communication Protocols",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT815",
				desc: "Internet Programming & Applications",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT824",
				desc: "Seminar on Current Topics",
				type: "Compulsory",
				unit: "3"
			},
			{
				name: "MIT807",
				desc: "AI & Its Applications",
				type: "Elective",
				unit: "3"
			},
			{
				name: "MIT809",
				desc: "Elements of Scientific Computing",
				type: "Elective",
				unit: "3"
			},
			{
				name: "MIT817",
				desc: "Software Engineering",
				type: "Elective",
				unit: "3"
			},


			// MIT2 2nd Semester 
			{
				name: "MIT808",
				desc: "Concepts and Application of E-Business",
				type: "Compulsory",
				unit: "2"
			},
			{
				name: "MIT814",
				desc: "Human Computer Interactions (HCI)",
				type: "Elective",
				unit: "3"
			},
			{
				name: "MIT816",
				desc: "Data Warehousing, Data Mining and Business Intelligence",
				type: "Elective",
				unit: "3"
			},
			{
				name: "MIT823",
				desc: "Office Automation and Project Management",
				type: "Elective",
				unit: "3"
			},
			{
				name: "MIT899",
				desc: "Project",
				type: "Compulsory",
				unit: "6"
			},
		]
	}
}










function Course (name, grade, unit = 3) {
	this.name = name
	this.unit = unit
	this.grade = grade.toUpperCase()
}

const grade2Point = {
	A:5, B:4, C:3, D:2, E:1, F:0
}

Course.prototype.getPoint = function (grade) {
	return grade2Point[grade] || 0;
}


function GPCalc(courses = []) {
	this.courses = courses
	this.totalUnit = 0;

}

GPCalc.prototype.reduce = function () {
	return function (a,b) {
		return a+b;
	}
}

GPCalc.prototype.addCourse = function (course) {
	this.courses.push(course)
}

GPCalc.prototype.numCourses = function () {
	return this.courses.length
}

GPCalc.prototype.setScores = function () {
	return this.courses.map(function (course) {
		return course.unit * course.getPoint(course.grade)
	});
}

GPCalc.prototype.setUnits = function (course) {
	return this.courses.map(function (course) {
		return course.unit
	});
}

GPCalc.prototype.calculate = function () {
	var totalScore = this.setScores().reduce(this.reduce());
	var totalUnit = this.setUnits().reduce(this.reduce());
	return totalScore/totalUnit;
}