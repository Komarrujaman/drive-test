import express from 'express';
import { createServer } from 'http';
import bodyParser from 'body-parser';
import util from 'util';

const app = express();
const server = createServer(app);

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.post('/monitor', function(req, res, next) {
  console.log(util.inspect(req.body, false, null));
  res.send('ack');
});

server.listen(9000, function() {
  console.log('App listening on port 9000');
});
