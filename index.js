var express = require("express");
var app = express();
var bodyParser = require("body-parser");
var mongoose = require("mongoose");
var Work = require("./models/work");

mongoose.connect("mongodb+srv://KK:Karthik123@cluster0.k6btp.mongodb.net/WorkKosh?retryWrites=true&w=majority", {
    useNewUrlParser: true,
    useUnifiedTopology: true
});
app.use(bodyParser.urlencoded({
    extended: true,
    useUnifiedTopology: true
}));
app.use(express.static(__dirname + "/public"));
app.set("view engine", "ejs");

app.get("/", function(req, res) {
    res.render("landing");
});

app.get("/login", function(req, res) {
    res.render("login");
});

app.get("/register", function(req, res) {
    res.render("register");
});

app.get("/works", function(req, res) {
    Work.find({}, function(err, allWorks) {
        if(err) {
            console.log(err);
        } else {
            res.render("works", {works:allWorks});
        }
    });
});

app.post("/works", function(req, res) {
    var name = req.body.name;
    var image = req.body.image;
    var worker = req.body.worker;
    var hour = req.body.hour;
    var wage = req.body.wage;
    var address = req.body.address;

    var newWork = {name: name, image: image, worker: worker, hour: hour, wage: wage, address: address};
    Work.create(newWork, function(err, newlyAdded) {
        if(err) {
            console.log(err);
        } else {
            res.redirect("/works");
        }
    });
});

app.get("/works/new", function(req, res) {
    res.render("addwork");
});

app.get("/works/:id", function(req, res) {
    Work.findById(req.params.id, function(err, foundWork) {
        if(err) {
            console.log(err);
        } else {
            console.log(foundWork);
            res.render("show", {work: foundWork});
        }
    });
});

app.listen(3000, function() {
    console.log("The server has started");
});