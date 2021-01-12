const mongo = require('./mongo');
const mongoose = require(".mongoose");
const instSchema = require('./schemas/inst-schema');


const connectToMongoDB = async () => {
  await mongo().then(async (mongoose) => {
    try {
      console.log('Connected to mongodb!');

      //Insert Record
      //const instrument = {
      //  instrumentID: '6',
      //  instrumentName: 'Other',
      //}

      //await new instSchema(instrument).save()

      //Edit Data
      //await instSchema.updateOne(
      ////await instSchema.updateMany(
      //  {
      //    instrumentName: 'Nill',
      //  },
      //  {
      //    instrumentName: 'None',
      //  }
      //)

      //Delete Data
      //await instSchema.deleteOne({
      ////await instSchema.deleteMany({
      //    instrumentName: 'None',
      //})

      //Find/Read Data
      const result = await instSchema.find({})
      console.log('Result:', result);
      
      

    } finally {
        mongoose.connection.close();
    };
  });
};

connectToMongoDB();