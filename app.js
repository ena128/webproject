
const express = require('express');
const pool = require('./database'); 
const app = express();

app.use(express.json()); 


app.get('/api/users', (req, res) => {
  pool.query('SELECT * FROM Users', (error, results) => {
    if (error) throw error;
    res.json(results);
  });
});


const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
