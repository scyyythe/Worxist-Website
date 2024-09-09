//import express

const express=require('express');
const app= express();
const port=3000;

//static files
app.use(express.static('code'))
app.use('/css', express.static(__dirname + 'code/css'))
app.use('/css', express.static(__dirname + 'code/image'))
app.use('/css', express.static(__dirname + 'code/gallery'))
app.use('/css', express.static(__dirname + 'code/js'))


//display html file

app.get('',(req,res)=>{
    res.sendFile(__dirname+'/code/home.html')
})
app.get('/accounLogin',(req,res)=>{
    res.sendFile(__dirname+'/code/accounLogin.html')
})


//listening to port
app.listen(port, ()=> console.info('Listening on port ${port}'));