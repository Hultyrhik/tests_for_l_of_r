const express = require('express');
const app = express();

const mysql = require('mysql');


const myConnection  = require('express-myconnection');

const config = require('./config');
const dbOptions = {
	host:	  config.database.host,
	user: 	  config.database.user,
	password: config.database.password,
	port: 	  config.database.port, 
	database: config.database.db
};

app.use(myConnection(mysql, dbOptions, 'pool'));


app.set('view engine', 'ejs');


const index = require('./routes/index');
const feedback = require('./routes/feedback');

const expressValidator = require('express-validator');
app.use(expressValidator());



const bodyParser = require('body-parser');

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());



const methodOverride = require('method-override');


app.use(methodOverride(function (req, res) {
  if (req.body && typeof req.body === 'object' && '_method' in req.body) {
    const method = req.body._method
    delete req.body._method
    return method
  }
}));


const flash = require('express-flash');
const cookieParser = require('cookie-parser');
const session = require('express-session');

app.use(cookieParser('keyboard cat'));
app.use(session({ 
	secret: 'keyboard cat',
	resave: false,
	saveUninitialized: true,
	cookie: { maxAge: 60000 }
}));
app.use(flash());


app.use('/', index);
app.use('/feedback', feedback);

app.listen(3000, function(){
	console.log('Server running at port 3000: http://127.0.0.1:3000')
});
