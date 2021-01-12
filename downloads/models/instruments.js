const mongoose = require('mongoose');

//Schema
const Schema = mongoose.Schema;

const reqString = {
    type: String,
    required: true
}

const instrumentSchema = mongoose.Schema({
    instrumentID: reqString,
    instrumentName: reqString,
    URL: String,
})

//Model
const theInstruments = mongoose.model('instruments', instrumentSchema);

module.exports = theInstruments;