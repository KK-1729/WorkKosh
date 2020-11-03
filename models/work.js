var mongoose = require("mongoose");

//SCHEMA SETUP
var workSchema = new mongoose.Schema({
    name: String,
    image: String,
    worker: Number,
    hour: Number,
    wage: String,
    address: String
});

module.exports = mongoose.model("Work", workSchema);