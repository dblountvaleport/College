const mongoose = require('mongoose')

const reqString = {
        type: String,
        required: true
}

const instSchema = mongoose.Schema({
    instrumentID: reqString,
    instrumentName: reqString,
    URL: String,
})

module.exports = mongoose.model('instruments', instSchema)