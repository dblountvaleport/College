const mongoose = require('mongoose')
const mongoPath = 'mongodb+srv://tutorial:ndxcJdxkBPPkJOut@cluster0.fgadn.mongodb.net/Cluster0?retryWrites=true&w=majority'

//ndxcJdxkBPPkJOut

module.exports = async () => {
    await mongoose.connect(mongoPath, {
        useNewUrlParser: true,
        useUnifiedTopology: true
    })

    return mongoose
}