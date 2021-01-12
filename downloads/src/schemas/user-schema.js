const mongoose = require('mongoose')

const reqString = {
        type: String,
        required: true
}

const userSchema = mongoose.Schema({
    email: reqString,
    firstName: reqString,
    lastName: reqString,
    comments: reqString,
})

module.exports = mongoose.model('users', userSchema)