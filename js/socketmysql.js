var mysql      = require('mysql');
var connectionsql = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'consultorio'
});

connectionsql.connect();

connectionsql.query('SELECT * from ocupacion', function(err, rows, fields) {
  if (!err)
    console.log('The solution is: ', rows.ocupDetalle);
  else
    console.log('Error while performing Query.');
});

connectionsql.end();