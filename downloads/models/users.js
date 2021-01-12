const mongoose = require('mongoose');

//Schema
const Schema = mongoose.Schema;

const reqString = {
    type: String,
    required: true
}

const userSchema = mongoose.Schema({
    email: reqString,
    firstName: reqString,
    lastName: reqString,
    comments: String,
})

//Model
const theUsers = mongoose.model('users', userSchema);

module.exports = theUsers;