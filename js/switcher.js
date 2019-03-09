/*changing the view based on the navigation*/

//const feeds = $('');
const Agents = $('#agents-div');
const Home = $('#forms');

const homeLi = $('#home-li');
const agentsLi = $('#agents-li');
const feedsLi = $('#feeds-li');


let Swith = (a) => {
    console.log(a);
    console.log(b);
    console.log(c);
}

//add event Listeners to the navs
homeLi.on("click",()=>{
    Agents.addClass('hidden',2000);
    Home.removeClass('hidden')
    Home.addClass('visible');
});
agentsLi.on('click',() =>{
    Agents.removeClass('hidden');
    Agents.addClass('visible');
    Home.removeClass('visible');
    Home.addClass('hidden');
})