var express = require("express");
var app = express();
var bodyParser = require("body-parser");

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
    res.render("works");
});

app.get("/works/new", function(req, res) {
    res.render("addwork");
});


app.listen(3000, function() {
    console.log("The server has started");
});