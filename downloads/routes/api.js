const express = require('express');

const router = express.Router();


const theInstruments = require('../models/instruments');
const theUsers = require('../models/users');

//Routes
router.get('/instruments', (req, res) => {

    theInstruments.find({   })
        .then((data) => {
            console.log('Data: ', data);
            res.json(data);
        })
        .catch((error) => {
            console.log('Error: ', error);
        });

});

router.get('/users', (req, res) => {

    theUsers.find({   })
        .then((data) => {
            console.log('Data: ', data);
            res.json(data);
        })
        .catch((error) => {
            console.log('Error: ', error);
        });

});

router.post('/save', (req, res) => {
    const data = req.body;

    const newtheUsers = new theUsers(data);

    console.log(newtheUsers);

    newtheUsers.save((error) => {
             if (error) {
                 alert('Error, missing data: ' + error);
                 console.log('Error, something happened: ' + error);
             } else {
                 console.log('Data has been saved!');
             }
         });

    res.json({
        msg: 'Signup complete!'
    });
});

router.get('/name', (req, res) => {
    const data = {
        username: 'peterson',
        age: 5
    };
    res.json(data);
});

module.exports = router;