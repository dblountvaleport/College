//Import npm package
const express = require('express');
const mongoose = require('mongoose');
const morgan = require('morgan');
const path = require('path');
const mongo = require('./src/mongo');

const app = express();
const PORT = process.env.PORT || 8080;

const routes = require('./routes/api');

//Connect to MongoDB
const MONGODB_URI = 'mongodb+srv://tutorial:ndxcJdxkBPPkJOut@cluster0.fgadn.mongodb.net/Cluster0?retryWrites=true&w=majority'

mongoose.connect(MONGODB_URI, {
    useNewUrlParser: true,
    useUnifiedTopology: true
});

mongoose.connection.on('connected', () => {
    console.log('Mongoose is connected!!!');
});

//Data Parsing
app.use(express.json());
app.use(express.urlencoded({ extended: false }));


//Saving data to mongodb

// const data = {
//     instrumentID: '3',
//     instrumentName: 'Test'
// };

// const newInstrument = new theInstruments(data);

// newInstrument.save((error) => {
//     if (error) {
//         console.log('Error, something happened');
//     } else {
//         console.log('Data has been saved!');
//     }
// });

//HTTP request logger
app.use(morgan('tiny'));
app.use('/api', routes);


app.listen(PORT, console.log(`Server is starting at ${PORT}`));