const body=document.querySelector("body");
const sidebar=body.querySelector(".sidebard");
const toggle=body.querySelector(".toggle");

const modeSwitch=body.querySelector(".toggle-switch");

const modeText=body.querySelector(".mode-text");

modeSwitch.addEventListener("click", ()=>{
    body.classList.toggle("dark");
})