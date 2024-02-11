const express = require('express');
const app = express();

app.get('/', function(req, res) {
	res.render('index', {title: 'TASK 2: Feedback'})
});


module.exports = app;
