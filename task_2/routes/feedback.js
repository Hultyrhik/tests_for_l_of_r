const express = require('express');
const app = express();

app.get('/', function(req, res, next) {
	req.getConnection(function(error, conn) {
		conn.query('SELECT * FROM feedback ORDER BY id DESC',function(err, rows, fields) {
			if (err) {
				req.flash('error', err)
				res.render('feedback/list', {
					title: 'Feedback List', 
					data: ''
				})
			} else {
				res.render('feedback/list', {
					title: 'Feedback List', 
					data: rows
				})
			}
		})
	})
});


app.get('/add', function(req, res, next){	
	res.render('feedback/add', {
		title: 'Add New feedback',
		comment: '',
		name: '',
		address: '',
		email: '',		
		phone: ''		
	})
});

app.post('/add', function(req, res, next){	
	
	req.assert('name', 'Name is required').notEmpty()           
	req.assert('phone', 'Phone is required').notEmpty() 

    const errors = req.validationErrors();
    
    if( !errors ) { 
		
		const feedback = {
			comment: req.sanitize('comment').escape().trim(),
			name: req.sanitize('name').escape().trim(),
			address: req.sanitize('address').escape().trim(),
			email: req.sanitize('email').escape().trim(),
			phone: req.sanitize('phone').escape().trim()
		}

		if (feedback.email.includes('@gmail.com')) {
			req.flash('error', 'Адрес электронной почты содержит недопустимый домен @gmail.com');
			res.render('feedback/add', {
				title: 'Add New Feedback',
				comment: '',
				name: '',
				address: '',
				email: '',					
				phone: ''					
			});
		}
		else if (!feedback.phone.match(/7-[0-9]{3}-[0-9]{3}-[0-9]{4}/)) {
			req.flash('error', 'Телефон указан неверно');
			res.render('feedback/add', {
				title: 'Add New Feedback',
				comment: '',
				name: '',
				address: '',
				email: '',					
				phone: ''					
			});
		}

		else {
		
			req.getConnection(function(error, conn) {
				conn.query('INSERT INTO feedback SET ?', feedback, function(err, result) {
					if (err) {
						req.flash('error', err)
						
						res.render('feedback/add', {
							title: 'Add New Feedback',
							comment: feedback.comment,
							name: feedback.name,
							address: feedback.address,
							email: feedback.email,					
							phone: feedback.phone					
						})
					} else {				
						req.flash('success', 'Data added successfully!')
						res.render('feedback/add', {
							title: 'Add New Feedback',
							comment: '',
							name: '',
							address: '',
							email: '',					
							phone: ''					
						})
					}
				})
			})
	
		}
	}
	else {  
		let error_msg = ''
		errors.forEach(function(error) {
			error_msg += error.msg + '<br>'
		})				
		req.flash('error', error_msg)		
		
        res.render('feedback/add', { 
            title: 'Add New Feedback',
            comment: req.body.comment,
            name: req.body.name,
            address: req.body.address,
            email: req.body.email,
            phone: req.body.phone
        })
    }
});

module.exports = app;
